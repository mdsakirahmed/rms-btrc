<?php

namespace App\Http\Livewire;

use App\Models\Payment as ModelsPayment;
use Livewire\Component;
use App\Models\Bank;
use App\Models\Expiration;
use App\Models\LicenseCategory;
use App\Models\LicenseSubCategory;
use App\Models\Operator;
use App\Models\PartialPayment;
use Carbon\Carbon;
use PDF;

class Payment extends Component
{
    public $categories, $sub_categories, $operators;
    public function render()
    {
        $this->categories = LicenseCategory::all();
        $this->sub_categories = LicenseSubCategory::all();
        $this->operators = Operator::all();

        return view('livewire.payment')
        ->extends('layouts.backend.app', ['title' => 'Payment'])
        ->section('content');
    }
}
