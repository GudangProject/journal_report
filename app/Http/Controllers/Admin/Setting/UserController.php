<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use App\Models\User;
use App\Services\ImageServices;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Traits\HasRoles;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{

    public function index()
    {
        return view('admin.users.index');
    }


    public function create()
    {
        $data['roles'] = Roles::all();

        return view('admin.users.create', ['data' => $data]);
    }


    public function store(Request $request)
    {
        $validate = $request->validate([
            'name'  => 'required',
            'email' => 'required|unique:users',
            'image' =>'required|image|mimes:jpeg,png,jpg,gif|dimensions:max_width=1500,max_height:1500',
        ]);

        $image_setting = [
            'ori_width'=>config('app.img_size.ori_width'),
            'ori_height'=>config('app.img_size.ori_height'),
            'mid_width'=>config('app.img_size.mid_width'),
            'mid_height'=>config('app.img_size.mid_height'),
            'thumb_width'=>config('app.img_size.thumb_width'),
            'thumb_height'=>config('app.img_size.thumb_height')
        ];

        $imageName = '';
        if($request->file('image') != null){
            $data = array(
                'skala11' => array(
                    'width'=>$request->input('1_1_width'),
                    'height'=>$request->input('1_1_height'),
                    'x'=>$request->input('1_1_x'),
                    'y'=>$request->input('1_1_y')
                )
            );

            $image_data = [
                'file'=>$request->file('image'),
                'setting'=>$image_setting,
                'path'=>public_path('storage/pictures/users/'),
                'modul'=>'user',
                'data'=>$data
            ];
            $image_service = ImageServices::imageUser($image_data);
            if($image_service['status'] == true){
                $imageName = $image_service['namaImage'];
            }
        }

        $password = Str::random(8);
        $user_type = json_encode($request->user_type);

        if($validate){
            try{
                $user = User::create([
                    'name'          => $request->name,
                    'slug'          => Str::slug($request->name),
                    'email'         => $request->email,
                    'company'       => $request->company,
                    'image'         => $imageName,
                    'password'      => Hash::make('cdaaptnia'),
                    'status'        => 1,
                    'created_by'    => auth()->user()->id,
                ]);

                $user->assignRole($request->roles);

                // $email_data = array(
                //     'name'      => $request->name,
                //     'email'     => $request->email,
                //     'password'  => $password,
                // );

                // if($request->name != 'author'){
                //     Mail::send('admin.users.welcome_email', $email_data, function ($message) use ($email_data) {
                //         $message->to($email_data['email'], $email_data['name'])
                //             ->subject('Konfirmasi Akun Sulbar Kemenag')
                //             ->from(config('app.email'), config('app.name'));
                //     });
                // }


                return redirect()->route('users.index')->with('message', ucwords($request->name).' | Berhasil ditambahkan!');
            }catch(Exception $error){
                return redirect()->route('users.index')->with('message', $error->getMessage());
            }
        }
    }


    public function show()
    {
        $data['user'] =  User::where('id', auth()->user()->id)->first();
        return view('admin.users.detail', [
            'data' => $data
        ]);
    }


    public function edit($id)
    {

        $user                   = User::findOrFail($id);
        $user_type              = str_replace(',', '', $user->user_type);

        $data['user']           = $user;
        $data['email']          = $user->email;
        $data['company']        = $user->company;
        $data['roles']          = Roles::all();
        $data['current_role']   = str_replace(array('[', ']', '"'), '', $user->getRoleNames());

        return view('admin.users.edit', ['data' => $data]);
    }


    public function update(Request $request, $id)
    {
        $imageName = '';

        if($request->image != null){
            $validate = $request->validate([
                'name'  => 'required',
                'email' => 'required',
                'image' =>'required|image|mimes:jpeg,png,jpg,gif|dimensions:max_width=1500,max_height:1500',
            ]);

            $image_setting = [
                'ori_width'=>config('app.img_size.ori_width'),
                'ori_height'=>config('app.img_size.ori_height'),
                'mid_width'=>config('app.img_size.mid_width'),
                'mid_height'=>config('app.img_size.mid_height'),
                'thumb_width'=>config('app.img_size.thumb_width'),
                'thumb_height'=>config('app.img_size.thumb_height')
            ];

            if($request->file('image') != null){
                $data = array(
                    'skala11' => array(
                        'width'=>$request->input('1_1_width'),
                        'height'=>$request->input('1_1_height'),
                        'x'=>$request->input('1_1_x'),
                        'y'=>$request->input('1_1_y')
                    )
                );

                $image_data = [
                    'file'=>$request->file('image'),
                    'setting'=>$image_setting,
                    'path'=>public_path('storage/pictures/users/'),
                    'modul'=>'user',
                    'data'=>$data
                ];
                $image_service = ImageServices::imageUser($image_data);
                if($image_service['status'] == true){
                    $imageName = $image_service['namaImage'];
                }
            }
        }

        $user_type = json_encode($request->user_type);
        try{
            $user   = User::findOrFail($id);
            $update = User::where('id', $id)->update([
                'name'          => $request->name,
                'slug'          => Str::slug($request->name),
                'image'         => $imageName ? $imageName : $user->image,
                'email'         => $request->email,
                'company'       => $request->company,
                'user_type'     => $user_type ? str_replace(array('[', ']', '"'), '', $user_type) : '',
                'updated_by'    => auth()->user()->id,
            ]);

            $user->syncRoles($request->roles);

            return redirect()->route('users.index')->with('message', ucwords($request->name).' | Berhasil diperbaharui!');
        }catch(Exception $error){
            return redirect()->route('users.index')->with('message', $error->getMessage());
        }
    }


    public function updatePassword(Request $request)
    {
        User::where('id', auth()->user()->id)->update([
            'password'      => Hash::make($request->password),
            'updated_by'    => auth()->user()->id,
        ]);

        Alert::success('Berhasil', 'Password berhasil diubah!');

        return back();

    }

    public function updateProfileSetting(Request $request)
    {
        // dd($request);
        $user = User::findOrFail($request->id);
        if($request->email != $user->email){
            $user->email_verified_at = null;
            $user->save();
        }

        $dataImageSetting = array();
        $dataImageSetting = [
            'ori_width'=>config('app.img_size.ori_width'),
            'ori_height'=>config('app.img_size.ori_height'),
            'mid_width'=>config('app.img_size.mid_width'),
            'mid_height'=>config('app.img_size.mid_height'),
            'thumb_width'=>config('app.img_size.thumb_width'),
            'thumb_height'=>config('app.img_size.thumb_height')
        ];

        $namaImage = null;
        if($request->file('image') != null){
            $dataImage = [
              'file'=>$request->file('image'),
              'setting'=>$dataImageSetting,
              'path'=>public_path('storage/pictures/users/'),
              'modul'=>'user',
              'watermark'=>array('status'=>$request->input('watermark'),
                            'text'=>config('app.name'),
                            'font'=>public_path('fonts/glyphicons-halflings-regular.ttf'))
            ];

            $uploadImg = ImageServices::imageDimensi($dataImage);
            if($uploadImg['status'] == true){
                $namaImage = $uploadImg['namaImage'];
            }
        }

        $update = User::where('email', $request->email)->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'company'   => $request->company,
            'phone'     => $request->phone,
            'image'     => $namaImage != null ? $namaImage : $user->image,
        ]);

        return back()->with('message', 'Data berhasil diperbaharui!');;

    }

    public function destroy($id)
    {
        //
    }
}
