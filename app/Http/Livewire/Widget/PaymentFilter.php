<?php

namespace App\Http\Livewire\Widget;

use App\Models\Expiration;
use App\Models\LicenseCategory;
use App\Models\LicenseCategoryWiseFeeType;
use App\Models\LicenseSubCategory;
use App\Models\Operator;
use Carbon\Carbon;
use Livewire\Component;

class PaymentFilter extends Component
{
    public $categories, $sub_categories;

    public $category_id, $operator_id, $category_wise_fee_type_id;

    // listeners use for get data from jsvascript
    protected $listeners = [
        'select_category','select_operator', 'select_fee_type',
    ];

    // Set category by on change category dropdown
    public function select_category($category_id)
    {
        $this->category_id = $category_id;
        $operators = Operator::where('category_id', $category_id)
        ->whereHas('expirations', function($query){
            $query->where('expire_date', '>=', Carbon::today());
        })->get();
        $this->dispatchBrowserEvent('operators_data_event', ['operators_data' => $operators]);
        $this->dispatchBrowserEvent('category_wise_fee_types_data_event', ['category_wise_fee_types_data' => LicenseCategoryWiseFeeType::where('category_id', $this->category_id)->with('fee_type')->get()]);
    }
    // Set operator by on change operator dropdown
    public function select_operator($operator_id)
    {
        $this->operator_id = $operator_id;
    }
    // Set operator by on change fee type dropdown
    public function select_fee_type(LicenseCategoryWiseFeeType $category_wise_fee_type)
    {
        $this->category_wise_fee_type_id = $category_wise_fee_type->id;
        $expiration = Expiration::where('operator_id', $this->operator_id)->first();
        $payment_period_dates = [];
        for($issue_date = $expiration->issue_date; $issue_date < $expiration->expire_date; $issue_date->modify('+'.$category_wise_fee_type->period_month.' month')){
            array_push($payment_period_dates, $issue_date->format('d-m-Y'));
        }
        $this->dispatchBrowserEvent('payment_period_data_event', ['payment_period_data' => $payment_period_dates]);
        $this->dispatchBrowserEvent('category_wise_selected_fee_type_data_event', ['category_wise_selected_fee_type_data' => $category_wise_fee_type]);
    }

    public function render()
    {
        $this->categories = LicenseCategory::all();
        $this->sub_categories = LicenseSubCategory::all();
        return view('livewire.widget.payment-filter');
    }
}
