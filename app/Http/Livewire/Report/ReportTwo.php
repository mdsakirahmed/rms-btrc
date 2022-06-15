<?php

namespace App\Http\Livewire\Report;

use App\Models\Bank;
use App\Models\LicenseCategory;
use App\Models\Operator;
use App\Models\PaymentWisePayOrder;
use Livewire\Component;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class ReportTwo extends Component
{
    public $po_bank, $category;

    public function render()
    {
        $operator_ids = [];
        if ($this->category)
            $operator_ids = Operator::where('category_id', $this->category)->pluck('id');


        $this->pay_orders = PaymentWisePayOrder::where(function ($query) {
            if ($this->po_bank)
                $query->where('bank_id', $this->po_bank);
        })->whereHas('payment', function ($query) use ($operator_ids) {
            if (count($operator_ids) > 0)
                $query->whereIn('operator_id', $operator_ids);
        })->latest()->get();

        return view('livewire.report.report-two', [
            'banks' => Bank::all(),
            'categories' => LicenseCategory::all(),
        ])->extends('layouts.backend.app', ['title' => 'Revenue Sharing Statement'])->section('content');
    }

    public function export_as_pdf()
    {
        return response()->streamDownload(function () {
            Pdf::loadView('pdf.report-two', [
                'po_bank' => Bank::find($this->po_bank)->name ?? 'All Bank',
                'category' => LicenseCategory::find($this->category)->name ?? 'All Category',
                'file_name' => 'Report',
                'pay_orders' =>  $this->pay_orders,
            ], [], [
                'format' => 'Legal-L'
            ])->download();
        }, 'Report download at ' . date('d-m-Y- h-i-s') . '.pdf');
    }
}