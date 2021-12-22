<?php

namespace App\Http\Livewire;

use App\Models\License as ModelsLicense;
use App\Models\LicenseCategory;
use App\Models\LicenseSubCategory;
use App\Models\Payment;
use App\Models\User;
use Livewire\Component;
use DateTime;

class License extends Component
{
    public $licenses, $licenseCategories, $licenseSubCategories, $selected_id;
    public $form = null, $users, $user_id, $license_number, $fee, $instalment, $license_category_id, $license_sub_category_id, $expire_date;
    public $license_holder = [], $payments = null;

    public function create()
    {
        $this->form = true;
        $this->license_number = rand(88888888, 99999999);
        $this->user_id = $this->fee = $this->instalment = $this->license_category = $this->license_sub_category = $this->expire_date = $this->selected_id = null;
    }

    public function submit()
    {
        $valivate_data = $this->validate([
            'license_number' => 'required',
            'fee' => 'required',
            'instalment' => 'required',
            'user_id' => 'required',
            'license_category_id' => 'required',
            'license_sub_category_id' => 'required',
            'expire_date' => 'required',
        ]);

        if ($this->selected_id) {
            $license = ModelsLicense::find($this->selected_id);
            $license->update($valivate_data);
            $license->payments()->delete();
        } else {
            $license = ModelsLicense::create($valivate_data);
        }
        if($license){
            $begin_date = new DateTime(date('Y-m-d'));
            $end_date = new DateTime($this->expire_date);
            $total_days = $begin_date->diff($end_date->modify('+1 month'))->days;
            $gap_day_of_each_instalmant = intval($total_days / $this->instalment);
            for ($instalment = 1; $instalment <= $this->instalment; $instalment++) {
                $payment = new Payment();
                $payment->license_id = $license->id;
                $payment->amount = $this->fee / $this->instalment;
                $payment->last_date_of_payment = $begin_date->modify('+' . $gap_day_of_each_instalmant . ' day');
                $payment->save();
            }
            $this->create(); //Clear form
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Done!']);
        }else{
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'License not created!']);
        }
    }

    public function select(ModelsLicense $license, $form = null)
    {
        $this->selected_id = $license->id;
        if ($form) {
            $this->form = true;
            $this->license_number = $license->license_number;
            $this->fee = $license->fee;
            $this->instalment = $license->instalment;
            $this->user_id = $license->user_id;
            $this->license_category_id = $license->license_category_id;
            $this->license_sub_category_id = $license->license_sub_category_id;
            $this->expire_date = $license->expire_date;
        }
    }

    public function destroy()
    {
        ModelsLicense::find($this->selected_id)->payments()->delete();
        ModelsLicense::find($this->selected_id)->delete();
        $this->selected_id = null;
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Deleted!']);
    }

    public function licenseHolder(ModelsLicense $license)
    {
        $this->license_holder = [
            'name' => $license->user->name ?? null,
            'email' => $license->user->email ?? null,
            'phone' => $license->user->phone ?? null,
        ];
        $this->payments = $license->payments;
    }

    public function changePaymentStatus(Payment $payment, $status)
    {
        if($status == 'paid'){
            $payment->paid = true;
            $payment->save();
        }else{
            $payment->paid = false;
            $payment->save();
        }
        $this->payments = $payment->license->payments; //For re load update payments data
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Updated!']);
    }

    public function mount()
    {
        $this->licenses =  ModelsLicense::latest()->get();
        $this->users =  User::latest()->get();
        $this->licenseCategories =  LicenseCategory::latest()->get();
        $this->licenseSubCategories =  LicenseSubCategory::latest()->get();
    }

    public function render()
    {
        $this->licenses =  ModelsLicense::latest()->get();
        return view('livewire.license')->layout('layouts.backend.app');
    }
}
