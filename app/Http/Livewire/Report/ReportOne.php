<?php

namespace App\Http\Livewire\Report;

use App\Models\PaymentWiseDeposit;
use Livewire\Component;

class ReportOne extends Component
{
    public function render()
    {
        return view('livewire.report.report-one',[
            'deposits' => PaymentWiseDeposit::latest()->get()
        ])->extends('layouts.backend.app', ['title' => 'Revenue Sharing Statement'])
            ->section('content');
    }
}
