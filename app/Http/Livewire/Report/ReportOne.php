<?php

namespace App\Http\Livewire\Report;

use App\Models\Bank;
use App\Models\PaymentWiseDeposit;
use Livewire\Component;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class ReportOne extends Component
{
    public $starting_date, $ending_date, $deposit_bank;
    public function render()
    {
        return view('livewire.report.report-one',[
            'banks' => Bank::all(),
            'deposits' => PaymentWiseDeposit::whereBetween('date', [$this->starting_date, $this->ending_date])->where(function($query){
                if($this->deposit_bank)
                $query->where('bank_id', $this->deposit_bank);
            })->latest()->get()
        ])->extends('layouts.backend.app', ['title' => 'Revenue Sharing Statement'])->section('content');
    }

    public function export_as_pdf(){
        return response()->streamDownload(function () {
            Pdf::loadView('pdf.report-one', [
                'deposit_bank' => Bank::find($this->deposit_bank)->name ?? 'All Bank',
                'file_name' => 'Report',
                'deposits' => PaymentWiseDeposit::whereBetween('date', [$this->starting_date, $this->ending_date])->where(function($query){
                    if($this->deposit_bank)
                    $query->where('bank_id', $this->deposit_bank);
                })->latest()->get()
            ], [], [
                'format' => 'A4-L'
            ])->download();
        }, 'Report download at ' . date('d-m-Y- h-i-s') . '.pdf');
    }
}
