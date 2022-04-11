<?php

namespace App\Http\Livewire;

use App\Models\Operator;
use Livewire\Component;

class OperatorWisePayments extends Component
{
    public $operator;
    public function mount(Operator $operator){
        $this->operator = $operator;
    }

    public function render()
    {
        return view('livewire.operator-wise-payments')
        ->extends('layouts.backend.app', ['title' => 'Payments'])
        ->section('content');
    }
}
