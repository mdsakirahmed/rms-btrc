<?php

namespace App\Http\Livewire\Report;

use App\Models\Bank;
use App\Models\FeeType;
use App\Models\LicenseCategory;
use App\Models\LicenseCategoryWiseFeeType;
use App\Models\Operator;
use App\Models\PaymentWisePayOrder;
use Livewire\Component;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class ReportThree extends Component
{
    public $starting_date, $ending_date, $po_bank, $category;

    public function render()
    {
        $operator_ids = [];
        if ($this->category)
            $operator_ids = Operator::where('category_id', $this->category)->pluck('id');
        
        $this->pay_orders = PaymentWisePayOrder::whereBetween('date', [$this->starting_date, $this->ending_date])->where(function ($query) {
            if ($this->po_bank)
                $query->where('bank_id', $this->po_bank);
        })->whereHas('payment', function ($query) use ($operator_ids) {
            if (count($operator_ids) > 0)
                $query->whereIn('operator_id', $operator_ids);
        })->latest()->get();

        return view('livewire.report.report-three', [
            'banks' => Bank::all(),
            'fee_types' => FeeType::where('category_id', $this->category)->get(),
            'categories' => LicenseCategory::all(),
        ])->extends('layouts.backend.app', ['title' => 'Revenue Sharing Statement'])->section('content');
    }

    public function export_as_pdf()
    {
        return response()->streamDownload(function (){
            Pdf::loadView('pdf.report-three', [
                'po_bank' => Bank::find($this->po_bank)->name ?? 'All Bank',
                'category' => LicenseCategory::find($this->category)->name ?? 'All Category',
                'file_name' => 'Report',
                'pay_orders' =>  $this->pay_orders,
            ], [], [
                'format' => 'A4-L'
            ])->download();
        }, 'Report download at ' . date('d-m-Y- h-i-s') . '.pdf');
    }
}
