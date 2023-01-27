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
}
