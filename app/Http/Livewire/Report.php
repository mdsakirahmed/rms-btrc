<?php

namespace App\Http\Livewire;

use App\Models\Bank;
use App\Models\LicenseCategory;
use App\Models\LicenseSubCategory;
use App\Models\Operator;
use App\Models\PartialPayment;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Report extends Component
{
    public $start_date, $end_date, $late_fee, $journal_number, $pay_order_number, $category, $sub_category, $oprtator, $bank;
    public $category_search_key, $sub_category_search_key, $operator_search_key, $bank_search_key;
    public $category_id, $operator_id;

    public $data_set = [];

    public function submit(){

        // $data_set = PartialPayment::select("*")
        // ->with(['payment' => function ($query) {
        //     $query->select('*');
        // }, 'bank' => function ($query) {
        //     $query->select('*');
        // }])->get();



        // $this->data_set = DB::table('partial_payments')
        //     ->join('payments', 'partial_payments.payment_id', '=', 'payments.id')
        //     ->join('expirations', 'payments.expiration_id', '=', 'expirations.id')
        //     ->join('operators', 'expirations.operator_id', '=', 'operators.id')
        //     ->join('license_categories', 'operators.category_id', '=', 'license_categories.id')
        //     // ->join('license_sub_categories', 'operators.sub_category_id', '=', 'license_sub_categories.id')
        //     ->get();


        $bank = $this->bank;

            $this->data_set = DB::table('partial_payments')
            ->join('banks', 'partial_payments.bank_id', '=', 'banks.id')
            ->join('payments', 'partial_payments.payment_id', '=', 'payments.id')
            ->join('expirations', 'payments.expiration_id', '=', 'expirations.id')
            ->join('operators', 'expirations.operator_id', '=', 'operators.id')
            ->join('license_categories', 'operators.category_id', '=', 'license_categories.id')
            // ->join('license_sub_categories', 'operators.sub_category_id', '=', 'license_sub_categories.id')
            ->select('banks.id as bank_id', 'banks.name as bank_name', 'pay_order_number')
            ->where(function($query) use($bank){
                return $bank ? $query->from('banks')->where('bank_id',$bank) : '';
           })
            ->get();

            // dd($this->data_set);
    }

    public function render()
    {
        return view('livewire.report', [
            'banks' => Bank::where('name', 'like', '%'.$this->bank_search_key.'%')->latest()->get(),
        ])->extends('layouts.backend.app', ['title' => 'Report'])
        ->section('content');
    }
}
