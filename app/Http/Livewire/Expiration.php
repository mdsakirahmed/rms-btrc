<?php

namespace App\Http\Livewire;

use App\Models\Expiration as ModelsExpiration;
use App\Models\Operator;
use App\Models\Period;
use Carbon\Carbon;
use Livewire\Component;
use PDF;

class Expiration extends Component
{
    public $issue_date, $expire_date, $duration_year, $duration_month;
    public $operator, $expiration;
    public $periods = [];

    public function mount(Operator $operator)
    {
        $this->operator = $operator;
        $this->duration_year = $operator->category->duration_year ?? 0;
        $this->duration_month = $operator->category->duration_month ?? 0;
    }

    public function create()
    {
        $this->issue_date = $this->expire_date = null;
    }

    public function submit()
    {
        $validated_data = $this->validate([
            'issue_date' => 'required|date',
            'expire_date' => 'required|date',
        ]);
        if (ModelsExpiration::where('operator_id', $this->operator->id)->whereDate('expire_date', '>=', $this->issue_date)->first()) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'Issue date already in a period !']);
        } else {
            $validated_data['operator_id'] = $this->operator->id;
            if ($this->expiration) {
                $expiration = $this->expiration;
                /*Have to work by checking period and payment wise receive table*/
                /* $expiration->update($validated_data);
                 $expiration->periods()->delete();*/
            } else {
                $expiration = ModelsExpiration::create($validated_data);
            }

            $period_data_set = [];

            foreach ($this->operator->category->category_wise_fees as $category_wise_fee_type) {
                if ($category_wise_fee_type->fee_type->period_start_with_issue_date) {
                    $period_start_date = $expiration->issue_date;
                } else {
                    $period_start_date = Carbon::create($expiration->issue_date)->firstOfYear();
                    while ($period_start_date <= $expiration->issue_date){
                        $period_start_date->addMonths($category_wise_fee_type->fee_type->period_month);
                    }
                }
                while ($period_start_date <= Carbon::create($expiration->expire_date)) {
                    $this_period_start_date = $period_start_date->format('Y-m-d');
                    $this_period_end_date = Carbon::create($this_period_start_date)->addMonths($category_wise_fee_type->fee_type->period_month)->subDays(1)->format('Y-m-d');

                    /*Generate period schedule date base on type*/
                    if ($category_wise_fee_type->fee_type->schedule_include_to_beginning_of_period) {
                        $this_period_schedule_date = Carbon::create($this_period_start_date)->addDays($category_wise_fee_type->fee_type->schedule_day)->addMonths($category_wise_fee_type->fee_type->schedule_month)->subDays(1)->format('Y-m-d');
                    } else {
                        $this_period_schedule_date = Carbon::create($this_period_end_date)->addDays($category_wise_fee_type->fee_type->schedule_day)->addMonths($category_wise_fee_type->fee_type->schedule_month)->format('Y-m-d');
                    }

                    /*Generate period format base on type*/
                    if ($category_wise_fee_type->fee_type->period_format == 1) {
                        $period_label = Carbon::create($this_period_start_date)->format('M/') . Carbon::create($this_period_start_date)->format('Y-') . Carbon::create($this_period_end_date)->addDays(1)->format('Y');
                    } elseif ($category_wise_fee_type->fee_type->period_format == 2) {
                        $period_label = Carbon::create($this_period_start_date)->format('M-') . Carbon::create($this_period_end_date)->format('M') . Carbon::create($this_period_end_date)->format('/Y');
                    }

                    /*Make data collection set for insert*/
                    array_push($period_data_set, [
                        'operator_id' => $this->operator->id,
                        'expiration_id' => $expiration->id,
                        'fee_type_id' => $category_wise_fee_type->fee_type_id,
                        'payment_number' => 0,
                        'period_start_date' => $this_period_start_date,
                        'period_end_date' => $this_period_end_date,
                        'period_schedule_date' => $this_period_schedule_date,
                        'period_label' => $period_label,
                        'total_receivable' => 0,
                        'paid' => 0,
                    ]);
                    $period_start_date->addMonths($category_wise_fee_type->fee_type->period_month);
                };
            }
            Period::insert($period_data_set);
            $this->create();
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'Success !']);
        }
    }

    public function select_for_edit(ModelsExpiration $expiration)
    {
        $this->expiration = $expiration;
        $this->issue_date = $expiration->issue_date;
        $this->expire_date = $expiration->expire_date;
    }

    public function select_for_periods(ModelsExpiration $expiration)
    {
        $this->periods = Period::where('expiration_id', $expiration->id)->orderBy('period_schedule_date', 'asc')->get();
        //$this->periods = Period::where('expiration_id', $expiration->id)->orderBy('fee_type_id', 'asc')->get();
    }

    public function delete(ModelsExpiration $expiration)
    {
        $expiration->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'Success !']);
    }


    public function calculate_iteration()
    {
        $this->iteration = Carbon::parse($this->issue_date)->diffInMonths(Carbon::parse($this->issue_date)->addYears($this->duration_year ?? 0)->addMonths($this->duration_month ?? 0)) / 2;
        $this->expire_date = Carbon::parse($this->issue_date)->addYears($this->duration_year ?? 0)->addMonths($this->duration_month ?? 0)->subDays(1)->format('Y-m-d');
    }

    public function render()
    {
        return view('livewire.expiration', [
            'expirations' => ModelsExpiration::latest()->where('operator_id', $this->operator->id)->get()
        ])->extends('layouts.backend.app', ['title' => 'Expiration'])
            ->section('content');
    }


}
