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

    public function showForm()
    {
        $this->form = true;
        $this->license_number = rand(88888888, 99999999);
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
            $license = ModelsLicense::find($this->selected_id)->update($valivate_data);
        } else {
            $license = ModelsLicense::create($valivate_data);
        }
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
        $this->form = $this->user_id = $this->license_number = $this->fee = $this->instalment = $this->license_category = $this->license_sub_category = $this->expire_date = null;
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'User Successfully Done!']);
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
