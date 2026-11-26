<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Models\Exchange;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

class ReportController extends Controller
{
    public function index(Request $request): View
    {
        abort_unless((bool) $request->user()->is_admin, 403);

        $reports = DB::table('reports')
            ->leftJoin('users as reporter', 'reporter.id', '=', 'reports.reporter_id')
            ->leftJoin('users as reported', 'reported.id', '=', 'reports.reported_user_id')
            ->where('reports.status', 'pendiente')
            ->select('reports.*', 'reporter.name as reporter_name', 'reported.name as reported_name')
            ->orderByDesc('reports.id')
            ->paginate(15);

        return view('admin.reports.index', compact('reports'));
    }

    public function discard(Request $request, int $report): \Illuminate\Http\RedirectResponse
{
    abort_unless((bool) $request->user()->is_admin, 403);

    $updated = DB::table('reports')
        ->where('id', $report)
        ->where('status', 'pendiente')
        ->update([
            'status' => 'descartado',
            'updated_at' => now(),
        ]);

    return redirect()->route('admin.reports.index')->with(
        'report_status',
        $updated ? 'Reporte descartado.' : 'El reporte ya no está pendiente.'
    );
}

    public function sanction(Request $request, int $report): RedirectResponse
{
    abort_unless($request->user()->can('moderate-reports'), 403);

    $result = DB::transaction(function () use ($report) {
        $record = DB::table('reports')
            ->where('id', $report)
            ->lockForUpdate()
            ->first();

        if (!$record || $record->status !== 'pendiente') {
            return ['message' => 'El reporte ya no está pendiente.'];
        }

        $reportedUser = User::query()
            ->lockForUpdate()
            ->find($record->reported_user_id);

        if (!$reportedUser) {
            return ['message' => 'La cuenta reportada ya no está activa.'];
        }

        if ((bool) $reportedUser->is_admin) {
            return ['message' => 'Las cuentas administradoras están excluidas de esta acción.'];
        }

        $reportedUserId = $reportedUser->getKey();

        Exchange::query()
            ->whereIn('status', ['pendiente', 'aceptado'])
            ->where(function ($query) use ($reportedUserId) {
                $query->where('sender_id', $reportedUserId)
                    ->orWhere('receiver_id', $reportedUserId);
            })
            ->update(['status' => 'cancelado']);

        $reportedUser->delete();

        DB::table('sessions')->where('user_id', $reportedUserId)->delete();

        DB::table('reports')->where('id', $report)->update([
            'status' => 'sancionado',
            'updated_at' => now(),
        ]);

        return [
            'message' => 'Sanción aplicada y aviso enviado por correo.',
            'email' => $reportedUser->email,
            'name' => $reportedUser->name,
            'reason' => match ($record->reason) {
                'insultos' => 'Insultos o lenguaje soez',
                'ciberacoso' => 'Ciberacoso',
                'suplantacion' => 'Suplantación de identidad',
                default => 'Otro incumplimiento de las normas de convivencia',
            },
        ];
    }, 3);

    if (isset($result['email'])) {
        $body = <<<TEXT
        Hola, {$result['name']}:

        El equipo de Moderación de SkillSwap revisó el reporte #{$report} y desactivó tu cuenta por un incumplimiento de las normas de convivencia.

        Motivo de la sanción: {$result['reason']}.

        A partir de este momento, perdiste el acceso a SkillSwap y tus intercambios abiertos quedaron cancelados.

        Equipo de Moderación de SkillSwap
        TEXT;

        try {
            Mail::raw($body, function ($message) use ($result) {
                $message->to($result['email'])
                    ->subject('SkillSwap | Aviso de sanción de cuenta');
            });
        } catch (\Throwable $exception) {
            report($exception);
            $result['message'] = 'La sanción se aplicó, pero hubo un error al enviar el correo.';
        }
    }

    return redirect()->route('admin.reports.index')
        ->with('report_status', $result['message']);
}

}
