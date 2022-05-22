<?php

namespace App\Http\Livewire\Report;

use App\Models\ExpirationWisePaymentDate;
use App\Models\FeeType;
use App\Models\Operator;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class RevenueSharingStatement extends Component
{
    public $selected_fee_type, $selected_period;

    public function render()
    {
        return view('livewire.report.revenue-sharing-statement', [
            'fee_types' => FeeType::all(),
            'period_groups' => DB::table('expiration_wise_payment_dates')->where('fee_type_id', $this->selected_fee_type)->get()->groupBy('period_start_date'),
            'periods' => ExpirationWisePaymentDate::where('fee_type_id', $this->selected_fee_type)->get()->mapToGroups(function ($item, $key) {
                return [$item->period_label];
            })->toArray()[0] ?? [],
            'exp_wise_payment_dates' => $this->get_revenue_sharing_statements()

        ])->extends('layouts.backend.app', ['title' => 'Revenue Sharing Statement'])
            ->section('content');
    }

    public function get_revenue_sharing_statements()
    {
        // $collection = DB::table('expiration_wise_payment_dates')
        //         ->where('period_label', $this->selected_period) //->where('paid', true)
        //         ->join('payment_wise_receives', 'expiration_wise_payment_dates.id', '=', 'payment_wise_receives.period_id')
        //         ->join('payments', 'payment_wise_receives.payment_id', '=', 'payments.id')
        //         ->join('operators', 'payments.operator_id', '=', 'operators.id')
        //         ->select(
        //             'operators.name as operator_name', 
        //             DB::raw('sum(payment_wise_receives.receivable_amount) as receivable'),
        //             DB::raw('sum(payment_wise_receives.receive_amount) as receive'),
        //             )->groupBy('operators.id')
        //         ->get();

        // $collection =  DB::table('operators')
        //     ->join('expirations', 'operators.id', 'expirations.operator_id')
        //     ->join('expiration_wise_payment_dates', 'expirations.id', 'expiration_wise_payment_dates.expiration_id')
        //     ->where('expiration_wise_payment_dates.period_label', $this->selected_period)
        //     ->join('fee_types', 'expiration_wise_payment_dates.fee_type_id', 'fee_types.id')
        //     ->leftJoin('payment_wise_receives', 'expiration_wise_payment_dates.id', 'payment_wise_receives.period_id')
        //     ->select(
        //         'operators.name as operator_name',
        //         DB::raw('sum(payment_wise_receives.receivable_amount) as receivable'),
        //         DB::raw('sum(payment_wise_receives.receive_amount) as receive'),
        //     )->groupBy('operators.id')
        //     ->get();

        $collection = ExpirationWisePaymentDate::where('period_label', $this->selected_period)->get();
        // dd($collection);


        return $collection ?? [];
    }
}
