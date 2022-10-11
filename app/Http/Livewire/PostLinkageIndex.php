<?php

namespace App\Http\Livewire;

use App\Models\PostLinkage;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PostLinkageIndex extends DataTableComponent
{
    public bool $showSearch = false;

    public array $bulkActions = [
        'deletePost' => 'Delete',
    ];

    public $postId;

    public function mount($postId){
        $this->postId = $postId;
    }
    public function columns(): array
    {
        return [
            Column::make('Title'),
            Column::make('Category')->addClass('text-center'),
            Column::make('Published')->addClass('text-center'),
        ];
    }


    public function query(): Builder
    {
        return PostLinkage::query()->with('getPost')
                ->where('parent_id', $this->postId);
    }

    public function deletePost(){
        if(count($this->selectedKeys)){
            PostLinkage::whereIn('id', $this->selectedKeys)->delete();
        }
        session()->flash('message', 'Data terkait berhasil dihapus! 😲');
        return redirect()->to('/admin/posts/postlinkages/'.$this->postId);
    }


    public function rowView(): string
    {
        return 'admin.posts.linkages.list';
    }
}
