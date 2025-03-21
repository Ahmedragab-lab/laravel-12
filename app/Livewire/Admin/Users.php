<?php
namespace App\Livewire\Admin;

use App\Models\User;
use App\Traits\livewireResource;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

class Users extends Component
{
    use livewireResource;

    public $name, $email, $password, $type, $image,$phone, $search;
    public $user;
    public $filter = '';
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';
    public $perPage = 10;

    public function setSortBy($sortByField)
    {
        if ($this->sortBy === $sortByField) {
            $this->sortDir = ($this->sortDir == "ASC") ? 'DESC' : "ASC";
            return;
        }
        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:users,name,' . $this->obj?->id,
            'email' => 'required|email|unique:users,email,' . $this->obj?->id,
            'password' => 'nullable|min:6',
            'image' => 'nullable', // Validating image
            'phone' => 'nullable|numeric',
        ];
    }

    public function beforeSubmit()
    {
        $this->data['type'] = 'user';
        if ($this->password) {
            $this->data['password'] = bcrypt($this->password);
        } else {
            unset($this->data['password']);
        }
        if ($this->image && $this->image instanceof UploadedFile) {
            if ($this->obj && $this->obj->image !== $this->image) {
                delete_file($this->obj->image);
            }
            // dd($this->data);
            $this->image = $this->data['image'] = store_file($this->image, 'users');
        }
    }
    
public function beforeDelete($id)
{
    if (auth()->id() === (int) $id) {
        session()->flash('error', 'لا يمكنك حذف حسابك الحالي.');
        return false;
    }
    return true;
}
public function render()
{
    $users = User::where('type', 'user') // Filter only users with type 'user'
        ->when($this->search, fn($q) => $q->where('name', 'LIKE', "%" . $this->search . "%"))
        ->orderBy($this->sortBy, $this->sortDir)
        ->paginate($this->perPage);

    return view('livewire.admin.users', compact('users'))
        ->extends('admin.layouts.master')
        ->section('content');
}

}
