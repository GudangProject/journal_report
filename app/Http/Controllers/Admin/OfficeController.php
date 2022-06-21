<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Office;
use App\Models\OfficeCategory;
use App\Services\ImageServices;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class OfficeController extends Controller
{
    public function index()
    {
        return view('admin.offices.index');
    }

    public function create()
    {
        return view('admin.offices.create', [
            'categories' => OfficeCategory::where('status', 1)->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|max:255|unique:offices',
            'slug'=>'required|unique:offices',
            'category_id'=>'required',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif|dimensions:max_width=1500,max_height:1500',
        ]);

        $image_setting = [
            'ori_width'=>config('app.img_size.ori_width'),
            'ori_height'=>config('app.img_size.ori_height'),
            'mid_width'=>config('app.img_size.mid_width'),
            'mid_height'=>config('app.img_size.mid_height'),
            'thumb_width'=>config('app.img_size.thumb_width'),
            'thumb_height'=>config('app.img_size.thumb_height')
        ];

        $image = '';
        if($request->file('image') != null){
            $data = array(
                'skala169' => array(
                    'width'=>$request->input('16_9_width'),
                    'height'=>$request->input('16_9_height'),
                    'x'=>$request->input('16_9_x'),
                    'y'=>$request->input('16_9_y')
                ),
                'skala43' => array(
                    'width'=>$request->input('4_3_width'),
                    'height'=>$request->input('4_3_height'),
                    'x'=>$request->input('4_3_x'),
                    'y'=>$request->input('4_3_y')
                ),
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
                'path'=>public_path('storage/offices/'),
                'modul'=>'offices',
                'data'=>$data
            ];

            $image_service = ImageServices::Crop($image_data);
            if($image_service['status'] == true){
                $image = $image_service['name'];
            }
        }

        try{
            $save = new Office();
            $save->title = $request->title;
            $save->slug = Str::slug($request->title);
            $save->description = $request->description;
            $save->content = $request->content;
            $save->information = $request->information;
            $save->image = $image;
            $save->status = $request->status;
            $save->category_id = $request->category_id;
            $save->created_by = auth()->user()->id;
            $save->save();

            Cache::flush("offices");

            return redirect()->route('offices.index')->with('message', "$save->title berhasil ditambahkan");
        }catch(Exception $error){
            return redirect()->route('offices.index')->with('message', $error->getMessage());
        }
    }

    public function edit($id)
    {
        return view('admin.offices.edit', [
            'data' => Office::findOrFail($id),
            'categories' => OfficeCategory::where('status', 1)->get()
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>[Rule::unique('offices')->ignore($id, 'id')],
            'slug'=>[Rule::unique('offices')->ignore($id, 'id')],
            'category_id'=>'required',
            'image'=>'image|mimes:jpeg,png,jpg,gif|dimensions:max_width=1500,max_height:1500',
        ]);

        $image_setting = [
            'ori_width'=>config('app.img_size.ori_width'),
            'ori_height'=>config('app.img_size.ori_height'),
            'mid_width'=>config('app.img_size.mid_width'),
            'mid_height'=>config('app.img_size.mid_height'),
            'thumb_width'=>config('app.img_size.thumb_width'),
            'thumb_height'=>config('app.img_size.thumb_height')
        ];

        $image = '';
        if($request->file('image') != null){
            $data = array(
                'skala169' => array(
                    'width'=>$request->input('16_9_width'),
                    'height'=>$request->input('16_9_height'),
                    'x'=>$request->input('16_9_x'),
                    'y'=>$request->input('16_9_y')
                ),
                'skala43' => array(
                    'width'=>$request->input('4_3_width'),
                    'height'=>$request->input('4_3_height'),
                    'x'=>$request->input('4_3_x'),
                    'y'=>$request->input('4_3_y')
                ),
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
                'path'=>public_path('storage/offices/'),
                'modul'=>'offices',
                'data'=>$data
            ];

            $image_service = ImageServices::Crop($image_data);

            // dd($image_service);
            if($image_service['status'] == true){
                $image = $image_service['name'];
            }
        }

        try{
            $save = Office::findOrFail($id);
            $save->title = $request->title;
            $save->slug = Str::slug($request->title);
            $save->description = $request->description;
            $save->content = $request->content;
            $save->information = $request->information;
            if($image){
                $save->image    = $image;
            }
            $save->status = $request->status;
            $save->category_id = $request->category_id;
            $save->updated_by = auth()->user()->id;
            $save->save();

            Cache::flush("office-$data->slug");

            return redirect()->route('offices.index')->with('message', "$save->title berhasil diupdate");
        }catch(Exception $error){
            return redirect()->route('offices.index')->with('message', $error->getMessage());
        }
    }

}
