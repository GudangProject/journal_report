<?php

namespace App\Http\Controllers\Admin\Journals;

use App\Charts\Journal\JournalReportChart;
use App\Http\Controllers\Controller;
use App\Models\Journals\Journal;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function stock(JournalReportChart $chart){

        return view('admin.journals.reports.stock', [
            'data'  => Journal::orderByDesc('created_at')->get(),
            'chart' => $chart->build()
        ]);
    }
}
