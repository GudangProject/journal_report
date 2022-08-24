<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Officer;
use App\Services\ImageServices;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class OfficersController extends Controller
{

    public function index()
    {
        return view('admin.officers.index');
    }


    public function create()
    {
        return view('admin.officers.create');
    }


    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'name'=>'required|max:255|unique:officers',
            'preview'=>'required',
            'content'=>'required',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif|dimensions:max_width=1500,max_height:1500',
        ]);

        $image = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->storeAs('public/officers/', $image);
        // dd($image);

        $officers = Officer::latest()->first()->order;
        // dd((int)$officers);
        try{
            $save = new Officer();
            $save->name = $request->name;
            $save->position = $request->preview;
            $save->description = $request->content;
            $save->image = '/storage/officers/'.$image;
            $save->order = (int)$officers+1;
            $save->status = 1;
            $save->created_by = auth()->user()->id;
            $save->save();

            Cache::flush('officers');

            return redirect()->route('officers.index')->with('message', $save->name.' | Berhasil ditambahkan!');
        }catch(Exception $error){
            Alert::error('Error', $error->getMessage());
            return back();
            // return redirect()->route('officers.index')->with('message', $error->getMessage());
        }
    }

    public function show($id)
    {

    }


    public function edit($id)
    {
        $data = Officer::findOrFail($id);
        return view('admin.officers.edit', [
            'data' => $data
        ]);
    }


    public function update(Request $request, $id)
    {
        if($request->image != null){
            $image = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->storeAs('public/officers/', $image);
        }
        // dd($image);

        try{
            $save = Officer::findOrFail($id);
            $save->name = $request->name;
            $save->position = $request->preview;
            $save->description = $request->content;
            if($request->image != null){
                $save->image = '/storage/officers/'.$image;
            }
            $save->status = 1;
            $save->created_by = auth()->user()->id;
            $save->save();

            Cache::flush('officers');

            return redirect()->route('officers.index')->with('message', $save->name.' | Berhasil ditambahkan!');
        }catch(Exception $error){
            Alert::error('Error', $error->getMessage());
            return back();
            // return redirect()->route('officers.index')->with('message', $error->getMessage());
        }
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
}
