<?php

namespace App\Http\Livewire;

use App\Models\LicenseCategory as ModelsLicenseCategory;
use Livewire\Component;

class LicenseCategory extends Component
{

    public $name, $duration_year, $duration_month, $selected_license_category;

    public function create()
    {
        $this->name = $this->duration_year = $this->duration_month = null;
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required|string',
            'duration_year' => 'required|numeric',
            'duration_month' => 'required|numeric',
        ]);
        if($this->selected_license_category){
            $model = $this->selected_license_category;
        }else{
            $model = new ModelsLicenseCategory;
        }
        $model->name =  $this->name;
        $model->duration_year =  $this->duration_year;
        $model->duration_month =  $this->duration_month;
        $model->save();
        $this->create();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Done!']);
    }

    public function selectForEdit(ModelsLicenseCategory $licenseCategory){
        $this->selected_license_category = $licenseCategory;
        $this->name = $this->selected_license_category->name;
        $this->duration_year = $this->selected_license_category->duration_year;
        $this->duration_month = $this->selected_license_category->duration_month;
    }

    public function delete(ModelsLicenseCategory $licenseCategory){
        $licenseCategory->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Deleted!']);
        $this->selected_id = null;
    }


    public function render()
    {
        $this->licenseCategories = ModelsLicenseCategory::all();
        return view('livewire.license-category')
        ->extends('layouts.backend.app', ['title' => 'License category'])
        ->section('content');
    }
}
