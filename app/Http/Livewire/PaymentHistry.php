<?php

namespace App\Http\Livewire;

use App\Models\Payment;
use Livewire\Component;

class PaymentHistry extends Component
{
    public function render()
    {
        return view('livewire.payment-histry',[
            'payments' => Payment::where('created_by', auth()->user()->id)->latest()->paginate(10)
        ])
        ->extends('layouts.backend.app', ['title' => 'Payment History'])
        ->section('content');
    }
}
