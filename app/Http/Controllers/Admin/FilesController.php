<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\File;
use App\Models\FileCategory;
use App\Models\FileLinkage;
use App\Services\ImageServices;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class FilesController extends Controller
{
    public function index()
    {
        return view('admin.files.index');
    }

    public function create()
    {
        return view('admin.files.create', [
            'categories' => FileCategory::where('status', 1)->get()
        ]);
    }

    public function store(Request $request)
    {
        try{
            $save = new File();
            $save->title = $request->title;
            $save->slug = $request->slug;
            $save->name = Str::title($request->title);
            $save->description = $request->description;
            $save->status = $request->status;
            $save->category_id = $request->category_id;
            $save->created_by = auth()->user()->id;

            $save->save();

            Cache::flush("file");


            for ($i=0; $i < count($request->file); $i++) {


                $fileLinkage[$i] = FileLinkage::insert([
                    'name' => $request->file[$i]->getClientOriginalName(),
                    'type' => $request->file[$i]->getMimeType(),
                    'size' => $request->file[$i]->getSize(),
                    'file_id' => $save->id
                ]);

            }

            if($request->file)
            {
                foreach($request->file as $file)
                {
                    $name = $file->getClientOriginalName();
                    $file->move('storage/files/', $name);
                }
            }

            return redirect()->route('files.index')->with('message', "$save->title berhasil ditambahkan");
        }catch(Exception $error){
            return redirect()->route('files.index')->with('message', $error->getMessage());
        }
    }

    public function edit($id)
    {
        $data =  File::with('files')->findOrFail($id);
        // dd($data->files);
        return view('admin.files.edit', [
            'data' => File::with('files')->findOrFail($id),
            'categories' => FileCategory::where('status', 1)->get()
        ]);
    }

    public function update(Request $request, $id)
    {
        try{
            $save = File::findOrFail($id);
            $save->title = $request->title;
            $save->slug = $request->slug;
            $save->name = Str::title($request->title);
            $save->description = $request->description;
            $save->status = $request->status;
            $save->category_id = $request->category_id;
            $save->created_by = auth()->user()->id;
            $save->save();

            Cache::flush("file-$save->slug");

            foreach($save->files as $k=>$v){
                $fileLinkage[$k] = FileLinkage::findOrFail($v->id)->update([
                    'name' => $request->file[$k]->getClientOriginalName(),
                    'type' => $request->file[$k]->getMimeType(),
                    'size' => $request->file[$k]->getSize(),
                    'file_id' => $save->id
                ]);
            }

            if($request->file)
            {
                foreach($request->file as $file)
                {
                    $name = $file->getClientOriginalName();
                    $file->move('storage/files/', $name);
                }
            }

            return redirect()->route('files.index')->with('message', "$save->title berhasil ditambahkan");
        }catch(Exception $error){
            return redirect()->route('files.index')->with('message', $error->getMessage());
        }
    }
}
