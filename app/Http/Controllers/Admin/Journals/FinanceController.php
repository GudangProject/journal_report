<?php

namespace App\Http\Controllers\Admin\Journals;

use App\Http\Controllers\Controller;
use App\Models\Journals\Mybank;
use App\Models\Journals\SpedingMoney;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function index()
    {
        $data = [
            'income_amount' => Mybank::sum('balance'),
            'speding_money' => SpedingMoney::sum('amount'),

        ];
        // dd($data);
        return view('admin.journals.reports.finance.index', ['data' => $data]);
    }
}
