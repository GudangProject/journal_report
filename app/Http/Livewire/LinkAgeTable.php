<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Post;
use App\Models\PostLinkage;

class LinkAgeTable extends DataTableComponent
{

    public string $defaultSortColumn = 'created_at';
    public string $defaultSortDirection = 'desc';

    public $selected_id, $parent_id;

    public function showModalDetail($id)
    {
        $this->selected_id = $id;
        $data = Post::findOrFail($id);
        $this->title = $data->title;
        $this->content = $data->content;
        $this->image = $data->image;
        $this->dispatchBrowserEvent('openModalDetail');
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
            // Column::make('Category')->addClass('text-center'),
            Column::make('Publish','published_at')->sortable(),
            Column::make('Action'),
        ];
    }

    public function query(): Builder
    {
        $user = auth()->user();
        $data = PostLinkage::query()->where('parent_id', $this->parent_id);

        $data = $data->when($this->getFilter('search'), fn ($query, $term) => $query->where('title', 'like', '%'.$term.'%'));

        return $data;



    }

    public function rowView(): string
    {
        return 'admin.posts.linkages.list';
    }

    public function modalsView(): string
    {
        return 'admin.posts.modal';
    }
}
