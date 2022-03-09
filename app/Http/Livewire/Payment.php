<?php

namespace App\Http\Livewire;

use App\Models\License;
use App\Models\Payment as ModelsPayment;
use Livewire\Component;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\Bank;
use App\Models\Branch;
use App\Models\Expiration;
use App\Models\Operator;
use PDF;

class Payment extends Component
{
    public $payment_for_pay;

    public function select_payment_for_pay(ModelsPayment $payment){
        $this->payment_for_pay = $payment;
    }

    public function mount(){
        $this->operator = Operator::find(request()->operator);
        if($this->operator){
            $this->operator_id = $this->operator->id;
        }
    }

    public function render()
    {
        if($this->operator){
            $expirations = Expiration::latest()->where('operator_id', $this->operator->id)->get();
        }else{
            $expirations = Expiration::latest()->get();
        }
        return view('livewire.payment', [
            'expirations' => $expirations,
            'banks' => Bank::latest()->get(),
            'branches' => Branch::latest()->get(),
        ])->layout('layouts.backend.app');
    }
}
