<?php

namespace App\Http\Livewire\Report;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class BankDepositWiseStatement extends Component
{
    public function render()
    {
        $this->statements = DB::table('license_categories')->select('license_categories.name as category_name')
        ->join('operators', 'license_categories.id', 'operators.category_id')->addSelect('operators.id as operator_id', 'operators.name as operator_name')
        ->join('expirations', 'operators.id', 'expirations.operator_id')->addSelect('expirations.id as expiration_id')
        ->join('payments', 'expirations.id', 'payments.expiration_id')->addSelect('payments.id as payment_id', 'transaction as transaction_number')
        ->join('payment_wise_receives', 'payments.id', 'payment_wise_receives.payment_id')->addSelect('payment_wise_receives.id as receive_id')
        ->join('payment_wise_pay_orders', 'payments.id', 'payment_wise_pay_orders.payment_id')
            ->addSelect('payment_wise_pay_orders.id as po_id', 'payment_wise_pay_orders.number as po_number', 'payment_wise_pay_orders.date as po_date', 'payment_wise_pay_orders.amount as po_amount')
        ->join('payment_wise_deposits', 'payments.id', 'payment_wise_deposits.payment_id')->addSelect('payment_wise_deposits.id as deposit_id')
        ->join('banks as po_bank', 'payment_wise_pay_orders.bank_id', 'po_bank.id')->addSelect('po_bank.id as po_bank_id', 'po_bank.name as po_bank_name')
        ->join('banks as deposit_banks', 'payment_wise_deposits.bank_id', 'deposit_banks.id')->addSelect('deposit_banks.id as deposit_bank_id')
        ->get();

        return view('livewire.report.bank-deposit-wise-statement')
        ->extends('layouts.backend.app', ['title' => 'Bank Deposit Statement'])
        ->section('content');
    }
}
