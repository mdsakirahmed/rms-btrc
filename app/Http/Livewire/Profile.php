<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;
    public $user, $image, $name, $email, $old_password, $new_password, $confirm_password;

    public function info_update(){
        $valid_data = $this->validate([
            'image' => 'nullable|image|max:500',
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email,'.$this->user->id,
        ]);
        if($this->image){
            $valid_data['image'] = 'storage/'.$this->image->store('profile-images', 'public');
        }else{
            unset($valid_data['image']);
        }
        $this->user->update($valid_data);
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
        return view('livewire.profile')->extends('layouts.backend.app', ['title' => 'Profile'])
        ->section('content');
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
