<?php

namespace App\Http\Livewire\Report;

use App\Models\Bank;
use App\Models\FeeType;
use App\Models\LicenseCategory;
use App\Models\LicenseCategoryWiseFeeType;
use App\Models\LicenseSubCategory;
use App\Models\Operator;
use Livewire\Component;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class ReportFive extends Component
{
    public $category, $sub_category, $operator;

    public function render()
    {
        return view('livewire.report.report-five', [
            'categories' => LicenseCategory::all(),
            'sub_categories' => LicenseSubCategory::all(),
            'operators' => Operator::where('category_id', $this->category)->where('sub_category_id', $this->sub_category)->get(),
            'operator_model' => Operator::find($this->operator) ?? null,
            'fee_types' => FeeType::where(function ($query) {
                if ($this->category && $this->sub_category) {
                    $query->where('category_id', $this->category)->where('sub_category_id', $this->sub_category)->get();
                } else {
                    $query->where('id', 0);
                }
            })->get()
        ])->extends('layouts.backend.app', ['title' => 'Revenue Sharing Statement'])->section('content');
    }

    public function change_category_and_sub_category(){
        $this->operator = null;
    }

    public function export_as_pdf()
    {
        return response()->streamDownload(function () {
            Pdf::loadView('pdf.report-five', [
                'category' => LicenseCategory::find($this->category)->name ?? '#',
                'sub_category' => LicenseSubCategory::find($this->sub_category)->name ?? '#',
                'operator_model' => Operator::find($this->operator) ?? null,
                'file_name' => 'Report',
            ], [], [
                'format' => 'A4'
            ])->download();
        }, 'Report download at ' . date('d-m-Y- h-i-s') . '.pdf');
    }
}
