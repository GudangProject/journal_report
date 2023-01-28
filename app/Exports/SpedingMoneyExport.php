<?php

namespace App\Exports;

use App\Models\Journals\Mybank;
use App\Models\Journals\SpedingMoney;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SpedingMoneyExport implements FromView
{
    public $selectedKeys;

    public function __construct($id)
    {
        $this->selectedKeys = $id;
    }

    public function view(): View
    {
        $spedingMoney = SpedingMoney::whereIn('id', $this->selectedKeys)->orderByDesc('created_at')->get();
        $mybankId = SpedingMoney::whereIn('id', $this->selectedKeys)->latest()->first()->mybank_id;

        $data = [
            'income_amount' => Mybank::findOrFail($mybankId)->balance,
            'speding_money' => SpedingMoney::sum('amount'),
        ];

        return view('admin.journals.reports.exports.speding-money', [
            'data' => $data,
            'spedingMoney' => $spedingMoney
        ]);
    }
}
