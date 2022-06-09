<?php

namespace App\Http\Livewire\Report;

use App\Exports\OperatorWiseFileRegisterExport;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class OperatorWiseFileRegister extends Component
{
    public function render()
    {
        return view('livewire.report.operator-wise-file-register',[
            'payments' => $this->payments()->paginate(100)
        ])->extends('layouts.backend.app', ['title' => 'Report'])
        ->section('content');
    }

    public function payments(){
        return DB::table('payments')
        ->join('payment_wise_receives', 'payments.id', '=', 'payment_wise_receives.payment_id')
        ->join('payment_wise_pay_orders', 'payments.id', '=', 'payment_wise_pay_orders.payment_id')
        ->join('payment_wise_deposits', 'payments.id', '=', 'payment_wise_deposits.payment_id')
        ->join('operators', 'payments.operator_id', '=', 'operators.id')
        // ->join('fee_types', 'payment_wise_receives.fee_type_id', '=', 'fee_types.id')
        ->join('periods', 'payment_wise_receives.period_id', '=', 'periods.id')
        ->join('fee_types', 'periods.fee_type_id', '=', 'fee_types.id')
        ->join('banks as po_banks', 'payment_wise_pay_orders.bank_id', '=', 'po_banks.id')
        ->join('banks as deposit_banks', 'payment_wise_deposits.bank_id', '=', 'deposit_banks.id')
        ->select('operators.name as operator_name',
        'payments.transaction',
        'fee_types.name as fee_type_name',
        'periods.period_end_date',
        'payment_wise_receives.receive_date',
        'payment_wise_receives.receive_amount as receive_amount',
        'payment_wise_receives.late_fee_percentage as receive_late_fee',
        'payment_wise_receives.vat_percentage as receive_vat',
        'payment_wise_receives.tax_percentage as receive_tax',
        'po_banks.name as po_bank_name',
        'payment_wise_pay_orders.amount as po_amount',
        'payment_wise_pay_orders.number as po_number',
        'payment_wise_pay_orders.date as po_date',
        'deposit_banks.name as deposit_bank_name',
        'payment_wise_deposits.journal_number as deposit_journal_number',
        'payment_wise_deposits.date as deposit_date',
        );
    }

    public function export(){
        $collection = $this->payments()->get();
        return Excel::download(new OperatorWiseFileRegisterExport($collection), 'Operator wise file register '.date('d-m-Y h-i-s a').'.xlsx');
    }
}
