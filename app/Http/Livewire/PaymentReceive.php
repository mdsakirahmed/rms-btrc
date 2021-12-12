<?php

namespace App\Http\Livewire;

use App\Models\LicenseCategory;
use App\Models\LicenseSubCategory;
use App\Models\Operator;
use App\Models\PaymentReceive as ModelsPaymentReceive;
use App\Models\ReceiveFee;
use App\Models\ReceivePeriod;
use Livewire\Component;

class PaymentReceive extends Component
{
    public $paymentReceives, $form, $selected_id;
    public $licenseCategories, $licenseSubCategories, $operators, $receive_fees, $receive_periods,
    $license_category_id, $license_sub_category_id, $operator_id, $receive_fee_id,
    $receive_period_id, $receivable_amount, $receive_date, $receive_amount, $receive_vat, $receive_let_fee;

    public function showForm()
    {
        $this->form = true;
        $this->selected_id = null;
    }

    public function submit()
    {
        $validate_data = $this->validate([
            'license_category_id' => 'required',
            'license_sub_category_id' => 'required',
            'operator_id' => 'required',
            'receive_fee_id' => 'required',
            'receive_period_id' => 'required',
            'receivable_amount' => 'required',
            'receive_date' => 'required',
            'receive_amount' => 'required',
            'receive_vat' => 'required',
            'receive_let_fee' => 'required',
        ]);
        // dd($validate_data);
        if($this->selected_id){
            ModelsPaymentReceive::find($this->selected_id)->update($validate_data);
        }else{
            ModelsPaymentReceive::create($validate_data);
        }
        $this->form = $this->selected_id = null;
        $this->license_category_id = $this->license_sub_category_id = $this->operator_id = $this->receive_fee_id = $this->receive_period_id = $this->receivable_amount
        = $this->receive_date = $this->receive_amount = $this->receive_vat = $this->receive_let_fee = null;
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Done!']);
    }

    public function selectForEdit(ModelsPaymentReceive $paymentReceive){
        // $this->name = $paymentReceive->name;
        $this->form = true;
        $this->selected_id = $paymentReceive->id;
        $this->license_category_id = $paymentReceive->license_category_id;
        $this->license_sub_category_id = $paymentReceive->license_sub_category_id;
        $this->operator_id = $paymentReceive->operator_id;
        $this->receive_fee_id = $paymentReceive->receive_fee_id;
        $this->receive_period_id = $paymentReceive->receive_period_id;
        $this->receivable_amount = $paymentReceive->receivable_amount;
        $this->receive_date = $paymentReceive->receive_date;
        $this->receive_amount = $paymentReceive->receive_amount;
        $this->receive_vat = $paymentReceive->receive_vat;
        $this->receive_let_fee = $paymentReceive->receive_let_fee;;
    }

    public function selectForDelete(ModelsPaymentReceive $paymentReceive){
        $this->selected_id = $paymentReceive->id;
    }

    public function destroy(){
        ModelsPaymentReceive::find($this->selected_id)->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Deleted!']);
        $this->selected_id = null;
    }
    
    public function mount(){
        $this->paymentReceives = ModelsPaymentReceive::latest()->get();
        $this->licenseCategories = LicenseCategory::latest()->get();
        $this->licenseSubCategories = LicenseSubCategory::latest()->get();
        $this->operators = Operator::latest()->get();
        $this->receive_fees = ReceiveFee::latest()->get();
        $this->receive_periods = ReceivePeriod::latest()->get();
    }

    public function render()
    {
        $this->paymentReceives = ModelsPaymentReceive::latest()->get();
        return view('livewire.payment-receive')->layout('layouts.backend.app');
    }
}
