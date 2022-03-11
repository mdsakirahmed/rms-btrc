<?php

namespace App\Http\Livewire;

use App\Models\License;
use App\Models\Payment as ModelsPayment;
use Livewire\Component;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\Bank;
use App\Models\Branch;
use App\Models\Expiration;
use App\Models\LicenseCategory;
use App\Models\LicenseSubCategory;
use App\Models\Operator;
use Carbon\Carbon;
use PDF;

class Payment extends Component
{
    public $payment_for_pay, $vat, $late_fee, $bank_id, $branch_id;
    public $bank_search_key, $branch_search_key;
    // public $license_categories, $license_sub_categories, $operators;
    public $category_search_key, $sub_category_search_key, $operator_search_key, $category_id, $sub_category_id, $operator_id;

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
        $this->payment_for_pay = $this->vat = $this->late_fee = $this->bank_id = $this->branch_id = $this->bank_search_key = $this->branch_search_key = null;
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Success !']);
    }

    public function chose_bank(Bank $bank){
        $this->bank_id = $bank->id;
        $this->branch_id = null;
    }

    public function chose_branch(Branch $branch){
        $this->branch_id = $branch->id;
    }

    public function mount(){
        $this->operator = Operator::find(request()->operator);
    }

    public function render()
    {
        return view('livewire.payment', [
            'expirations' => $this->get_expirations(),
            'banks' => Bank::where('name', 'like', '%'.$this->bank_search_key.'%')->latest()->get(),
            'branches' => Branch::where('bank_id', $this->bank_id)->where('name', 'like', '%'.$this->branch_search_key.'%')->latest()->get() ?? [],
        ])->layout('layouts.backend.app');
    }

    public function get_expirations(){
        if(!request()->operator && !request()->expiration){
            $expirations = collect();
            $this->categories = LicenseCategory::where('name', 'like', '%'.$this->category_search_key.'%')->latest()->get();
            $this->sub_categories = LicenseSubCategory::where('name', 'like', '%'.$this->sub_category_search_key.'%')->latest()->get();
            $this->operators = collect();
        }else{
            $expirations = Expiration::latest()->get();
        }

        if(request()->operator){
            $expirations = $expirations->where('operator_id', request()->operator);
        }
        if(request()->expiration){
            $expirations = $expirations->where('id', request()->expiration);
        }
        return $expirations;
    }
}
