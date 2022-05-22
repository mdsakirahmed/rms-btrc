<?php

namespace App\Http\Livewire;

use App\Models\Expiration as ModelsExpiration;
use App\Models\ExpirationWisePaymentDate;
use App\Models\Operator;
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
        $this->validate([
            'issue_date' => 'required|date',
            'expire_date' => 'required|date',
        ]);
        if ($this->expiration) {
            $this->expiration->update([
                'operator_id' => $this->operator->id,
                'issue_date' => $this->issue_date,
                'expire_date' => $this->expire_date
            ]);
            $this->expiration->expiration_wise_payment_dates()->delete();
        } else {
            $expiration = ModelsExpiration::create([
                'operator_id' => $this->operator->id,
                'issue_date' => $this->issue_date,
                'expire_date' => $this->expire_date
            ]);
        }


        $issue_m = Carbon::create($expiration->issue_date)->format('m');
        $issue_y = Carbon::create($expiration->issue_date)->format('Y');
        $expire_m = Carbon::create($expiration->expire_date)->format('m');
        $expire_y = Carbon::create($expiration->expire_date)->format('Y');

        foreach ($this->operator->category->category_wise_fees as $category_wise_fee_type) {
            for ($issue_y; $issue_y <= $expire_y; $issue_y++) {
                $counter = 1;
                if ($issue_y == $expire_y) {
                    $periods = $category_wise_fee_type->fee_type->periods()->where('starting_month', '<=', $expire_m)->orWhere('ending_month', '<=', $expire_m)->get();
                } else {
                    $periods = $category_wise_fee_type->fee_type->periods()->where('starting_month', '>=', $issue_m)->orWhere('ending_month', '>=', $issue_m)->get();
                }
                foreach ($periods as $period) {
                    $period_label = '';
                    if($period->fee_type->period_format == 1){
                        $period_label = date('M', mktime(0, 0, 0, $period->starting_month, 10)).'/'.$issue_y.'-'.substr($issue_y+1, -2);
                    }elseif($period->fee_type->period_format == 2){
                        $period_label = date('M', mktime(0, 0, 0, $period->starting_month, 10)).'-'.date('M', mktime(0, 0, 0, $period->ending_month, 10)).'/'.$issue_y;
                    }
                    
                    ExpirationWisePaymentDate::create([
                        'expiration_id' => $expiration->id,
                        'fee_type_id' => $period->fee_type_id,
                        'payment_number' => $counter,
                        'period_start_date' => $issue_y . '-' . str_pad($period->starting_month, 2, "0", STR_PAD_LEFT) . '-01',
                        'period_end_date' => Carbon::parse($issue_y . '-' . str_pad($period->ending_month, 2, "0", STR_PAD_LEFT) . '-01')->endOfMonth(),
                        'period_schedule_date' => Carbon::parse($issue_y . '-' . str_pad($period->starting_month, 2, "0", STR_PAD_LEFT) . '-01')->addDays($period->fee_type->schedule_day)->addMonths($period->fee_type->schedule_month)->subDays(1),
                        'period_label' => $period_label
                    ]);
                    $counter++;
                }
                $issue_m = 1;
            }
        }

        $this->create();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Success !']);
    }

    public function select_for_edit(ModelsExpiration $expiration)
    {
        $this->expiration = $expiration;
        $this->issue_date = $expiration->issue_date;
        $this->expire_date = $expiration->expire_date;
    }

    public function select_for_periods(ModelsExpiration $expiration)
    {
        $this->periods = ExpirationWisePaymentDate::where('expiration_id', $expiration->id)->get();
    }

    public function delete(ModelsExpiration $expiration)
    {
        $expiration->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Success !']);
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
