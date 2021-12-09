<?php

namespace App\Http\Livewire;

use App\Models\LicenseCategory as ModelsLicenseCategory;
use Livewire\Component;

class LicenseCategory extends Component
{
    public $licenseCategories, $form, $selected_id;

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
            $model = ModelsLicenseCategory::find($this->selected_id);
        }else{
            $model = new ModelsLicenseCategory;
        }
        $model->name =  $this->name;
        $model->save();
        $this->name = $this->form = $this->selected_id = null;
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Done!']);
    }

    public function selectForEdit(ModelsLicenseCategory $licenseCategory){
        $this->name = $licenseCategory->name;
        $this->form = true;
        $this->selected_id = $licenseCategory->id;
    }

    public function selectForDelete(ModelsLicenseCategory $licenseCategory){
        $this->selected_id = $licenseCategory->id;
    }

    public function destroy(){
        ModelsLicenseCategory::find($this->selected_id)->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Deleted!']);
        $this->selected_id = null;
    }
    
    public function mount(){
        $this->licenseCategories = ModelsLicenseCategory::latest()->get();
    }

    public function render()
    {
        $this->licenseCategories = ModelsLicenseCategory::latest()->get();
        return view('livewire.license-category')->layout('layouts.backend.app');
    }
}
