<?php

namespace App\Http\Livewire\Report;

use App\Models\LicenseCategory;
use App\Models\Operator;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CategoryWiseStatement extends Component
{
    public $category, $starting_date, $ending_date;
    public $data_sets = [];

    public function render()
    {
        return view('livewire.report.category-wise-statement', [
            'categories' => LicenseCategory::all(),
            'operators' => Operator::where('category_id', $this->category)->get()
        ])->extends('layouts.backend.app', ['title' => 'Category Wise Statement'])
            ->section('content');
    }

    public function generate(){
        $this->validate([
            'category' => 'required|exists:license_categories,id',
            // 'starting_date' => 'required|date',
            // 'ending_date' => 'required|date',
        ]);
       
        $this->data_sets = DB::table('license_categories')->where('license_categories.id', $this->category)->select('license_categories.name as category_name')
        ->join('operators', 'license_categories.id', 'operators.category_id')->addSelect('operators.id as operator_id', 'operators.name as operator_name')
        ->join('expirations', 'operators.id', 'expirations.operator_id')->addSelect('expirations.id as expiration_id')
        ->join('payments', 'expirations.id', 'payments.expiration_id')->addSelect('payments.id as payment_id', 'transaction as transaction_number')
        ->leftJoin('payment_wise_receives', 'payments.id', 'payment_wise_receives.payment_id')->addSelect('payment_wise_receives.id as receive_id')
        ->leftJoin('payment_wise_pay_orders', 'payments.id', 'payment_wise_pay_orders.payment_id')->addSelect('payment_wise_pay_orders.id as po_id')
        ->leftJoin('payment_wise_deposits', 'payments.id', 'payment_wise_deposits.payment_id')->addSelect('payment_wise_deposits.id as deposit_id')
        ->leftJoin('banks as po_bank', 'payment_wise_pay_orders.bank_id', 'po_bank.id')->addSelect('po_bank.id as po_bank_id')
        ->leftJoin('banks as deposit_banks', 'payment_wise_deposits.bank_id', 'deposit_banks.id')->addSelect('deposit_banks.id as deposit_bank_id')
        ->get()->groupBy('operator_id');
        
        // dd($this->data_sets);
    }
}
