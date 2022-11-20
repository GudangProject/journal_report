<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Exception;
use App\Models\User;

class UserTable extends DataTableComponent
{

    public string $defaultSortColumn = 'created_at';
    public string $defaultSortDirection = 'desc';

    public $selected_id;

    public function statusModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalStatus');
    }

    public function updateStatus(){
        $data = User::findOrFail($this->selected_id);
        ($data->status == 1 ? $data->update(['status' => 2]) : $data->update(['status' => 1]));
        $this->dispatchBrowserEvent('closeModalStatus');
    }

    public function confirmResetPassword($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalResetPassword');
    }

    public function resetPassword()
    {
        // dd($this->selected_id);
        try {
            $default_password = Str::random(8);
            // $default_password = 'sulsel2022';
            $user = User::findOrFail($this->selected_id);
            $user->password = 12345678;
            $user->save();

            // $email_data = array(
            //     'name' => $user->name,
            //     'email' => $user->email,
            //     'password' => $default_password,
            // );

            // Mail::send('admin.users.welcome_email', $email_data, function ($message) use ($email_data) {
            //     $message->to($email_data['email'], $email_data['name'])
            //         ->subject('Reset Password Akun Sulsel Pendis')
            //         ->from(config('app.email'), config('app.name'));
            // });


            session()->flash('message', 'Password berhasil direset, silakan melakukan login ulang');
            // session()->flash('message', 'Password berhasil direset, cek email untuk infomasi password terbaru.');
            $this->dispatchBrowserEvent('closeModalResetPassword');
            $this->dispatchBrowserEvent('openModalResetPasswordSuccess');

        } catch (Exception $e) {
            session()->flash('message', $e->getMessage());
            $this->dispatchBrowserEvent('closeModalResetPassword');
            $this->dispatchBrowserEvent('openModalResetPasswordSuccess');


        }

    }

    public function deleteModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalDelete');
    }

    public function deleteStatus(){
        $data = User::findOrFail($this->selected_id)->update(['status' => 3]);
        $this->dispatchBrowserEvent('closeModalDelete');
    }

    public function columns(): array
    {
        return [
            Column::make('Name'),
            Column::make('Email'),
            Column::make('Role Admin'),
            Column::make('Status'),
            Column::make('Action'),
        ];
    }

    public function query(): Builder
    {
        return User::query()
                ->where('status', '!=', 3)
                ->when($this->getFilter('search'), fn ($query, $term) => $query->where('name', 'like', '%'.$term.'%'));
    }

    public function rowView(): string
    {
        return 'admin.users.table';
    }

    public function modalsView(): string
    {
        return 'admin.users.modal';
    }
}
