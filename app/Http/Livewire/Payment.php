<?php

namespace App\Http\Livewire;

use App\Models\Expiration;
use App\Models\ExpirationWisePaymentDate;
use App\Models\FeeType;
use App\Models\LicenseCategory;
use App\Models\LicenseCategoryWiseFeeType;
use App\Models\LicenseSubCategory;
use App\Models\Operator;
use App\Models\Payment as ModelsPayment;
use Carbon\Carbon;
use Livewire\Component;

class Payment extends Component
{
    public $selected_category, $selected_sub_category, $selected_operator;
    public $receive_section_array = [], $po_section_array = [], $deposit_section_array = [], $periods = [];
    public $receive_section_done = false;

    public function add_or_rm_section_array($section, $rm_key = null)
    {
        if ($section == 'receive') {
            if ($rm_key === null) {
                array_push($this->receive_section_array, null);
            } else {
                unset($this->receive_section_array[$rm_key]);
            }
        } elseif ($section == 'po') {
            if ($rm_key === null) {
                array_push($this->po_section_array, null);
            } else {
                unset($this->po_section_array[$rm_key]);
            }
        } elseif ($section == 'deposit') {
            if ($rm_key === null) {
                array_push($this->deposit_section_array, null);
            } else {
                unset($this->deposit_section_array[$rm_key]);
            }
        }
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

    public function fee_type_change($key)
    {
        $fee_type_id = $this->receive_section_array[$key]['selected_fee_type'];
        $this->receive_section_array[$key]['periods'] = ExpirationWisePaymentDate::where(function ($query) use ($fee_type_id) {
            if ($this->selected_operator && $fee_type_id && $expiration = Expiration::where('operator_id', $this->selected_operator)->where('all_payment_completed', false)->first()) {
                $query->where('expiration_id', $expiration->id)->where('fee_type_id', $fee_type_id);
            } else {
                $query->where('expiration_id', null);
            }
        })->get();

        $category_wise_fee_type = LicenseCategoryWiseFeeType::where('category_id', $this->selected_category)->where('fee_type_id', $fee_type_id)->first();
        $this->receive_section_array[$key]['receivable'] =  $category_wise_fee_type->amount ?? 0;
        $this->receive_section_array[$key]['receive_amount'] =  $category_wise_fee_type->amount ?? 0;
        $this->receive_section_array[$key]['late_fee_percentage'] =  $category_wise_fee_type->late_fee ?? 0;
        $this->receive_section_array[$key]['vat_percentage'] =  $category_wise_fee_type->vat ?? 0;
        $this->receive_section_array[$key]['tax_percentage'] =  $category_wise_fee_type->tax ?? 0;
        $this->receive_section_array[$key]['vat_receive_amount'] =  (($category_wise_fee_type->amount / 100) * $category_wise_fee_type->vat) ?? 0;
        $this->receive_section_array[$key]['tax_receive_amount'] =  (($category_wise_fee_type->amount / 100) * $category_wise_fee_type->tax) ?? 0;
    }

    public function period_change($key)
    {
        $this->receive_section_array[$key]['schedule_date'] = ExpirationWisePaymentDate::find($this->receive_section_array[$key]['selected_period'])->period_schedule_date->format('d-M-Y');
    }

    // Late fee effected
    public function receive_date_change($key, $receive_date)
    {
        $this->validate([
            'receive_section_array.'.$key.'.selected_fee_type' => 'required',
            'receive_section_array.'.$key.'.selected_period' => 'required',
        ],[],[
            'receive_section_array.'.$key.'.selected_fee_type' => 'Fee type',
            'receive_section_array.'.$key.'.selected_period' => 'Period',
        ]);
        // If receive amount if empty or not integer input than integer value auto fill
        $this->receive_section_array[$key]['receive_amount'] = intval($this->receive_section_array[$key]['receive_amount']);
        $fee_type_id = $this->receive_section_array[$key]['selected_fee_type'];
        $category_wise_fee_type = LicenseCategoryWiseFeeType::where('category_id', $this->selected_category)->where('fee_type_id', $fee_type_id)->first();
        $late_fee_amount_of_one_year = ((($this->receive_section_array[$key]['receive_amount'] ?? 0) / 100) * $category_wise_fee_type->late_fee) ?? 0;
        $schedule_date = ExpirationWisePaymentDate::find($this->receive_section_array[$key]['selected_period'])->period_schedule_date;
        $this->receive_section_array[$key]['late_days'] = 0;
        if(Carbon::parse($receive_date)->diffInDays($schedule_date, false) < 0){
            $this->receive_section_array[$key]['late_days'] =  abs(Carbon::parse($receive_date)->diffInDays($schedule_date, false));
        }
        $this->receive_section_array[$key]['late_fee_receive_amount'] = round(($late_fee_amount_of_one_year / 365) * $this->receive_section_array[$key]['late_days']);
    }

    // Late fee effected
    public function receive_amount_change($key, $receive_amount)
    {
        $this->validate([
            'receive_section_array.'.$key.'.selected_fee_type' => 'required',
            'receive_section_array.'.$key.'.selected_period' => 'required',
        ],[],[
            'receive_section_array.'.$key.'.selected_fee_type' => 'Fee type',
            'receive_section_array.'.$key.'.selected_period' => 'Period',
        ]);
        // If receive amount if empty or not integer input than integer value auto fill
        $this->receive_section_array[$key]['receive_amount'] = intval($receive_amount);
        $fee_type_id = $this->receive_section_array[$key]['selected_fee_type'];
        $category_wise_fee_type = LicenseCategoryWiseFeeType::where('category_id', $this->selected_category)->where('fee_type_id', $fee_type_id)->first();
        $late_fee_amount_of_365 = ((($this->receive_section_array[$key]['receive_amount'] ?? 0) / 100) * $category_wise_fee_type->late_fee) ?? 0;
        $this->receive_section_array[$key]['late_fee_receive_amount'] = $late_fee_amount_of_365;
    }

    public function receive_make_as_done($type){
        if($type){
            $this->validate([
                'receive_section_array.*.selected_fee_type' => 'required',
                'receive_section_array.*.selected_period' => 'required',
            ],[],[
                'receive_section_array.*.selected_fee_type' => 'Fee type',
                'receive_section_array.*.selected_period' => 'Period',
            ]);
            $this->receive_section_done = $type;
            // $total_receive = 
        }else{
            $this->receive_section_done = $type;
            $this->validate([
                'receive_section_array.*.selected_fee_type' => 'required',
                'receive_section_array.*.selected_period' => 'required',
            ],[],[
                'receive_section_array.*.selected_fee_type' => 'Fee type',
                'receive_section_array.*.selected_period' => 'Period',
            ]);
        }
    }
}
