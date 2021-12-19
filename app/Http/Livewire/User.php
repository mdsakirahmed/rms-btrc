<?php

namespace App\Http\Livewire;

use App\Models\User as ModelsUser;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class User extends Component
{
    public $users, $roles;
    public $name, $email, $password, $role, $selected_user_id, $password_confirmation;

    public function create()
    {
        $this->name = $this->email = $this->password = $this->password_confirmation = $this->role = $this->selected_user_id = null;
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$this->selected_user_id,
            'password' => 'required|string|min:4|confirmed',
            'password_confirmation' => 'required',
            'role' => 'required',
        ]);
        $user = ModelsUser::updateOrCreate([
            'id' => $this->selected_user_id
        ], [
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);
        $user->syncRoles($this->role);
        $this->create();//Ready for new create
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'User Successfully Done!']);
    }

    public function selectForEdit(ModelsUser $user){
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->roles()->first()->id ?? null;
        $this->form = true;
        $this->selected_user_id = $user->id;
    }

    public function selectForDelete(ModelsUser $user){
        $this->selected_user_id = $user->id;
    }

    public function destroy(){
        if($this->selected_user_id == auth()->user()->id){
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'You can\'t delete your self!']);
        }else{
            ModelsUser::find($this->selected_user_id)->delete();
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Deleted!']);
        }
        $this->selected_user_id = null;
    }

    public function mount(){
        $this->users =  ModelsUser::latest()->get();
        $this->roles =  Role::latest()->get();
    }

    public function render()
    {
        $this->users =  ModelsUser::latest()->get();
        return view('livewire.user')->layout('layouts.backend.app');
    }
}
