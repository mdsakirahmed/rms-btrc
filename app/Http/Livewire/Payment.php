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
    public $category_search_key, $sub_category_search_key, $operator_search_key, $category_id, $sub_category_id, $operator_id, $expiration_id;

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

    public function chose_category(LicenseCategory $category){
        if($this->category_id == $category->id){ // if double click on same element, assign null
            $this->category_id = null;
        }else{
            $this->category_id = $category->id;
        }
        $this->operator_id = $this->operator = null; //make null category and sub-category
    }

    public function chose_sub_category(LicenseSubCategory $sub_category){
        if($this->sub_category_id == $sub_category->id){ // if double click on same element, assign null
            $this->sub_category_id = null;
        }else{
            $this->sub_category_id = $sub_category->id;
        }
        $this->operator_id = $this->operator = null; //make null category and sub-category
    }

    public function chose_operator(Operator $operator){
        $this->operator_id = $operator->id;
        $this->operator = $operator;
    }

    public function mount(){
        $this->operator = Operator::find(request()->operator);
        $this->operator_id = request()->operator;
        $this->expiration_id = request()->expiration;
        if($this->operator){
            $this->category_id = $this->operator->category_id;
            $this->sub_category_id = $this->operator->sub_category_id;
        }
    }

    public function render()
    {
        $this->get_operators();
        $this->get_expirations();
        return view('livewire.payment', [
            'categories' => LicenseCategory::where('name', 'like', '%'.$this->category_search_key.'%')->latest()->get(),
            'sub_categories' => LicenseSubCategory::where('name', 'like', '%'.$this->sub_category_search_key.'%')->latest()->get(),
            'banks' => Bank::where('name', 'like', '%'.$this->bank_search_key.'%')->latest()->get(),
            'branches' => Branch::where('bank_id', $this->bank_id)->where('name', 'like', '%'.$this->branch_search_key.'%')->latest()->get() ?? [],
        ])->layout('layouts.backend.app');
    }

    public function get_operators(){
        $this->operators = Operator::latest()->get();
        if($this->category_id){
            $this->operators = $this->operators->where('category_id', $this->category_id);
        }
        if($this->sub_category_id){
            $this->operators = $this->operators->where('sub_category_id', $this->sub_category_id);
        }

        if($this->operator_id){
            $this->operators = $this->operators->where('id', $this->operator_id);
        }
    }

    public function get_expirations(){
        $this->expirations = collect();
        if($this->operator_id){
            $this->expirations = Expiration::where('operator_id', $this->operator_id)->latest()->get();
        }
        if($this->expiration_id){
            $this->expirations = Expiration::where('id', $this->expiration_id)->latest()->get();
        }
    }
}
