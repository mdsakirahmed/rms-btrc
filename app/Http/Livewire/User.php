<?php

namespace App\Http\Livewire;

use App\Models\User as ModelsUser;
use Livewire\Component;

class User extends Component
{
    public $users =null;

    public function mount(){
        $this->users =  ModelsUser::latest()->get();
    }
    
    public function render()
    {
        return view('livewire.user')->layout('layouts.backend.app');
    }
}
