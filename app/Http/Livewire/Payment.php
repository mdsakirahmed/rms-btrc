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
use Carbon\Carbon;
use PDF;

class Payment extends Component
{
    public $payment_for_pay, $vat, $late_fee, $bank_id, $branch_id;

    public function select_payment_for_pay(ModelsPayment $payment){
        $this->payment_for_pay = $payment;
    }

    public function submit(){
        $this->validate([
            'payment_for_pay' => 'required',
            'vat' => 'required|numeric',
            'bank_id' => 'required|exists:banks,id',
            'branch_id' => 'required|exists:branches,id',
        ]);

        if($this->payment_for_pay->last_date_of_payment->isPast()){
            $this->validate([
                'late_fee' => 'required|numeric'
            ]);
        }

        $this->payment_for_pay->update([
            'vat' => $this->vat,
            'bank_id' => $this->bank_id,
            'branch_id' => $this->branch_id,
            'vat' => $this->vat,
            'late_fee' => $this->late_fee ?? 0,
            'payment_date' => Carbon::now(),
            'paid' => true
        ]);
        $this->payment_for_pay = $this->vat = $this->late_fee = $this->bank_id = $this->branch_id = null;
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Success !']);
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
            'branches' => Branch::where('bank_id', $this->bank_id)->get() ?? [],
        ])->layout('layouts.backend.app');
    }
}
