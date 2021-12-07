<?php

namespace App\Http\Livewire;

use App\Models\User as ModelsUser;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class User extends Component
{
    public $form = null;

    public $users, $roles;
    public $name, $email, $password, $role;

    public function showForm()
    {
        $this->form = true;
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:4',
            'role' => 'required',
        ]);
        $user = ModelsUser::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);
        $user->assignRole($this->role);
        $this->name = $this->email = $this->password = $this->role = $this->form = null;
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'User Created Successfully!']);
    }

    public function alertSuccess()
    {
        $this->dispatchBrowserEvent('alert', 
                ['type' => 'success',  'message' => 'User Created Successfully!']);
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function alertError()
    {
        $this->dispatchBrowserEvent('alert', 
                ['type' => 'error',  'message' => 'Something is Wrong!']);
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function alertInfo()
    {
        $this->dispatchBrowserEvent('alert', 
                ['type' => 'info',  'message' => 'Going Well!']);
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
