<?php

namespace App\Http\Livewire\Report;

use App\Models\Bank;
use App\Models\LicenseCategory;
use App\Models\Payment;
use Livewire\Component;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class CategoryWiseStatement extends Component
{
    public $deposit_bank, $category;

    public function render()
    {
        $this->statements = Payment::whereHas('deposits', function($query){
            if($this->deposit_bank)
            $query->where('bank_id', $this->deposit_bank); 
        })->whereHas('operator', function ($category) {
            $category->where('category_id', $this->category);
        })->latest()->get();

        return view('livewire.report.category-wise-statement', [
            'banks' => Bank::all(),
            'categories' => LicenseCategory::all()
        ])->extends('layouts.backend.app', ['title' => 'Category Wise Statement'])
            ->section('content');
    }

    public function export_as_pdf(){
        return response()->streamDownload(function () {
            Pdf::loadView('pdf.category-wise-statement', [
                'file_name' => 'Bank Deposit',
                'deposit_bank' => Bank::find($this->deposit_bank)->name ?? 'All Bank',
                'category' => LicenseCategory::find($this->category)->name ?? 'All Category',
                'collections' => $this->statements
            ], [], [
                'format' => 'A4-L'
            ])->download();
        }, 'Bank Deposit download at ' . date('d-m-Y- h-i-s') . '.pdf');
    }
}
