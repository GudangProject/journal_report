<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Websetting;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Image;

class WebsettingController extends Controller
{

    public function index()
    {
        return view('admin.settings.configuration', [
            'data' => Websetting::orderBy('created_at')->first(),
            'users' => User::where('status', 1)->get(),
        ]);
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
        //
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
        $logoOld    = Websetting::first()->logo;
        $pathLogo   = '/storage/assets/'.$logoOld;
        // dd($request);
        if($request->logo != null){
            if (file_exists(public_path($pathLogo))) {
                unlink(public_path($pathLogo));
            }

            $validator = Validator::make($request->all(), [
                'logo'=>'image|mimes:jpeg,png,jpg',
            ]);

            if($validator->fails()) {
                Alert::toast($validator->errors()->first(), 'error');
                return redirect()->back();
            }

            $image = $request->file('logo');
            $imageName = 'logo.'.$image->extension();
            $request->logo->storeAs('public/assets', $imageName);
        }

        try {
            $config = Websetting::findOrFail(1);
            $config->name = $request->name;
            $config->description = $request->description;

            if($request->logo != null){
                $config->logo = $imageName;
            }

            $config->save();

            Alert::success('Success', 'Configuration updated successfully...');
            return back();
        } catch (Exception $error) {
            dd($error->getMessage());
            Alert::toast($error->getMessage(), 'error');
            return back();
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
