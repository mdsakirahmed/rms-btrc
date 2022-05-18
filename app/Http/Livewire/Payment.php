<?php

namespace App\Http\Livewire;

use App\Models\Expiration;
use App\Models\ExpirationWisePaymentDate;
use App\Models\FeeType;
use App\Models\LicenseCategory;
use App\Models\LicenseSubCategory;
use App\Models\Operator;
use App\Models\Payment as ModelsPayment;
use Livewire\Component;

class Payment extends Component
{
    public $selected_category, $selected_sub_category, $selected_operator, $selected_fee_type;
    public $receive_section_array = [], $po_section_array = [], $deposit_section_array = [], $periods = [];

    public function add_or_rm_section_array($section, $rm_array_key = null)
    {
        if ($section == 'receive') {
            if ($rm_array_key === null) {
                array_push($this->receive_section_array, null);
            } else {
                unset($this->receive_section_array[$rm_array_key]);
            }
        }elseif($section == 'po'){
            if ($rm_array_key === null) {
                array_push($this->po_section_array, null);
            } else {
                unset($this->po_section_array[$rm_array_key]);
            }
        }elseif($section == 'deposit'){
            if ($rm_array_key === null) {
                array_push($this->deposit_section_array, null);
            } else {
                unset($this->deposit_section_array[$rm_array_key]);
            }
        }

        // $this->receive_section_array = array_values($this->receive_section_array);
    }

    public function render()
    {
        $data = [
            'transaction' => date('ym') . '-' . convert_to_initial(auth()->user()->name) . '-' . sprintf("%'.05d\n", (ModelsPayment::latest()->first()->id ?? 0) + 1),
            'categories' => LicenseCategory::all(),
            'sub_categories' => LicenseSubCategory::all(),
            'operators' => Operator::where(function ($query) {
                if ($this->selected_category) {
                    $query->where('category_id', $this->selected_category);
                } else {
                    $query->where('category_id', null);
                }
            })->where(function ($query) {
                if ($this->selected_sub_category)
                    $query->where('sub_category_id', $this->selected_sub_category);
            })->get(),
            'fee_types' => FeeType::where(function ($query) {
                if ($this->selected_operator && $expiration = Expiration::where('operator_id', $this->selected_operator)->where('all_payment_completed', false)->first()) {
                    $query->whereIn('id', $expiration->expiration_wise_payment_dates()->distinct()->pluck('fee_type_id'));
                } else {
                    $query->whereIn('id', []);
                }
            })->get()
        ];

        return view('livewire.payment', $data)->extends('layouts.backend.app', ['title' => 'Payment'])
            ->section('content');
    }

    public function fee_type_change($array_key){
        $this->periods = ExpirationWisePaymentDate::where(function ($query) use ($array_key) {
            if ($this->selected_operator && $this->receive_section_array[$array_key]['selected_fee_type'] && $expiration = Expiration::where('operator_id', $this->selected_operator)->where('all_payment_completed', false)->first()) {
                $query->where('expiration_id', $expiration->id)->where('fee_type_id', $this->receive_section_array[$array_key]['selected_fee_type']);
            } else {
                $query->where('expiration_id', null);
            }
        })->get();
    }
    
    public function period_change($array_key){
        $this->receive_section_array[$array_key]['schedule_date'] = ExpirationWisePaymentDate::find($this->receive_section_array[$array_key]['selected_period'])->period_schedule_date->format('d-M-Y');
    }
}
