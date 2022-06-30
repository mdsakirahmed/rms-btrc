<?php

namespace App\Http\Livewire;

use App\Models\Payment;
use Livewire\Component;

class PaymentHistry extends Component
{
    public $selected_payment_for_delete;
    public function render()
    {
        return view('livewire.payment-histry',[
            'payments' => Payment::where(function($query){
                if(!auth()->user()->can('master')){
                    $query->where('created_by', auth()->user()->id);
                }
            })->latest()->paginate(10)
        ])
        ->extends('layouts.backend.app', ['title' => 'Payment History'])
        ->section('content');
    }

    public function select_for_delete(Payment $payment){
        $this->selected_payment_for_delete = $payment;
    }

    public function delete(){
        if($this->payment->created_at->diffInDays()<=3 || auth()->user()->can('master')) {
            if($this->selected_payment_for_delete){
                $this->selected_payment_for_delete->delete();
                $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Success !']);
            }else{
                $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'Selected payment not found !']);
            }
        }else{
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'Action Disabled !']);
        }
    }
}
