<?php

namespace App\Http\Controllers\Admin\Journals;

use App\Http\Controllers\Controller;
use App\Models\Journals\Mybank;
use App\Models\Journals\SpedingMoney;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

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

    public function detail(Request $request)
    {
        $mybank = Mybank::findOrFail($request->id);

        $data = [
            'id' => $mybank->id,
            'income_amount' => $mybank->balance,
            'speding_money' => SpedingMoney::sum('amount'),
        ];
        return view('admin.journals.reports.finance.detail', [
            'data' => $data
        ]);
    }

    public function spedingMoney(Request $request)
    {
        // dd($request);
        $mybank         = Mybank::findOrFail($request->id);
        $updateBalance  = $mybank->update(['balance' => $mybank->balance - $request->amount]);

        try {
            if($updateBalance){
                SpedingMoney::create([
                    'mybank_id'   => $request->id,
                    'amount'      => $request->amount,
                    'description' => $request->description,
                    'used_by'     => auth()->user()->id,
                ]);
            }

            Alert::success('Pengeluaran Dana', 'Pengeluaran dana berhasil ditambahkan');
            return redirect()->route('reports.finance-detail', ['id' => $request->id]);
        } catch (Exception $error) {
            Alert::error('Error', $error->getMessage());
            return back()->withInput();
        }

    }
}
