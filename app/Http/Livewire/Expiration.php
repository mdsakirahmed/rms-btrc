<?php

namespace App\Http\Livewire;

use App\Models\Expiration as ModelsExpiration;
use App\Models\ExpirationWisePaymentDate;
use App\Models\Operator;
use App\Models\Payment;
use Carbon\Carbon;
use Livewire\Component;
use DateTime;
use PDF;

class Expiration extends Component
{
    public $issue_date, $expire_date, $duration_year, $duration_month;
    public $operator, $expiration;

    public function mount(Operator $operator)
    {
        $this->operator = $operator;
        $this->duration_year = $operator->category->duration_year ?? 0;
        $this->duration_month = $operator->category->duration_month ?? 0;
    }

    public function create()
    {
        $this->issue_date = $this->expire_date = null;
        // $this->duration_year = $this->duration_month = null;
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
            $expiration = $this->expiration;
            $expiration->expiration_wise_payment_dates()->delete();
        } else {
            $expiration = ModelsExpiration::create([
                'operator_id' => $this->operator->id,
                'issue_date' => $this->issue_date,
                'expire_date' => $this->expire_date
            ]);
        }
        foreach($this->operator->category->category_wise_fees as $category_wise_fee_type){
            $counter = 1;
            for($issue_date = $expiration->issue_date; $issue_date < $expiration->expire_date; $issue_date->modify('+'.$category_wise_fee_type->period_month.' month')){
               ExpirationWisePaymentDate::create([
                   'expiration_id' => $expiration->id,
                   'fee_type_id' => $category_wise_fee_type->fee_type_id,
                   'paid' => false,
                   'payment_number' => $counter,
                   'period_date' => $issue_date,
               ]);
               $counter ++;
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

    public function delete(ModelsExpiration $expiration)
    {
        $expiration->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Success !']);
    }


    public function calculate_iteration()
    {
        $this->iteration = Carbon::parse($this->issue_date)->diffInMonths(Carbon::parse($this->issue_date)->addYears($this->duration_year ?? 0)->addMonths($this->duration_month ?? 0)) / 2;
        $this->expire_date = Carbon::parse($this->issue_date)->addYears($this->duration_year ?? 0)->addMonths($this->duration_month ?? 0)->format('Y-m-d');
    }

    public function render()
    {
        return view('livewire.expiration', [
            'expirations' => ModelsExpiration::latest()->where('operator_id', $this->operator->id)->get()
        ])->extends('layouts.backend.app', ['title' => 'Expiration'])
            ->section('content');
    }
}
