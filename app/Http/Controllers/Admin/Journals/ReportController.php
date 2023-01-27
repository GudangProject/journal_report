<?php

namespace App\Http\Controllers\Admin\Journals;

use App\Charts\Journal\JournalReportChart;
use App\Http\Controllers\Controller;
use App\Models\Journals\Invoice;
use App\Models\Journals\Journal;
use App\Models\Journals\Naskah;
use App\Models\Journals\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function stock(JournalReportChart $chart){

        return view('admin.journals.reports.stock', [
            'data'  => Journal::orderByDesc('created_at')->get(),
            'naskah' => Naskah::orderByDesc('created_at')->get(),
            'chart' => $chart->build()
        ]);
    }

    public function invoiceDownload(Request $request)
    {
        $invoice = Invoice::where('payment_id', $request->id)->first();

        $pdf = Pdf::loadView('admin.journals.reports.invoice-download', [
            'payment' => Payment::findOrfail($request->id),
            'invoice' => $invoice,
            'naskah'  => Naskah::where('payment_id', $request->id)->get()
        ])->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->download('invoice-'.$invoice->code.'.pdf');

    }

    public function invoicePrint(Request $request)
    {
        $invoice = Invoice::where('payment_id', $request->id)->first();

        return view('admin.journals.reports.invoice-print', [
            'payment' => Payment::findOrfail($request->id),
            'invoice' => $invoice,
            'naskah'  => Naskah::where('payment_id', $request->id)->get()
        ]);
    }

    public function payments(){
        $data = [
            'income' => [
                'total' => Payment::where('status', true)->sum('price'),
                'currentYear' => Payment::whereYear('created_at', now()->year)->where('status', true)->sum('price'),
                'currentMonth' => Payment::whereMonth('created_at', now()->month)->where('status', true)->sum('price'),
                'currentDay' => Payment::whereDay('created_at', now()->day)->where('status', true)->sum('price'),
            ],
        ];
        // dd($data);
        return view('admin.journals.reports.payments', [
            'data' => $data
        ]);
    }
}
