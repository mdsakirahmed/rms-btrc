<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FeeType extends Component
{
    public function render()
    {
        return view('livewire.fee-type')
        ->extends('layouts.backend.app', ['title' => 'Fee type'])
        ->section('content');
    }
}
