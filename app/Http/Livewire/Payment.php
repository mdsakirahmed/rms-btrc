<?php

namespace App\Http\Livewire;

use App\Models\Payment as ModelsPayment;
use Livewire\Component;
use App\Models\Bank;
use App\Models\Expiration;
use App\Models\LicenseCategory;
use App\Models\LicenseSubCategory;
use App\Models\Operator;
use App\Models\PartialPayment;
use Carbon\Carbon;
use PDF;

class Payment extends Component
{
    public $categories, $sub_categories;

    public $category_id, $operator_id;

    // listeners use for get data from jsvascript
    protected $listeners = [
        'select_category','select_operator',
    ];
    // Set category by on change category dropdown
    public function select_category($category_id)
    {
        $this->category_id = $category_id;
    }
    // Set operator by on change operator dropdown
    public function select_operator($operator_id)
    {
        $this->operator_id = $operator_id;
    }

    public function render()
    {
        $this->categories = LicenseCategory::all();

        $this->sub_categories = LicenseSubCategory::all();

        $operators = Operator::all();
        if($this->category_id){
            $operators = Operator::where('category_id', $this->category_id)->get();
        }
        $this->dispatchBrowserEvent('operators_data_event', ['operators_data' => $operators]);
        return view('livewire.payment')
            ->extends('layouts.backend.app', ['title' => 'Payment'])
            ->section('content');
    }
}
