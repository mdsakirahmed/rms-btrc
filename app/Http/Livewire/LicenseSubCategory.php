<?php

namespace App\Http\Livewire;

use App\Models\LicenseSubCategory as ModelsLicenseSubCategory;
use Livewire\Component;

class LicenseSubCategory extends Component
{
    public $licenseSubCategories, $form, $selected_id;

    public function showForm()
    {
        $this->form = true;
        $this->name = $this->file = $this->selected_id = null;
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required|string',
        ]);
        if($this->selected_id){
            $model = ModelsLicenseSubCategory::find($this->selected_id);
        }else{
            $model = new ModelsLicenseSubCategory;
        }
        $model->name =  $this->name;
        $model->save();
        $this->name = $this->form = $this->selected_id = null;
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Done!']);
    }

    public function selectForEdit(ModelsLicenseSubCategory $licenseSubCategory){
        $this->name = $licenseSubCategory->name;
        $this->form = true;
        $this->selected_id = $licenseSubCategory->id;
    }

    public function selectForDelete(ModelsLicenseSubCategory $licenseSubCategory){
        $this->selected_id = $licenseSubCategory->id;
    }

    public function destroy(){
        ModelsLicenseSubCategory::find($this->selected_id)->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Deleted!']);
        $this->selected_id = null;
    }

    public function mount(){
        $this->licenseSubCategories = ModelsLicenseSubCategory::latest()->get();
    }

    public function render()
    {
        $this->licenseSubCategories = ModelsLicenseSubCategory::latest()->get();
        return view('livewire.license-sub-category')->extends('layouts.backend.app', ['title' => 'Sub license category'])
        ->section('content');
    }
}
