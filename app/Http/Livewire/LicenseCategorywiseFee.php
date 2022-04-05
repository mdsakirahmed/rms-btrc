<?php

namespace App\Http\Livewire;

use App\Models\FeeType;
use App\Models\LicenseCategory;
use App\Models\LicenseCategoryWiseFeeType;
use Livewire\Component;

class LicenseCategorywiseFee extends Component
{
    public $license_category, $selected_category_wise_fee;

    public function create()
    {
        $this->fee_type = $this->period_month = $this->amount = $this->late_fee = $this->vat = $this->tax = $this->selected_category_wise_fee = null;
    }

    public function submit()
    {
        $this->validate([
            'fee_type' => 'required|numeric|exists:fee_types,id',
            'period_month' => 'required|numeric',
            'amount' => 'required|numeric',
            'late_fee' => 'required|numeric',
            'vat' => 'required|numeric',
            'tax' => 'required|numeric',
        ]);

        if ($this->selected_category_wise_fee) {
            $this->selected_category_wise_fee->update([
                'category_id' => $this->license_category->id,
                'fee_type_id' => $this->fee_type,
                'period_month' => $this->period_month,
                'amount' => $this->amount,
                'late_fee' => $this->late_fee,
                'vat' => $this->vat,
                'tax' => $this->tax,
            ]);
            $this->create();
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully updated !']);
        } else {
            if (LicenseCategoryWiseFeeType::where('category_id', $this->license_category->id)->where('fee_type_id', $this->fee_type)->count() > 0) {
                $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'Already exist with this fee type!']);
            } else {
                LicenseCategoryWiseFeeType::create([
                    'category_id' => $this->license_category->id,
                    'fee_type_id' => $this->fee_type,
                    'period_month' => $this->period_month,
                    'amount' => $this->amount,
                    'late_fee' => $this->late_fee,
                    'vat' => $this->vat,
                    'tax' => $this->tax,
                ]);
                $this->create();
                $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully added !']);
            }
        }
    }

    public function selectForEdit(LicenseCategoryWiseFeeType $licenseCategoryWiseFeeType)
    {
        $this->selected_category_wise_fee = $licenseCategoryWiseFeeType;
        $this->fee_type = $this->selected_category_wise_fee->fee_type_id;
        $this->period_month = $this->selected_category_wise_fee->period_month;
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
}
