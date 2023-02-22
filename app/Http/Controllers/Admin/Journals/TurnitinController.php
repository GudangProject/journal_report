<?php

namespace App\Http\Controllers\Admin\Journals;

use App\Http\Controllers\Controller;
use App\Models\Journals\Journal;
use App\Models\Journals\Turnitin;
use App\Models\Payment;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TurnitinController extends Controller
{
    public function index()
    {
        return view('admin.journals.turnitin.index');
    }


    public function create()
    {
        $data   = Journal::where('created_by', auth()->user()->id)->pluck('id');
        $userId = Payment::whereIn('journal_id', $data)->pluck('created_by');
        // dd($userId);
        // if(auth()->user()->getRoleNames()[0] == 'super admin'){
        //     $journals = Journal::orderByDesc('created_at')->get();
        // }else{
        //     $journals = Journal::where('created_by', auth()->user()->id)->orderByDesc('created_at')->get();
        // }
        return view('admin.journals.turnitin.create',[
            'users'     => User::whereIn('id', $userId)->orderByDesc('created_at')->get(),
            // 'journals'  => $journals,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $save = new Turnitin();
            // $save->journal_id = $request->journal_id;
            // $save->user_id    = $request->user_id;
            $save->username                 = $request->username;
            $save->link_turnitin            = $request->link_turnitin;
            $save->link_surat_pernyataan    = $request->link_surat_pernyataan;
            $save->created_by               = auth()->user()->id;
            $save->status                   = 1;
            $save->save();

            return redirect()->route('turnitin.index')->with('message', 'Data Turnitin dan Surat Pernyataan '.$save->username.' Berhasil ditambahkan!');

        } catch (Exception $error) {
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
        // $data   = Journal::where('created_by', auth()->user()->id)->pluck('id');
        // $userId = Payment::whereIn('journal_id', $data)->pluck('created_by');
        // // dd($userId);
        // if(auth()->user()->getRoleNames()[0] == 'super admin'){
        //     $journals = Journal::orderByDesc('created_at')->get();
        // }else{
        //     $journals = Journal::where('created_by', auth()->user()->id)->orderByDesc('created_at')->get();
        // }

        return view('admin.journals.turnitin.edit',[
            // 'users'     => User::whereIn('id', $userId)->orderByDesc('created_at')->get(),
            // 'journals'  => $journals,
            'data'      => Turnitin::findOrFail($id),
        ]);
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
        try {
            $save = Turnitin::findOrFail($id);
            $save->username                 = $request->username;
            $save->link_turnitin            = $request->link_turnitin;
            $save->link_surat_pernyataan    = $request->link_surat_pernyataan;
            $save->status                   = 1;
            $save->save();

            return redirect()->route('turnitin.index')->with('message', 'Data Turnitin dan Surat Pernyataan '.$save->username.' Berhasil diperbaharui!');

        } catch (Exception $error) {
            Alert::error('Error', $error->getMessage());
            return back()->withInput();
        }
    }

    public function destroy($id)
    {
        //
    }
}
