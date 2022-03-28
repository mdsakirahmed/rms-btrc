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
    public $operator_id, $issue_date, $expire_date, $price, $iteration;
    public $operator, $expiration;
    public $duration_year, $duration_month, $fee;

    public function mount()
    {
        $this->operator = Operator::find(request()->operator);
    }

    public function create()
    {
        $this->issue_date = $this->expire_date = $this->price = $this->iteration = null;
        if ($this->operator) {
            $this->operator_id = $this->operator->id;
            $this->issue_date = Carbon::today()->format('Y-m-d');
            $this->expire_date = Carbon::now()->addYears($this->operator->category->duration_year ?? 0)->addMonths($this->operator->category->duration_month ?? 0)->format('Y-m-d');
            $this->iteration = $this->operator->category->payment_iteration ?? 0;
            $this->duration_year = $this->operator->category->duration_year ?? 0;
            $this->duration_month = $this->operator->category->duration_month ?? 0;
            $this->fee = $this->operator->category->license_fee ?? 0;
        }
    }

    public function submit()
    {
        $validate_data = $this->validate([
            'operator_id' => 'required|exists:operators,id',
            'issue_date' => 'required|date',
            'expire_date' => 'required|date',
            'price' => 'required|numeric',
            'fee' => 'required|numeric',
            'iteration' => 'required|numeric',
        ]);
        if ($this->expiration) {
            $this->expiration->update($validate_data);
        } else {
            $expitation = ModelsExpiration::create($validate_data);
            // Now create payment schedules
            try {
                $issue_date = Carbon::parse($expitation->issue_date);
                for ($iteration = 1; $iteration <= $expitation->iteration; $iteration++) {
                    $issue_date =  Carbon::parse($issue_date)->addMonths(2)->format('Y-m-d');
                    $payment = new Payment();
                    $payment->expiration_id = $expitation->id;
                    $payment->payble_amount = round($expitation->price / $expitation->iteration);
                    $payment->last_date_of_payment = $issue_date;
                    $payment->save();
                }
                $this->create();
                $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Success !']);
            } catch (\Exception $exception) {
                $expitation->delete();
                $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => $exception->getMessage()]);
            }
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

    public function change_expire_date()
    {
        $this->expire_date = Carbon::parse($this->issue_date)->addMonths(($this->iteration ?? 0) * 2)->format('Y-m-d');
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
        if ($this->operator) {
            $expirations = ModelsExpiration::latest()->where('operator_id', $this->operator->id)->get();
        } else {
            $expirations = ModelsExpiration::latest()->get();
        }
        return view('livewire.expiration', [
            'expirations' => $expirations
        ])->layout('layouts.backend.app');
    }
}
