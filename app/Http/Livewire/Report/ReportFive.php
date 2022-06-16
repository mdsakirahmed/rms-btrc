<?php

namespace App\Http\Livewire\Report;

use App\Models\Bank;
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
            'operator_model' => Operator::find($this->operator) ?? null
        ])->extends('layouts.backend.app', ['title' => 'Revenue Sharing Statement'])->section('content');
    }

    public function export_as_pdf()
    {
        $paper_size = 'Legal-L';
        if($this->category){
            $paper_size = 'Tabloid-L';
        }
        return response()->streamDownload(function () use($paper_size){
            Pdf::loadView('pdf.report-four', [
                'po_bank' => Bank::find($this->po_bank)->name ?? 'All Bank',
                'category' => LicenseCategory::find($this->category)->name ?? 'All Category',
                'fee_types' => LicenseCategoryWiseFeeType::where('category_id', $this->category)->get(),
                'file_name' => 'Report',
                'pay_orders' =>  $this->pay_orders,
            ], [], [
                'format' => $paper_size
            ])->download();
        }, 'Report download at ' . date('d-m-Y- h-i-s') . '.pdf');
    }
}
