<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\PostLinkage;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PostLinkageTable extends DataTableComponent
{
    public array $bulkActions = [
        'addSelected' => 'Tambahkan',
    ];

    public string $defaultSortColumn = 'published_at';
    public string $defaultSortDirection = 'desc';

    public $selected_id;
    public $parent_id;

    public function addSelected()
    {
        if (count($this->selectedKeys)) {
            $rows = Post::whereIn('id', $this->selectedKeys)->pluck('id');
            foreach ($rows as $k=>$v) {
               $save[$k] = new PostLinkage();
               $save[$k]->parent_id = $this->parent_id;
               $save[$k]->child_id = $v;
               $save[$k]->save();
            }
            return redirect()->route('postlinkages.show', $this->parent_id)->with('message', 'Data Berhasil ditambahkan!');
        }

    }

    public function statusModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalStatus');
    }

    public function updateStatus(){
        $data = Post::findOrFail($this->selected_id);
        ($data->status == 1 ? $data->update(['status' => 2]) : $data->update(['status' => 1]));
        $this->dispatchBrowserEvent('closeModalStatus');
    }

    public function deleteModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalDelete');
    }

    public function deleteStatus(){
        Post::findOrFail($this->selected_id)->update(['status' => 3]);
        $this->dispatchBrowserEvent('closeModalDelete');
    }

    public function columns(): array
    {
        return [
            Column::make('Title'),
            Column::make('Category')->addClass('text-center'),
        ];
    }

    public function query(): Builder
    {
        $already = PostLinkage::pluck('child_id');
        return Post::query()
                ->where('status', '!=', 3)
                ->whereNotIn('id', $already)
                ->when($this->getFilter('search'), fn ($query, $term) => $query->where('title', 'like', '%'.$term.'%'));
    }

    public function rowView(): string
    {
        return 'admin.posts.linkages.table';
    }

    public function modalsView(): string
    {
        return 'admin.posts.linkages.modal';
    }
}
