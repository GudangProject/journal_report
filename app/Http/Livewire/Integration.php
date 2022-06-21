<?php

namespace App\Http\Livewire;

use App\Models\Post;
use app\Service;
use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Illuminate\Support\Str;

class Integration extends Component
{
    public $name, $domain, $api, $token, $category_id;
    public $pagin, $data;

    public function pagination($id)
    {
        $this->pagin = $id;
    }

    public function repost($id)
    {
        $data = Http::get($this->api.'/posts/'.$id)->json();
        try{
            $save = new Post();
            $save->code = $data['code'];
            $save->title = $data['title'];
            $save->slug = Str::slug($data['slug']);
            $save->prefix = $data['prefix'];
            $save->published_at = now();
            $save->category_id = $this->category_id;
            $save->preview = $data['preview'];
            $save->content = $data['content'];
            $save->image = $data['image'];
            $save->caption = $data['caption'];
            $save->tags = $data['tags'];
            $save->status = $data['status'];
            $save->type = $data['type'];
            $save->source = $data['url'];
            $save->created_by = auth()->user()->id;
            $save->save();
            Service::image($this->domain,$data['image']);
        }catch(Exception $error){
            dd($error->getMessage());
        }
    }

    public function render()
    {
        try{
            $row = Http::get($this->api.'/posts', ['page'=>$this->pagin])->json();
        }catch(ConnectionException $error){
            return $error->getMessage();
        }
        return view('livewire.integration', [
            'row'=>$row,
        ]);
    }
}
