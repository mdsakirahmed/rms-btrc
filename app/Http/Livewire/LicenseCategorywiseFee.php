<?php

namespace App\Http\Livewire;

use App\Models\LicenseCategory;
use Livewire\Component;

class LicenseCategorywiseFee extends Component
{
    public $license_category;

    public function mount(LicenseCategory $license_category){
        $this->license_category = $license_category;
    }

    public function render()
    {
        $this->category_wise_fees = $this->license_category->category_wise_fees;
        return view('livewire.license-categorywise-fee')
        ->extends('layouts.backend.app', ['title' => 'License category wise fee'])
        ->section('content');
    }
}
