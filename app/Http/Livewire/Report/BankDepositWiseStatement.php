<?php

namespace App\Http\Livewire\Report;

use App\Models\Bank;
use App\Models\Payment;
use App\Models\PaymentWisePayOrder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class BankDepositWiseStatement extends Component
{
    public $deposit_bank;
    public function render()
    {
        $this->statements = Payment::whereHas('deposits', function($query){
            if($this->deposit_bank)
            $query->where('bank_id', $this->deposit_bank); 
        })->latest()->get();

        return view('livewire.report.bank-deposit-wise-statement',[
            'banks' => Bank::all(),
        ])->extends('layouts.backend.app', ['title' => 'Bank Deposit Statement'])
        ->section('content');
    }

    public function export_as_pdf(){
        return response()->streamDownload(function () {
            Pdf::loadView('pdf.bank-deposit-statement', [
                'file_name' => 'Bank Deposit',
                'deposit_bank' => Bank::find($this->deposit_bank)->name ?? 'All Bank',
                'collections' => $this->statements
            ], [], [
                'format' => 'A4-L'
            ])->download();
        }, 'Bank Deposit download at ' . date('d-m-Y- h-i-s') . '.pdf');
    }
}
