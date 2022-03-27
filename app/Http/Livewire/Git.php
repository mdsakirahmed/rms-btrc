<?php

namespace App\Http\Livewire;

use App\Models\Git as ModelsGit;
use Livewire\Component;

class Git extends Component
{
    public $gits;

    public function render()
    {
        $this->gits = ModelsGit::all();
        return view('livewire.git')->layout('layouts.backend.app');
    }
}
