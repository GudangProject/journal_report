<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PhotoContent;
use App\Models\Photos;
use App\Services\ImageServices;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Cache;

class PhotoContentController extends Controller
{
    public function index()
    {
        //
    }

    public function create($id)
    {
        return view('admin.photos.linkage.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'parent_id'=>'required',
            'caption'=>'required',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $image = '';
        if($request->file('image')){
            $data = [
            'file'=>$request->file('image'),
            'path'=>public_path('storage/photos/linkages/'),
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
            $save = new PhotoContent();
            $save->photo_id = $request->parent_id;
            $save->caption = $request->caption;

            if($image){
                $save->image = $image;
            }

            $save->save();

            Cache::flush("photo-content");

            return redirect()->route('photos.index')->with('message', "Photo berhasil ditambahkan");
        }catch(Exception $error){
            return redirect()->route('photos.index')->with('message', $error->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function createLinkage($parent)
    {
        return view('admin.photos.linkage.create', [
            'dataParent'     => Photos::findOrFail($parent),
            'photoLinkage'   => PhotoContent::where('photo_id', $parent)->orderByDesc('created_at')->paginate(5)
        ]);
    }
}
