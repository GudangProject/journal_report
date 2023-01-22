<?php

namespace App\Http\Controllers\Admin\Journals;

use App\Http\Controllers\Controller;
use App\Models\Journals\Journal;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class JournalController extends Controller
{

    public function index()
    {
        return view('admin.journals.index');
    }

    public function create()
    {
        return view('admin.journals.create');
    }

    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'nama_jurnal'=>'required|max:255|unique:journals',
            'volume'=>'required|unique:journals',
            'jumlah_naskah'=>'required',
            // 'preview'=>'required',
            // 'content'=>'required',
            // 'image'=>'required|image|mimes:jpeg,png,jpg,gif|dimensions:max_width=1500,max_height:1500',
        ]);

        // $image_setting = [
        //     'ori_width'=>config('app.img_size.ori_width'),
        //     'ori_height'=>config('app.img_size.ori_height'),
        //     'mid_width'=>config('app.img_size.mid_width'),
        //     'mid_height'=>config('app.img_size.mid_height'),
        //     'thumb_width'=>config('app.img_size.thumb_width'),
        //     'thumb_height'=>config('app.img_size.thumb_height')
        // ];

        // $image = '';
        // if($request->file('image') != null){
        //     $data = array(
        //         'skala169' => array(
        //             'width'=>$request->input('16_9_width'),
        //             'height'=>$request->input('16_9_height'),
        //             'x'=>$request->input('16_9_x'),
        //             'y'=>$request->input('16_9_y')
        //         ),
        //         'skala43' => array(
        //             'width'=>$request->input('4_3_width'),
        //             'height'=>$request->input('4_3_height'),
        //             'x'=>$request->input('4_3_x'),
        //             'y'=>$request->input('4_3_y')
        //         ),
        //         'skala11' => array(
        //             'width'=>$request->input('1_1_width'),
        //             'height'=>$request->input('1_1_height'),
        //             'x'=>$request->input('1_1_x'),
        //             'y'=>$request->input('1_1_y')
        //         )
        //     );

        //     $image_data = [
        //         'file'=>$request->file('image'),
        //         'setting'=>$image_setting,
        //         'path'=>public_path('storage/posts/'),
        //         'modul'=>'posts',
        //         'data'=>$data
        //     ];

        //     $image_service = ImageServices::Crop($image_data);
        //     if($image_service['status'] == true){
        //         $image = $image_service['name'];
        //     }
        // }

        // $author = array_filter($request->author);

        try{
            $save = new Journal();
            $save->nama_jurnal = $request->nama_jurnal;
            $save->volume = $request->volume;
            $save->jumlah_naskah = $request->jumlah_naskah;
            $save->status = 1;
            // $save->slug = Str::slug($request->title);
            // $save->prefix = $request->prefix;
            // $save->category_id = $request->category_id;
            // $save->preview = $request->preview;
            // $save->content = $request->content;
            // $save->image = $image;
            // $save->caption = $request->caption;
            // $save->tags = $request->tags;
            // $save->type = $request->type;
            // $save->created_by = auth()->user()->id;
            $save->save();


            Cache::flush('journals');

            return redirect()->route('journals.index')->with('message', $save->nama_jurnal.' | Berhasil ditambahkan!');
        }catch(Exception $error){
            dd($error);
            return redirect()->route('journals.index')->with('message', $error->getMessage());
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
