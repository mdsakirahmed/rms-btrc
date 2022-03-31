<?php

namespace App\Http\Livewire;

use App\Models\Bank;
use App\Models\LicenseCategory;
use App\Models\LicenseSubCategory;
use App\Models\Operator;
use Livewire\Component;

class Report extends Component
{
    public $start_date, $end_date, $late_fee, $journal_number, $pay_order_number, $category, $sub_category, $oprtator, $bank;
    public $category_search_key, $sub_category_search_key, $operator_search_key, $bank_search_key;
    public $category_id, $operator_id;

    public function submit(){

    }

    public function render()
    {
        return view('livewire.report', [
            'banks' => Bank::where('name', 'like', '%'.$this->bank_search_key.'%')->latest()->get(),
        ])->layout('layouts.backend.app');
    }
}
