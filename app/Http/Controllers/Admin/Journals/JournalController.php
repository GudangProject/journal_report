<?php

namespace App\Http\Controllers\Admin\Journals;

use App\Http\Controllers\Controller;
use App\Models\Journals\Journal;
use App\Models\Journals\Knowledge;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class JournalController extends Controller
{

    public function index()
    {
        return view('admin.journals.index');
    }

    public function create()
    {
        return view('admin.journals.create', [
            'knowledge' => Knowledge::all()
        ]);
    }

    public function store(Request $request)
    {
        // dd($request);
        $countVolume = count($request->volume);
        try{
            for($i = 0; $i < $countVolume; $i++){
                $save[$i] = Journal::create([
                    'knowledge_id' => $request->knowledge_id,
                    'name' => $request->name,
                    'volume' => $request->volume[$i],
                    'number' => $request->number[$i],
                    'month' => $request->month[$i],
                    'year' => $request->year[$i],
                    'semester' => $request->semester[$i],
                    'link_issue' => $request->link_issue[$i],
                    'indexasi' => $request->indexasi,
                    'afiliate' => $request->afiliate,
                    'total' => $request->total,
                    'created_by' => auth()->user()->id,
                ]);
            }

            Cache::flush('journals');

            return redirect()->route('journals.index')->with('message', $save->name.' | Berhasil ditambahkan!');
        }catch(Exception $error){
            dd($error);
            Alert::error('Error', $error->getMessage());
            return back()->withInput();
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
