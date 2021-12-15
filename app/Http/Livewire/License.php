<?php

namespace App\Http\Livewire;

use App\Models\License as ModelsLicense;
use App\Models\LicenseCategory;
use App\Models\LicenseSubCategory;
use Livewire\Component;

class License extends Component
{
    public $licenses, $licenseCategories, $licenseSubCategories, $selected_id;
    public $form = null, $name, $email, $phone, $address, $license_number, $fee, $instalment, $license_category_id, $license_sub_category_id, $expire_date;

    public function showForm(){
        $this->form = true;
        $this->license_number = rand(88888888,99999999);
    }

    public function submit(){
        $valivate_data = $this->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'license_number' => 'required',
            'fee' => 'required',
            'instalment' => 'required',
            'license_category_id' => 'required',
            'license_sub_category_id' => 'required',
            'expire_date' => 'required',
        ]);

        if($this->selected_id){
            ModelsLicense::find($this->selected_id)->update($valivate_data);
        }else{
            ModelsLicense::create($valivate_data);
        }
        $this->form = $this->name = $this->email = $this->phone = $this->address = $this->license_number = $this->fee = $this->instalment = $this->license_category = $this->license_sub_category = $this->expire_date = null ;
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'User Successfully Done!']);
    }

    public function select(ModelsLicense $license, $form = null){
        $this->selected_id = $license->id;
        if($form)
        $this->form = true;
    }

    public function destroy(){
        ModelsLicense::find($this->selected_id)->delete();
        $this->selected_id = null;
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Deleted!']);
    }
    
    public function mount(){
        $this->licenses =  ModelsLicense::latest()->get();
        $this->licenseCategories =  LicenseCategory::latest()->get();
        $this->licenseSubCategories =  LicenseSubCategory::latest()->get();
    }
    
    public function render(){
        $this->licenses =  ModelsLicense::latest()->get();
        return view('livewire.license')->layout('layouts.backend.app');
    }
}
