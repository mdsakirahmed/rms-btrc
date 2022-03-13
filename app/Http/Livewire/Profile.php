<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Profile extends Component
{
    public $user, $name, $email, $old_password, $new_password, $confirm_password;

    public function info_update(){
        $valied_data = $this->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email,'.$this->user->id,
        ]);
        $this->user->update($valied_data);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Success !']);
    }

    public function password_update(){
        $this->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:4',
            'confirm_password' => 'required|same:new_password',
        ]);
        $this->user->update(['password' => Hash::make($this->new_password)]);
        $this->old_password = $this->new_password = $this->confirm_password = null;
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Success !']);
    }

    public function mount(){
        $this->user = auth()->user();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
    }

    public function render()
    {
        $this->password_check();
        return view('livewire.profile')->layout('layouts.backend.app');
    }

    public function password_check(){
        $this->old_password_correct = false;
        $this->new_and_confirm_password_are_same = false;
        $this->password_message = null;
        if($this->old_password){
            if (Hash::check($this->old_password, $this->user->password)) {
                $this->old_password_correct = true;
            }else{
                $this->password_message = 'Old password is not correct';
            }
        }
        if (strlen($this->new_password) > 4 && $this->new_password == $this->confirm_password) {
            $this->new_and_confirm_password_are_same = true;
        }
    }
}
