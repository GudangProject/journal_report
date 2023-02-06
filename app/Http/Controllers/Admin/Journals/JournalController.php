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
        return view('admin.journals.index', [
            'data' => Journal::orderByDesc('created_at')->get()
        ]);
    }

    public function create()
    {
        return view('admin.journals.create', [
            'knowledge' => Knowledge::all()
        ]);
    }

    public function store(Request $request)
    {

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
                    'total' => $request->total[$i],
                    'manager_by' => '-',
                    'manager_phone' => '-',
                    'created_by' => auth()->user()->id,
                ]);
            }

            return redirect()->route('journals.index')->with('message', 'Jurnal '.$request->name.' Berhasil ditambahkan!');
        }catch(Exception $error){
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
        return view('admin.journals.edit', [
            'data' => Journal::find($id),
            'knowledge' => Knowledge::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $countNewVolume = 0;

        if($request->newvolume[0] != null){
            $countNewVolume = count($request->newvolume);
        }

        try{
            $save = Journal::where('id', $id)->update([
                'knowledge_id' => $request->knowledge_id,
                'name' => $request->name,
                'volume' => $request->volume,
                'number' => $request->number,
                'month' => $request->month,
                'year' => $request->year,
                'semester' => $request->semester,
                'link_issue' => $request->link_issue,
                'indexasi' => $request->indexasi,
                'afiliate' => $request->afiliate,
                'total' => $request->total,
                'manager_by' => '-',
                'manager_phone' => '-',
                'created_by' => auth()->user()->id,
            ]);

            if($countNewVolume > 0){
                for($i = 0; $i < $countNewVolume; $i++){
                    $newsave[$i] = Journal::create([
                        'knowledge_id' => $request->knowledge_id,
                        'name' => $request->name,
                        'volume' => $request->newvolume[$i],
                        'number' => $request->newnumber[$i],
                        'month' => $request->newmonth[$i],
                        'year' => $request->newyear[$i],
                        'semester' => $request->newsemester[$i],
                        'link_issue' => $request->newlink_issue[$i],
                        'indexasi' => $request->indexasi,
                        'afiliate' => $request->afiliate,
                        'total' => $request->newtotal[$i],
                        'manager_by' => '-',
                        'manager_phone' => '-',
                        'created_by' => auth()->user()->id,
                    ]);
                }
            }

            return redirect()->route('journals.index')->with('message', 'Jurnal Berhasil diupdate!');
        }catch(Exception $error){
            Alert::error('Error', $error->getMessage());
            return back()->withInput();
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
