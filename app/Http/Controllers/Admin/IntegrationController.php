<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Integration;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class IntegrationController extends Controller
{
    public function index()
    {
        return view('admin.integrations.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        // dd($id);

        // $data = Integration::find($id)->first();

        // try{
        //     $row = Http::get($data->api.'posts')->json();
        // }catch(ConnectionException $error){
        //     return $error->getMessage();
        // }


        return view('admin.integrations.show', [
            'data'=>Integration::find($id)->first(),
        ]);
    }

    public function edit($id)
    {
        //
    }
}
