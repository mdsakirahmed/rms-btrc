<?php

namespace App\Http\Livewire;

use App\Models\Payment as ModelsPayment;
use Livewire\Component;
use App\Models\Bank;
use App\Models\Expiration;
use App\Models\LicenseCategory;
use App\Models\LicenseSubCategory;
use App\Models\Operator;
use App\Models\PartialPayment;
use Carbon\Carbon;
use PDF;

class Payment extends Component
{
    public $payment_for_pay, $paid_amount, $vat, $late_fee, $bank_id, $pay_order_number, $journal_number, $payment_date;
    public $bank_search_key;
    public $category_search_key, $sub_category_search_key, $operator_search_key, $category_id, $sub_category_id, $operator_id, $expiration_id;

    public function select_payment_for_pay(ModelsPayment $payment){
        $this->payment_for_pay = $payment;
    }

    public function submit(){
        $this->validate([
            'payment_for_pay' => 'required', // selected payment
            'paid_amount' => 'required|numeric|min:0|max:'.$this->payment_for_pay->due(),
            'vat' => 'required|numeric|min:0',
            'bank_id' => 'required|exists:banks,id',
        ]);

        if($this->payment_for_pay->last_date_of_payment->isPast()){
            $this->validate([
                'late_fee' => 'required|numeric'
            ]);
        }

        PartialPayment::create([
            'payment_id' => $this->payment_for_pay->id,
            'paid_amount' => $this->paid_amount,
            'vat' => $this->vat,
            'late_fee' => $this->late_fee ?? 0,
            'bank_id' => $this->bank_id,
            'payment_date' => $this->payment_date,
            'pay_order_number' => $this->pay_order_number,
            'journal_number' => $this->journal_number,
        ]);
        // $this->payment_for_pay = null;
        $this->paid_amount = $this->vat = $this->late_fee = $this->bank_id = $this->bank_search_key =
        $this->pay_order_number = $this->journal_number = $this->payment_date = null;
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Success !']);
    }

    public function delete_partial_payment(PartialPayment $partialPayment){
        $partialPayment->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Success !']);
    }

    public function download_invoice(ModelsPayment $payment){
        $this->payment_for_inv_download = $payment;
        return response()->streamDownload(function () {
            PDF::loadView('pdf.payment-invoice',  ['payment' => $this->payment_for_inv_download])->download();
        }, 'Payment invoice download at -'.date('d-m-Y h-i-s').'.pdf');
    }

    public function chose_bank(Bank $bank){
        $this->bank_id = $bank->id;
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
        if($this->operator_id == $operator->id){ // if double click on same element, assign null
            $this->operator_id = $this->operator = $this->expiration_id = null;
        }else{
            $this->operator_id = $operator->id;
            $this->operator = $operator;
        }
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
        if($this->payment_for_pay){
            $this->payment_for_pay = ModelsPayment::find($this->payment_for_pay->id);
        }

        if($this->paid_amount && $this->operator){
            $this->vat = ($this->operator->category->vat_percentage/100)*$this->paid_amount;
        }

        return view('livewire.payment', [
            'categories' => LicenseCategory::where('name', 'like', '%'.$this->category_search_key.'%')->latest()->get(),
            'sub_categories' => LicenseSubCategory::where('name', 'like', '%'.$this->sub_category_search_key.'%')->latest()->get(),
            'banks' => Bank::where('name', 'like', '%'.$this->bank_search_key.'%')->latest()->get(),
        ])->layout('layouts.backend.app');
    }

    public function get_operators(){
        $this->operators = new Operator;
        if($this->category_id){
            $this->operators = $this->operators->where('category_id', $this->category_id);
        }
        if($this->sub_category_id){
            $this->operators = $this->operators->where('sub_category_id', $this->sub_category_id);
        }

        if($this->operator_id){
            // $this->operators = $this->operators->where('id', $this->operator_id);
            $this->operator = $this->operators->find($this->operator_id);
        }

        if($this->operator_search_key){
            $this->operators = $this->operators->where('name', 'like', '%'.$this->operator_search_key.'%');
        }

        $this->operators = $this->operators->latest()->get();
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
