<?php

namespace App\Exports;

use App\Models\Journals\Payment;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;


class PaymentExport implements FromView
{
    public $selectedKeys;

    public function __construct($id)
    {
        $this->selectedKeys = $id;
    }

    public function view(): View
    {
        $data = Payment::whereIn('id', $this->selectedKeys)->orderByDesc('created_at')->get();
        $income = [
            'income' => [
                'total' => Payment::where('status', true)->sum('price'),
                'currentYear' => Payment::whereYear('created_at', now()->year)->where('status', true)->sum('price'),
                'currentMonth' => Payment::whereMonth('created_at', now()->month)->where('status', true)->sum('price'),
                'currentDay' => Payment::whereDay('created_at', now()->day)->where('status', true)->sum('price'),
            ],
        ];
        return view('admin.journals.reports.exports.payments', [
            'data' => $data,
            'income' => $income,
        ]);
    }
}
