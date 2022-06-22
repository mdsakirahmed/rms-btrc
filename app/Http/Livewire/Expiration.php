<?php

namespace App\Http\Livewire;

use App\Models\Expiration as ModelsExpiration;
use App\Models\Period;
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
        $validated_data = $this->validate([
            'issue_date' => 'required|date',
            'expire_date' => 'required|date',
        ]);
        if(ModelsExpiration::where('operator_id', $this->operator->id)->whereDate('expire_date', '>=', $this->issue_date)->first()){
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'Issue date already in a period !']);
        }else{
            $validated_data['operator_id'] = $this->operator->id;
            if ($this->expiration) {
                $expiration = $this->expiration;
                /*Have to work by checking period and payment wise receive table*/
               /* $expiration->update($validated_data);
                $expiration->periods()->delete();*/
            } else {
                $expiration = ModelsExpiration::create($validated_data);
            }

            $ar = [];

            foreach ($this->operator->category->category_wise_fees as $category_wise_fee_type) {
                if($category_wise_fee_type->category->period_start_with_issue_date){
                    $period_start_date = $expiration->issue_date;
                }else{
                    $period_start_date = Carbon::create($expiration->issue_date)->firstOfYear();
                    do{
                        $period_end_date = $period_start_date->addMonths($category_wise_fee_type->fee_type->period_month);
//                        dd(Carbon::create($expiration->issue_date)->firstOfYear()->format('Y-m-d'), $period_start_date->format('Y-m-d'), $period_temp_end_date->format('Y-m-d'));
                        if($category_wise_fee_type->fee_type->schedule_include_to_beginning_of_period){
                            $period_schedule_date = Carbon::create( $period_start_date)->addDays($category_wise_fee_type->fee_type->schedule_day)->addMonths($category_wise_fee_type->fee_type->schedule_month)->format('Y-m-d');
                        }else{
                            $period_schedule_date = Carbon::create($period_end_date)->addDays($category_wise_fee_type->fee_type->schedule_day)->addMonths($category_wise_fee_type->fee_type->schedule_month)->format('Y-m-d');
                        }

                        array_push($ar, [
                            [
                                'operator_id' => $this->operator->id,
                                'expiration_id' => $expiration->id,
                                'fee_type_id' => $category_wise_fee_type->fee_type_id,
                                'payment_number' => 0,
                                'period_start_date' => $period_start_date->format('Y-m-d'),
                                'period_end_date' => $period_end_date->format('Y-m-d'),
                                'period_schedule_date' => $period_schedule_date,
                                'period_label' => '123',
                                'total_receivable' => 0,
                                'paid' => 0,

                            ]
                        ]);
                        $period_start_date = $period_start_date->addMonths($category_wise_fee_type->fee_type->period_month);
                    }while($period_start_date <= Carbon::create($expiration->expire_date));
                }
            }

            $this->create();
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Success !']);
        }
        dd($ar, 'sakir');
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
