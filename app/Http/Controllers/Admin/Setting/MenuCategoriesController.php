<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\MenuCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Str;

class MenuCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.menus.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            if(isset($request->id)){
                $save = MenuCategory::findOrFail($request->id);
                $save->name         = $request->name;
                $save->slug         = Str::slug($request->name);
                $save->description  = $request->description;
                $save->status       = $request->status;
                // $save->parent_id    = $request->parent_id ? $request->parent_id : 0;
                $save->created_by   = auth()->user()->id;
                $save->created_at   = Carbon::now();
                $save->save();
            }else{
                $save = new MenuCategory();
                $save->name         = $request->name;
                $save->slug         = Str::slug($request->name);
                $save->description  = $request->description;
                $save->status       = $request->status;
                // $save->parent_id    = $request->parent_id ? $request->parent_id : 0;
                $save->created_by   = auth()->user()->id;
                $save->created_at   = Carbon::now();
                $save->save();
            }

            return redirect()->route('menuscategories.index')->with('message', ucwords($save->name).' | Berhasil ditambahkan!');
        }catch(Exception $error){
            return redirect()->route('menuscategories.index')->with('message', $error->getMessage());
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
}
