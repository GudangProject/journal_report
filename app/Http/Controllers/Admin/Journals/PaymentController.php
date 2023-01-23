<?php

namespace App\Http\Controllers\Admin\Journals;

use App\Http\Controllers\Controller;
use App\Models\Journals\Journal;
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
            'journals' => Journal::where('status', true)->get(),
            'mybank' => Mybank::all()
        ]);
    }

    public function store(Request $request)
    {
        $imageName = '';
        $countNaskah = count($request->manuscript_title);

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
            $pay->price = $request->price;
            $pay->image = $imageName;
            $pay->description = $request->description;
            $pay->status = true;
            $pay->created_by = auth()->user()->id;
            $pay->save();

            if($pay){
                for ($i=0; $i < $countNaskah ; $i++) {
                    $naskah[$i] = Naskah::create([
                        'journal_id' => $request->journal_id,
                        'name' => $request->manuscript_title[$i],
                        'link' => $request->manuscript_link[$i],
                    ]);
                }
            }

            Alert::success('Sukses', 'Data pembayaran berhasil ditambahkan.');
            return redirect()->route('payment.index');

        } catch (Exception $error) {
            dd($error);
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
            'naskah' => Naskah::where('journal_id', $data->journal_id)->get(),
            'journals' => Journal::where('status', true)->get(),
            'mybank' => Mybank::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $imageName = '';
        $countNaskah = count($request->manuscript_title);

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
            $pay->image = $imageName;
            $pay->description = $request->description;
            $pay->status = true;
            $pay->created_by = auth()->user()->id;
            $pay->save();

            if($pay && $request->manuscript_title[0] != null){
                for ($i=0; $i < $countNaskah ; $i++) {
                    $naskah[$i] = Naskah::create([
                        'journal_id' => $request->journal_id,
                        'name' => $request->manuscript_title[$i],
                        'link' => $request->manuscript_link[$i],
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
        Naskah::findOrFail($id)->delete();
        Alert::success('Deleted', 'Naskah berhasil dihapus.');
        return back()->withInput();
    }


}
