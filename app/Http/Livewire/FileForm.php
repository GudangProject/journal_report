<?php

namespace App\Http\Livewire;

use App\Models\File;
use Livewire\Component;
use Livewire\WithFileUploads;

class FileForm extends Component
{
    use WithFileUploads;
    public $files = [];

    public function save()
    {
        $this->validate([
            'images.*' => 'image|max:1024', // 1MB Max
        ]);

        foreach ($this->images as $key => $image) {
            $this->images[$key] = $image->store('images');
        }

        $this->images = json_encode($this->images);

        File::create(['image' => $this->images]);

        session()->flash('success', 'Images has been successfully Uploaded.');

        return redirect()->back();
    }


    public function render()
    {
        return view('livewire.file-form');
    }
}
