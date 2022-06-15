<?php

namespace App\Http\Livewire\Report;

use App\Models\Bank;
use App\Models\PaymentWiseDeposit;
use App\Models\PaymentWisePayOrder;
use Livewire\Component;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class ReportTwo extends Component
{
    public $po_bank;

    public function render()
    {
        return view('livewire.report.report-two',[
            'banks' => Bank::all(),
            'pay_orders' => PaymentWisePayOrder::where(function($query){
                if($this->po_bank)
                $query->where('bank_id', $this->po_bank);
            })->latest()->get()
        ])->extends('layouts.backend.app', ['title' => 'Revenue Sharing Statement'])->section('content');
    }

    public function export_as_pdf(){
        return response()->streamDownload(function () {
            Pdf::loadView('pdf.report-two', [
                'po_bank' => Bank::find($this->po_bank)->name ?? 'All Bank',
                'file_name' => 'Report',
                'pay_orders' => PaymentWisePayOrder::where(function($query){
                    if($this->po_bank)
                    $query->where('bank_id', $this->po_bank);
                })->latest()->get()
            ], [], [
                'format' => 'A4-L'
            ])->download();
        }, 'Report download at ' . date('d-m-Y- h-i-s') . '.pdf');
    }
}
