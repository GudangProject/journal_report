<?php

namespace App\Http\Controllers\Admin\Journals;

use App\Http\Controllers\Controller;
use App\Models\Journals\Invoice;
use App\Models\Journals\Journal;
use App\Models\Journals\JournalPoint;
use App\Models\Journals\Mybank;
use App\Models\Journals\Naskah;
use App\Models\Journals\Payment;
use App\Services\ImageServices;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    public function index()
    {
        return view('admin.journals.payment.index');
    }

    public function create()
    {
        return view('admin.journals.payment.create', [
            'journals' => Journal::where('status', true)->orderByDesc('created_at')->get(),
            'mybank' => Mybank::all()
        ]);
    }

    public function store(Request $request)
    {
        $imageName     = '';
        $countNaskah   = count($request->manuscript_title);
        $journal       = Journal::findOrFail($request->journal_id);

        // $journalStock  = $journal->total;

        // if($countNaskah > $journalStock){

        //     Alert::error('Error', 'Slot tidak cucup, slot tersisa '.$journalStock);
        //     return back()->withInput();
        // }else{
        //     $updateStock   = $journalStock - $countNaskah;
        //     $currentStock  = $journal->update(['total' => $updateStock]);
        // }

        if($request->image != null){
            $validate = $request->validate([
                'image' =>'required|image|mimes:jpeg,png,jpg,gif|dimensions:max_width=1500,max_height:1500',
            ]);

            $image_setting = [
                'ori_width'=>config('app.img_size.ori_width'),
                'ori_height'=>config('app.img_size.ori_height'),
                'mid_width'=>config('app.img_size.mid_width'),
                'mid_height'=>config('app.img_size.mid_height'),
                'thumb_width'=>config('app.img_size.thumb_width'),
                'thumb_height'=>config('app.img_size.thumb_height')
            ];

            if($request->file('image') != null){
                $data = array(
                    'skala11' => array(
                        'width'=>$request->input('1_1_width'),
                        'height'=>$request->input('1_1_height'),
                        'x'=>$request->input('1_1_x'),
                        'y'=>$request->input('1_1_y')
                    )
                );

                $image_data = [
                    'file'=>$request->file('image'),
                    'setting'=>$image_setting,
                    'path'=>public_path('storage/pictures/payment/'),
                    'modul'=>'payment',
                    'data'=>$data
                ];
                $image_service = ImageServices::imageUser($image_data);
                if($image_service['status'] == true){
                    $imageName = $image_service['namaImage'];
                }
            }
        }


        try {
            $pay = new Payment();
            $pay->journal_id = $request->journal_id;
            $pay->payer_name = $request->payer_name;
            $pay->payer_rekening = $request->payer_rekening;
            $pay->payer_bank = $request->payer_bank;
            $pay->mybank_id = $request->mybank_id;
            $pay->price = (int)str_replace(',', '', $request->price);
            $pay->image = $imageName;
            $pay->description = $request->description;
            $pay->status = false;
            $pay->created_by = auth()->user()->id;
            $pay->save();

            if($pay){
                $invoice = new Invoice();
                $invoice->payment_id = $pay->id;
                $invoice->code = $pay->id.time();
                $invoice->price = $pay->price;
                $invoice->status = true;
                $invoice->created_by = auth()->user()->id;
                $invoice->save();

                $mybank = Mybank::findOrFail($pay->mybank_id);
                $mybank->update(['balance' => $mybank->balance + $pay->price]);

                for ($i=0; $i < $countNaskah ; $i++) {
                    $naskah[$i] = Naskah::create([
                        'payment_id' => $pay->id,
                        'journal_id' => $request->journal_id,
                        'name' => $request->manuscript_title[$i],
                        'number' => $request->manuscript_number[$i],
                        'link' => $request->manuscript_link[$i],
                        'created_by' => $request->created_by[$i],
                    ]);
                }

                // $point = new JournalPoint();
                // $point->journal_id = $request->journal_id;
                // $point->user_id = $journal->created_by;
                // $point->point = $countNaskah * 2;
                // $point->status = 1;
                // $point->save();
            }

            Alert::success('Sukses', 'Data pembayaran berhasil ditambahkan.');
            return redirect()->route('payment.index');

        } catch (Exception $error) {
            dd($error->getMessage());
            Alert::error('Error', $error->getMessage());
            return back()->withInput();
        }

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Payment::findOrFail($id);
        return view('admin.journals.payment.edit', [
            'data' => $data,
            'naskah' => Naskah::where('journal_id', $data->journal_id)->where('payment_id', $id)->get(),
            'journals' => Journal::all(),
            'mybank' => Mybank::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $imageName = '';
        $countNaskah = count($request->manuscript_title);

        if($request->manuscript_title[0] != null || $request->manuscript_link[0] != null){
            $journal       = Journal::findOrFail($request->journal_id);
            $journalStock  = $journal->total;

            if($countNaskah > $journalStock){

                Alert::error('Error', 'Slot tidak cucup, slot tersisa '.$journalStock);
                return back()->withInput();
            }else{
                $updateStock   = $journalStock - $countNaskah;
                $currentStock  = $journal->update(['total' => $updateStock]);
            }
        }

        if($request->image != null){
            $validate = $request->validate([
                'image' =>'image|mimes:jpeg,png,jpg,gif|dimensions:max_width=1500,max_height:1500',
            ]);

            $image_setting = [
                'ori_width'=>config('app.img_size.ori_width'),
                'ori_height'=>config('app.img_size.ori_height'),
                'mid_width'=>config('app.img_size.mid_width'),
                'mid_height'=>config('app.img_size.mid_height'),
                'thumb_width'=>config('app.img_size.thumb_width'),
                'thumb_height'=>config('app.img_size.thumb_height')
            ];

            if($request->file('image') != null){
                $data = array(
                    'skala11' => array(
                        'width'=>$request->input('1_1_width'),
                        'height'=>$request->input('1_1_height'),
                        'x'=>$request->input('1_1_x'),
                        'y'=>$request->input('1_1_y')
                    )
                );

                $image_data = [
                    'file'=>$request->file('image'),
                    'setting'=>$image_setting,
                    'path'=>public_path('storage/pictures/payment/'),
                    'modul'=>'payment',
                    'data'=>$data
                ];
                $image_service = ImageServices::imageUser($image_data);
                if($image_service['status'] == true){
                    $imageName = $image_service['namaImage'];
                }
            }
        }


        try {
            $pay = Payment::findOrFail($id);
            $pay->journal_id = $request->journal_id;
            $pay->payer_name = $request->payer_name;
            $pay->payer_rekening = $request->payer_rekening;
            $pay->payer_bank = $request->payer_bank;
            $pay->mybank_id = $request->mybank_id;
            $pay->price = $request->price;
            if($request->file('image') != null){
                $pay->image = $imageName;
            }
            $pay->description = $request->description;
            $pay->created_by = auth()->user()->id;
            $pay->save();

            if($pay && $request->manuscript_title[0] != null){
                for ($i=0; $i < $countNaskah ; $i++) {
                    $naskah[$i] = Naskah::create([
                        'payment_id' => $pay->id,
                        'journal_id' => $request->journal_id,
                        'name' => $request->manuscript_title[$i],
                        'number' => $request->manuscript_number[$i],
                        'link' => $request->manuscript_link[$i],
                        'created_by' => $request->created_by[$i],
                    ]);
                }

            }

            Alert::success('Sukses', 'Data pembayaran berhasil diupdate.');
            return redirect()->route('payment.index');

        } catch (Exception $error) {
            dd($error);
            Alert::error('Error', $error->getMessage());
            return back()->withInput();
        }
    }

    public function destroy($id)
    {
        //
    }

    public function naskahDelete($id)
    {
        $naskah = Naskah::findOrFail($id);
        $journal = Journal::findOrFail($naskah->journal_id)->increment('total');

        if($journal){
            $naskah->delete();
        }

        Alert::success('Deleted', 'Naskah berhasil dihapus.');
        return back()->withInput();
    }

    public function invoice(Request $request){
        return view('admin.journals.payment.invoice',[
            'payment' => Payment::findOrfail($request->id),
            'invoice' => Invoice::where('payment_id', $request->id)->first(),
            'naskah'  => Naskah::where('payment_id', $request->id)->get()
        ]);
    }

}
