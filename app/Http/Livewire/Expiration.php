<?php

namespace App\Http\Livewire;

use App\Models\Expiration as ModelsExpiration;
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
    }

    public function create()
    {
        $this->issue_date = $this->expire_date = $this->duration_year = $this->duration_month = null;
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
        } else {
            ModelsExpiration::create([
                'operator_id' => $this->operator->id,
                'issue_date' => $this->issue_date,
                'expire_date' => $this->expire_date
            ]);
            $this->create();
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Success !']);
        }
    }

    public function select_for_edit(ModelsExpiration $expiration)
    {
        $this->issue_date = $expiration->issue_date;
        $this->expire_date = $expiration->expire_date;
        $this->price = $expiration->price;
        $this->iteration = $expiration->iteration;
        $this->expiration = $expiration;
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

    public function download_payment_schedule(ModelsExpiration $expiration)
    {
        $this->expiration = $expiration;
        return response()->streamDownload(function () {
            PDF::loadView('pdf.payment-schedule',  ['expiration' => $this->expiration])->download();
        }, 'Payment schedule download at -' . date('d-m-Y h-i-s') . '.pdf');
    }

    public function render()
    {
        return view('livewire.expiration', [
            'expirations' => ModelsExpiration::latest()->where('operator_id', $this->operator->id)->get()
        ])->extends('layouts.backend.app', ['title' => 'Expiration'])
            ->section('content');
    }
}
