<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Post;


class AuthorsDetailTable extends DataTableComponent
{

    public string $defaultSortColumn = 'published_at';
    public string $defaultSortDirection = 'desc';

    public $selected_id;
    public $user_id;

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
            Column::make('Category'),
            Column::make('Publish','published_at')->sortable(),
            Column::make('Author'),
            Column::make('Status'),
            Column::make('View', 'counter')->sortable(),
            Column::make('Action'),
        ];
    }


    public function query(): Builder
    {
        $user = auth()->user();

        $data = Post::query();
        $data = $data->where('status', '!=', 3);
        $data = $data->where('created_by', '=', $this->user_id);

        $data = $data->when($this->getFilter('search'), fn ($query, $term) => $query->where('title', 'like', '%'.$term.'%'));
        $data = $data->when($this->getFilter('category'), fn ($query, $category) => $query->whereHas('getCategory', fn ($q) => $q->where('slug', $category)));
        $data = $data->when($this->getFilter('status'), fn ($query, $status) => $query->where('status', $status));

        return $data;



    }

    public function rowView(): string
    {
        return 'admin.authors.detail.table';
    }

    public function modalsView(): string
    {
        return 'admin.authors.modal';
    }
}
