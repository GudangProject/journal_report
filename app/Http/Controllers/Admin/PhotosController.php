<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PhotoContent;
use App\Models\Photos;
use App\Services\ImageServices;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use RealRashid\SweetAlert\Facades\Alert;

class PhotosController extends Controller
{

    public function index()
    {
        return view('admin.photos.index');
    }

    public function create()
    {
        return view('admin.photos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'caption'=>'required',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $image = '';
        if($request->file('image')){
            $data = [
            'file'=>$request->file('image'),
            'path'=>public_path('storage/photos/'),
            'modul'=>'image'
            ];
            $upload = ImageServices::uploadImage($data);
            if($upload['status'] == true){
                $image = $upload['name'];
            }else{
                Alert::error('Failed', 'Gagal upload file');
                return back();
            }
        }

        try{
            $save = new Photos();
            $save->title = $request->title;
            $save->slug = $request->slug;
            $save->caption = $request->caption;
            $save->content = $request->content;
            $save->status = 1;
            $save->created_by = auth()->user()->id;

            if($image){
                $save->image = $image;
            }

            $save->save();

            Cache::flush("photos");

            return redirect()->route('photos.index')->with('message', "$save->title berhasil ditambahkan");
        }catch(Exception $error){
            return redirect()->route('photos.index')->with('message', $error->getMessage());
        }
    }


    public function show($id)
    {
        return view('admin.photos.detail', [
            'data' => Photos::findOrFail($id),
            'photoContent' => PhotoContent::where('photo_id', $id)->orderBy('created_at')->get()
        ]);
    }

    public function edit($id)
    {
        // dd(Photos::findOrFail($id));
        return view('admin.photos.edit', [
            'data' => Photos::findOrFail($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'image'=>'image|mimes:jpeg,png,jpg,gif',
        ]);

        if($request->image != null){
            $image = '';
            if($request->file('image')){
                $data = [
                'file'=>$request->file('image'),
                'path'=>public_path('storage/photos/'),
                'modul'=>'image'
                ];
                $upload = ImageServices::uploadImage($data);
                if($upload['status'] == true){
                    $image = $upload['name'];
                }else{
                    Alert::error('Failed', 'Gagal upload file');
                    return back();
                }
            }
        }

        try{
            $save = Photos::findOrFail($id);
            $save->title = $request->title;
            $save->slug = $request->slug;
            $save->caption = $request->caption;
            $save->content = $request->content;
            $save->updated_by = auth()->user()->id;

            if($request->image != null){
                $save->image = $image;
            }

            $save->save();

            Cache::flush("images-$request->slug");

            return redirect()->route('photos.index')->with('message', "$save->title berhasil diupdate");
        }catch(Exception $error){
            return redirect()->route('photos.index')->with('message', $error->getMessage());
        }
    }

    public function destroy($id)
    {
        //
    }
}