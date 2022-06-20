<?php

namespace App\Http\Livewire\Report;

use App\Models\LicenseCategory;
use App\Models\LicenseSubCategory;
use App\Models\Operator;
use Livewire\Component;

class ReportSix extends Component
{
    public function render()
    {
        return view('livewire.report.report-six', [
            'categories' => LicenseCategory::all(),
            'sub_categories' => LicenseSubCategory::all(),
            'operators' => Operator::where('category_id', $this->category)->where('sub_category_id', $this->sub_category)->get(),
        ])->extends('layouts.backend.app', ['title' => 'Revenue Sharing Statement'])->section('content');
    }
}
