<?php

namespace App\Http\Livewire;

use App\Models\FeeType;
use App\Models\LicenseCategory;
use App\Models\LicenseCategoryWiseFeeType;
use Livewire\Component;

class LicenseCategorywiseFee extends Component
{
    public $license_category, $selected_category_wise_fee;

    public function mount(LicenseCategory $license_category)
    {
        $this->license_category = $license_category;
    }

    public function render()
    {
        $this->category_wise_fees = LicenseCategoryWiseFeeType::where('category_id', $this->license_category->id)->get();
        $this->fee_types = FeeType::all();
        return view('livewire.license-categorywise-fee')
            ->extends('layouts.backend.app', ['title' => 'License category wise fee'])
            ->section('content');
    }

    public function create()
    {
        $this->fee_type_id = $this->amount = $this->late_fee = $this->vat = $this->tax = $this->selected_category_wise_fee = null;
    }

    public function submit()
    {
        $this->category_id = $this->license_category->id;        
        $data = $this->validate([
            'category_id' => 'required|exists:license_categories,id|unique:license_category_wise_fee_types,category_id,'.($this->selected_category_wise_fee->id ?? '' ).',id,fee_type_id,'.$this->fee_type_id,
            'fee_type_id' => 'required|exists:fee_types,id',
            'amount' => 'required|numeric',
            'late_fee' => 'required|numeric',
            'vat' => 'required|numeric',
            'tax' => 'required|numeric',
        ],[
            'category_id.unique' => 'Alreary exist this fee type for this category'
        ],[
            'category_id' => 'Category',
            'fee_type_id' => 'Fee type',
        ]);

        if ($this->selected_category_wise_fee) {
            $this->selected_category_wise_fee->update($data);
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully updated !']);
        } else {
            LicenseCategoryWiseFeeType::create($data);
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully added !']);
        }            
        $this->create();
    }

    public function selectForEdit(LicenseCategoryWiseFeeType $licenseCategoryWiseFeeType)
    {
        $this->selected_category_wise_fee = $licenseCategoryWiseFeeType;
        $this->fee_type_id = $this->selected_category_wise_fee->fee_type_id;
        $this->amount = $this->selected_category_wise_fee->amount;
        $this->late_fee = $this->selected_category_wise_fee->late_fee;
        $this->vat = $this->selected_category_wise_fee->vat;
        $this->tax = $this->selected_category_wise_fee->tax;
    }

    public function delete(LicenseCategoryWiseFeeType $licenseCategoryWiseFeeType)
    {
        $licenseCategoryWiseFeeType->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully deleted !']);
    }

   
}
