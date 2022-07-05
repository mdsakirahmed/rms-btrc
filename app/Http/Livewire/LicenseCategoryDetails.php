<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LicenseCategoryDetails extends Component
{
    public $license_category;

    public function mount(\App\Models\LicenseCategory $license_category){
        $this->license_category = $license_category;
    }

    public function render()
    {
        return view('livewire.license-category-details',[
            'sub_categories' => \App\Models\LicenseSubCategory::where('category_id', $this->license_category->id)->latest()->get(),
            'fee_types' => \App\Models\FeeType::where('category_id', $this->license_category->id)->latest()->get(),
        ])->extends('layouts.backend.app', ['title' => 'License category details'])
            ->section('content');
    }


    /*  FEE TYPE  */
    public function create_fee_type(){
        $this->name =
        $this->schedule_day =
        $this->schedule_month =
        $this->schedule_subtract_day =
        $this->period_month =
        $this->free_month_at_start =
        $this->period_format =
        $this->schedule_include_to_beginning_of_period =
        $this->period_start_with_issue_date =
        $this->sub_category_id =
        $this->amount =
        $this->late_fee =
        $this->vat =
        $this->tax =
        $this->selected_fee_type = null;
    }

    public function submit_fee_type(){
        $validate_data = $this->validate([
            'name' => 'required',
            'schedule_day' => 'required|numeric|min:0|max:30',
            'schedule_month' => 'required|numeric|min:0|max:12',
            'schedule_subtract_day' => 'required|numeric|min:0|max:30',
            'period_month' => 'required|numeric|min:1|max:12',
            'free_month_at_start' => 'required|numeric|min:0',
            'period_format' => 'required',
            'schedule_include_to_beginning_of_period' => 'required|boolean',
            'period_start_with_issue_date' => 'required|boolean',
            'sub_category_id' => 'nullable|exists:license_sub_categories,id',
            'amount' => 'required|numeric',
            'late_fee' => 'required|numeric',
            'vat' => 'required|numeric',
            'tax' => 'required|numeric',
        ]);
        $validate_data['category_id'] = $this->license_category->id;
        if(!is_numeric($validate_data['sub_category_id'])){
            $validate_data['sub_category_id'] = null;
        }
        if ($this->selected_fee_type) {
            $this->selected_fee_type->update($validate_data);
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Updated !']);
        } else {
            \App\Models\FeeType::create($validate_data);
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Created !']);
        }
        $this->create_fee_type();
    }

    /*  SUB CATEGORY  */
    public $sub_category_name, $selected_sub_category;
    public function create_sub_category(){
        $this->sub_category_name = $this->selected_sub_category = null;
    }

    public function submit_sub_category(){
        $this->validate([
            'sub_category_name' => 'required|string'
        ]);
        if($this->selected_sub_category){
            $this->selected_sub_category->update([
                'name' => $this->sub_category_name,
                'category_id' => $this->license_category->id,
            ]);
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Updated !']);
        }else{
            \App\Models\LicenseSubCategory::create([
                'name' => $this->sub_category_name,
                'category_id' => $this->license_category->id,
            ]);
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Created !']);
        }
        $this->create_sub_category();
    }

    public function select_sub_category(\App\Models\LicenseSubCategory $licenseSubCategory){
        $this->selected_sub_category = $licenseSubCategory;
        $this->sub_category_name = $licenseSubCategory->name;
    }

    public function delete_sub_category(){
        if( $this->selected_sub_category){
            $this->selected_sub_category->delete();
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Deleted !']);
        }else{
            $this->dispatchBrowserEvent('alert', ['type' => 'warning',  'message' => 'Item is not selected !']);
        }
    }
}
