<?php

namespace App\Http\Livewire\Report;

use App\Models\Bank;
use App\Models\LicenseCategory;
use App\Models\LicenseCategoryWiseFeeType;
use App\Models\Operator;
use App\Models\PaymentWisePayOrder;
use Livewire\Component;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class ReportTwo extends Component
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

        return view('livewire.report.report-two', [
            'banks' => Bank::all(),
            'fee_types' => LicenseCategoryWiseFeeType::where('category_id', $this->category)->get(),
            'categories' => LicenseCategory::all(),
        ])->extends('layouts.backend.app', ['title' => 'Revenue Sharing Statement'])->section('content');
    }

    public function export_as_pdf()
    {
        $paper_size = 'Legal-L';
        if ($this->category) {
            $paper_size = 'Tabloid-L';
        }
        return response()->streamDownload(function () use ($paper_size) {
            Pdf::loadView('pdf.report-two', [
                'po_bank' => Bank::find($this->po_bank)->name ?? 'All Bank',
                'category' => LicenseCategory::find($this->category)->name ?? 'All Category',
                'fee_types' => LicenseCategoryWiseFeeType::where('category_id', $this->category)->get(),
                'file_name' => 'Report',
                'pay_orders' => $this->pay_orders,
            ], [], [
                'format' => $paper_size
            ])->download();
        }, 'Report download at ' . date('d-m-Y- h-i-s') . '.pdf');
    }
}
