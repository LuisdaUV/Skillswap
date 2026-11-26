<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

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

}
