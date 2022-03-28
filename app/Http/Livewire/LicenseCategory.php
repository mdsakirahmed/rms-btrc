<?php

namespace App\Http\Livewire;

use App\Models\LicenseCategory as ModelsLicenseCategory;
use Carbon\Carbon;
use Livewire\Component;

class LicenseCategory extends Component
{

    public $name, $license_fee, $duration_year, $duration_month, $payment_iteration; //Form variables
    // public $selected_license_category;

    public function create()
    {
        $this->name = $this->license_fee = $this->duration_year = $this->duration_month = $this->payment_iteration = $this->selected_license_category = null;
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required|string',
        ]);
        if($this->selected_license_category){
            $model = $this->selected_license_category;
        }else{
            $model = new ModelsLicenseCategory;
        }
        $model->name =  $this->name;
        $model->license_fee =  $this->license_fee;
        $model->duration_year =  $this->duration_year;
        $model->duration_month =  $this->duration_month;
        $model->payment_iteration =  (int)$this->payment_iteration ?? 0;
        $model->save();
        $this->create();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Done!']);
    }

    public function selectForEdit(ModelsLicenseCategory $licenseCategory){
        $this->selected_license_category = $licenseCategory;
        $this->name = $this->selected_license_category->name;
        $this->license_fee = $this->selected_license_category->license_fee;
        $this->duration_year = $this->selected_license_category->duration_year;
        $this->duration_month = $this->selected_license_category->duration_month;
        $this->payment_iteration = $this->selected_license_category->payment_iteration;
    }

    public function selectForDelete(ModelsLicenseCategory $licenseCategory){
        $this->selected_license_category = $licenseCategory;
    }

    public function destroy(){
        $this->selected_license_category->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Deleted!']);
        $this->selected_id = null;
    }

    public function calculate_iteration(){
        $this->payment_iteration = (Carbon::now()->diffInMonths(Carbon::now()->addYears($this->duration_year ?? 0)->addMonths($this->duration_month ?? 0)) / 2) ?? 0;
    }


    public function render()
    {
        $this->licenseCategories = ModelsLicenseCategory::latest()->get();
        return view('livewire.license-category')->layout('layouts.backend.app');
    }
}
