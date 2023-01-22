<?php

namespace App\Http\Controllers\Admin\Journals;

use App\Http\Controllers\Controller;
use App\Models\Journals\Knowledge;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class KnowledgeController extends Controller
{
    public function index()
    {
        return view('admin.journals.knowledge.index');
    }

    public function create()
    {
        return view('admin.journals.knowledge.create');
    }

    public function store(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'name' => 'required|unique:knowledge'
        ],
        [
            'name.unique' => 'Nama rumpun ilmu sudah digunakan.'
        ]);

        try {
            $save = Knowledge::create([
                'name' => Str::upper($request->name),
            ]);

            Alert::success('Berhasil', 'Data '.$save->name.' berhasil ditambahkan');
            return redirect()->route('knowledge.index');

        } catch (Exception $e) {
            Alert::error('Error', $e->getMessage());
        }
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        return view('admin.journals.knowledge.edit', [
            'data' => Knowledge::find($id)
        ]);
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);

        try {
            $save = Knowledge::where('id', $id)->update([
                'name' => Str::upper($request->name),
            ]);

            Alert::success('Berhasil', 'Data '.$save->name.' berhasil diperbaharui');
            return redirect()->route('knowledge.index');

        } catch (Exception $e) {
            Alert::error('Error', $e->getMessage());
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
