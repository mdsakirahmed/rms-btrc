<?php

namespace App\Http\Livewire;

use App\Models\License;
use Livewire\Component;

class MyLicense extends Component
{
    public $licenses;

    public function render()
    {
        $this->licenses = auth()->user()->licenes;
        return view('livewire.my-license')->layout('layouts.backend.app');
    }
}
