<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Models\Exchange;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

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

    $message = DB::transaction(function () use ($report) {
        $record = DB::table('reports')
            ->where('id', $report)
            ->lockForUpdate()
            ->first();

        if (!$record || $record->status !== 'pendiente') {
            return 'El reporte ya no está pendiente.';
        }

        $reportedUser = User::query()
            ->lockForUpdate()
            ->find($record->reported_user_id);

        if (!$reportedUser) {
            return 'La cuenta reportada ya no está activa.';
        }

        if ((bool) $reportedUser->is_admin) {
            return 'Las cuentas administradoras están excluidas de esta acción.';
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

        return 'Sanción aplicada. La cuenta perdió el acceso.';
    }, 3);

    return redirect()->route('admin.reports.index')
        ->with('report_status', $message);
}

}
