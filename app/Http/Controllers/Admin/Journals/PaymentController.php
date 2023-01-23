<?php

namespace App\Http\Controllers\Admin\Journals;

use App\Http\Controllers\Controller;
use App\Models\Journals\Journal;
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
        ]);
    }

    public function store(Request $request)
    {
        $imageName = '';
        dd($request);
        // if($request->image != null){
        //     $validate = $request->validate([
        //         'image' =>'required|image|mimes:jpeg,png,jpg,gif|dimensions:max_width=1500,max_height:1500',
        //     ]);

        //     $image_setting = [
        //         'ori_width'=>config('app.img_size.ori_width'),
        //         'ori_height'=>config('app.img_size.ori_height'),
        //         'mid_width'=>config('app.img_size.mid_width'),
        //         'mid_height'=>config('app.img_size.mid_height'),
        //         'thumb_width'=>config('app.img_size.thumb_width'),
        //         'thumb_height'=>config('app.img_size.thumb_height')
        //     ];

        //     if($request->file('image') != null){
        //         $data = array(
        //             'skala11' => array(
        //                 'width'=>$request->input('1_1_width'),
        //                 'height'=>$request->input('1_1_height'),
        //                 'x'=>$request->input('1_1_x'),
        //                 'y'=>$request->input('1_1_y')
        //             )
        //         );

        //         $image_data = [
        //             'file'=>$request->file('image'),
        //             'setting'=>$image_setting,
        //             'path'=>public_path('storage/pictures/payment/'),
        //             'modul'=>'payment',
        //             'data'=>$data
        //         ];
        //         $image_service = ImageServices::imageUser($image_data);
        //         if($image_service['status'] == true){
        //             $imageName = $image_service['namaImage'];
        //         }
        //     }
        // }

        try {

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
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }


}
