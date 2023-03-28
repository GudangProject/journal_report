<?php

namespace App\Http\Controllers\Admin\Journals;

use App\Http\Controllers\Controller;
use App\Models\Journals\Journal;
use App\Models\Journals\Loa;
use App\Models\Journals\Payment;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LoaController extends Controller
{

    public function index()
    {
        return view('admin.journals.loa.index');
    }


    public function create()
    {
        $data   = Journal::where('created_by', auth()->user()->id)->pluck('id');
        $userId = Payment::whereIn('journal_id', $data)->pluck('created_by');
        // dd($userId);
        if(auth()->user()->getRoleNames()[0] == 'super admin'){
            $journals = Journal::orderByDesc('created_at')->get();
        }else{
            $journals = Journal::where('created_by', auth()->user()->id)->orderByDesc('created_at')->get();
        }
        return view('admin.journals.loa.create',[
            'users'     => User::whereIn('id', $userId)->orderByDesc('created_at')->get(),
            'journals'  => $journals,
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
        $username = User::findOrFail($request->user_id)->name;
        try {
            $save = new Loa();
            $save->journal_id = $request->journal_id;
            $save->user_id    = $request->user_id;
            $save->username   = $username;
            $save->link       = $request->link;
            $save->created_by = auth()->user()->id;
            $save->status     = 1;
            $save->save();

            return redirect()->route('loa.index')->with('message', 'Data LoA '.$save->username.' Berhasil ditambahkan!');

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
        $data   = Journal::where('created_by', auth()->user()->id)->pluck('id');
        $userId = Payment::whereIn('journal_id', $data)->pluck('created_by');
        // dd($userId);
        if(auth()->user()->getRoleNames()[0] == 'super admin'){
            $journals = Journal::orderByDesc('created_at')->get();
        }else{
            $journals = Journal::where('created_by', auth()->user()->id)->orderByDesc('created_at')->get();
        }

        return view('admin.journals.loa.edit',[
            'users'     => User::whereIn('id', $userId)->orderByDesc('created_at')->get(),
            'journals'  => $journals,
            'data'      => Loa::findOrFail($id),
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
        $username = User::findOrFail($request->user_id)->name;
        try {
            $save = Loa::findOrFail($id);
            $save->journal_id = $request->journal_id;
            $save->user_id    = $request->user_id;
            $save->username   = $username;
            $save->link       = $request->link;
            $save->created_by = auth()->user()->id;
            $save->status     = 1;
            $save->save();

            return redirect()->route('loa.index')->with('message', 'Data LoA '.$save->username.' Berhasil ditambahkan!');

        } catch (Exception $error) {
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
