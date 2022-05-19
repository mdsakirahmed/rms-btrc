<?php

namespace App\Http\Livewire;

use App\Models\Bank;
use App\Models\Expiration;
use App\Models\ExpirationWisePaymentDate;
use App\Models\FeeType;
use App\Models\LicenseCategory;
use App\Models\LicenseCategoryWiseFeeType;
use App\Models\LicenseSubCategory;
use App\Models\Operator;
use App\Models\Payment as ModelsPayment;
use App\Models\PaymentWiseDeposit;
use App\Models\PaymentWisePayOrder;
use App\Models\PaymentWiseReceive;
use Carbon\Carbon;
use Livewire\Component;
use niklasravnsborg\LaravelPdf\Facades\Pdf as PDF;

class Payment extends Component
{
    public $transaction, $selected_category, $selected_sub_category, $selected_operator;
    public $receive_section_array = [], $po_section_array = [], $deposit_section_array = [];

    public function mount()
    {
        array_push($this->receive_section_array, null);
        array_push($this->po_section_array, null);
        array_push($this->deposit_section_array, null);
    }

    public function render()
    {
        $this->transaction = date('ym') . '-' . convert_to_initial(auth()->user()->name) . '-' . sprintf("%'.05d\n", (ModelsPayment::latest()->first()->id ?? 0) + 1);
        $data = [
            'categories' => LicenseCategory::all(),
            'sub_categories' => LicenseSubCategory::all(),
            'banks' => Bank::all(),
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
        $this->receive_section_array[$key]['vat_receive_amount'] =  round((($category_wise_fee_type->amount / 100) * $category_wise_fee_type->vat), 2) ?? 0;
        $this->receive_section_array[$key]['tax_receive_amount'] =  round((($category_wise_fee_type->amount / 100) * $category_wise_fee_type->tax), 2) ?? 0;
    }

    public function period_change($key)
    {
        $this->receive_section_array[$key]['schedule_date'] = ExpirationWisePaymentDate::find($this->receive_section_array[$key]['selected_period'])->period_schedule_date->format('d-M-Y');
    }

    // Late fee effected
    public function receive_date_change($key)
    {
        $this->validate([
            'receive_section_array.' . $key . '.selected_fee_type' => 'required',
            'receive_section_array.' . $key . '.selected_period' => 'required',
        ], [], [
            'receive_section_array.' . $key . '.selected_fee_type' => 'Fee type',
            'receive_section_array.' . $key . '.selected_period' => 'Period',
        ]);
        // If receive amount if empty or not integer input than integer value auto fill
        $this->receive_section_array[$key]['receive_amount'] = intval($this->receive_section_array[$key]['receive_amount']);
        $fee_type_id = $this->receive_section_array[$key]['selected_fee_type'];
        $category_wise_fee_type = LicenseCategoryWiseFeeType::where('category_id', $this->selected_category)->where('fee_type_id', $fee_type_id)->first();
        $late_fee_amount_of_one_year = ((($this->receive_section_array[$key]['receive_amount'] ?? 0) / 100) * $category_wise_fee_type->late_fee) ?? 0;
        $schedule_date = ExpirationWisePaymentDate::find($this->receive_section_array[$key]['selected_period'])->period_schedule_date;
        $this->receive_section_array[$key]['late_days'] = 0;
        if (Carbon::parse($this->receive_section_array[$key]['receive_date'])->diffInDays($schedule_date, false) < 0) {
            $this->receive_section_array[$key]['late_days'] =  abs(Carbon::parse($this->receive_section_array[$key]['receive_date'])->diffInDays($schedule_date, false));
        }
        $this->receive_section_array[$key]['late_fee_receive_amount'] = round(($late_fee_amount_of_one_year / 365) * $this->receive_section_array[$key]['late_days']);
    }

    // Late fee effected
    public function receive_amount_change($key, $receive_amount)
    {
        $this->validate([
            'receive_section_array.' . $key . '.selected_fee_type' => 'required',
            'receive_section_array.' . $key . '.selected_period' => 'required',
        ], [], [
            'receive_section_array.' . $key . '.selected_fee_type' => 'Fee type',
            'receive_section_array.' . $key . '.selected_period' => 'Period',
        ]);
        // If receive amount if empty or not integer input than integer value auto fill
        $this->receive_section_array[$key]['receive_amount'] = intval($receive_amount);
        $fee_type_id = $this->receive_section_array[$key]['selected_fee_type'];
        $category_wise_fee_type = LicenseCategoryWiseFeeType::where('category_id', $this->selected_category)->where('fee_type_id', $fee_type_id)->first();
        $late_fee_amount_of_one_year = ((($this->receive_section_array[$key]['receive_amount'] ?? 0) / 100) * $category_wise_fee_type->late_fee) ?? 0;
        $schedule_date = ExpirationWisePaymentDate::find($this->receive_section_array[$key]['selected_period'])->period_schedule_date;
        $this->receive_section_array[$key]['late_days'] = 0;
        if (Carbon::parse($this->receive_section_array[$key]['receive_date'])->diffInDays($schedule_date, false) < 0) {
            $this->receive_section_array[$key]['late_days'] =  abs(Carbon::parse($this->receive_section_array[$key]['receive_date'])->diffInDays($schedule_date, false));
        }
        $this->receive_section_array[$key]['late_fee_receive_amount'] = round(($late_fee_amount_of_one_year / 365) * $this->receive_section_array[$key]['late_days']);

        // Vat tax amount update for changing receive amount
        $this->receive_section_array[$key]['vat_receive_amount'] =  (($this->receive_section_array[$key]['receive_amount'] / 100) * $category_wise_fee_type->vat) ?? 0;
        $this->receive_section_array[$key]['tax_receive_amount'] =  (($this->receive_section_array[$key]['receive_amount'] / 100) * $category_wise_fee_type->tax) ?? 0;
    }

    public function reset_section($section){
        if($section == 'receive'){
            foreach($this->receive_section_array as $key => $receive){
                $this->receive_section_array[$key]['selected_fee_type'] = '';
                $this->receive_section_array[$key]['selected_period'] = '';
                $this->receive_section_array[$key]['schedule_date'] = null;
                $this->receive_section_array[$key]['receive_date'] = null;
                $this->receive_section_array[$key]['receive_amount'] = 0;
                $this->receive_section_array[$key]['late_fee_receive_amount'] = 0;
            }
        }
        if($section == 'po'){
            foreach($this->po_section_array as $key => $po){
                $this->po_section_array[$key]['po_amount'] = 0;
                $this->po_section_array[$key]['po_number'] = null;
                $this->po_section_array[$key]['po_date'] = null;
                $this->po_section_array[$key]['po_bank'] = '';
            }
        }
        if($section == 'deposit'){
            foreach($this->po_section_array as $key => $po){
                $this->deposit_section_array[$key]['deposit_amount'] = 0;
                $this->deposit_section_array[$key]['deposit_bank'] = '';
                $this->deposit_section_array[$key]['journal_number'] = null;
                $this->deposit_section_array[$key]['deposit_date'] = null;
            }
        }
    }

    public function submit()
    {
        $this->validate([
            'transaction' => 'required',
            'selected_category' => 'required',
            'selected_sub_category' => 'required',
            'selected_operator' => 'required',
            'receive_section_array.*.selected_fee_type' => 'required',
            'receive_section_array.*.selected_period' => 'required',
            'receive_section_array.*.schedule_date' => 'required',
            'receive_section_array.*.receive_date' => 'required',
            'receive_section_array.*.receivable' => 'required',
            'receive_section_array.*.receive_amount' => 'required',
            'receive_section_array.*.late_fee_receive_amount' => 'required',
            'receive_section_array.*.vat_receive_amount' => 'required',
            'receive_section_array.*.tax_receive_amount' => 'required',
        ], [], [
            'receive_section_array.*.selected_fee_type' => 'Fee type',
            'receive_section_array.*.selected_period' => 'Period',
            'receive_section_array.*.schedule_date' => 'Schedule date',
            'receive_section_array.*.receive_date' => 'Receive date',
            'receive_section_array.*.receivable' => 'Receivable amount',
            'receive_section_array.*.receive_amount' => 'Receive amount',
            'receive_section_array.*.late_fee_receive_amount' => 'Late fee',
            'receive_section_array.*.vat_receive_amount' => 'VAT amount',
            'receive_section_array.*.tax_receive_amount' => 'TAX amount',
        ]);

        if ((array_sum(array_column($this->receive_section_array, 'receive_amount')) + array_sum(array_column($this->receive_section_array, 'late_fee_receive_amount')) + array_sum(array_column($this->receive_section_array, 'vat_receive_amount')))
            == array_sum(array_column($this->po_section_array, 'po_amount')) && array_sum(array_column($this->po_section_array, 'po_amount')) == array_sum(array_column($this->deposit_section_array, 'deposit_amount'))
        ) {

            // Payment
            $payment = ModelsPayment::create([
                'operator_id' => $this->selected_operator,
                'transaction' => $this->transaction,
            ]);

            // Receive
            foreach ($this->receive_section_array as $receive) {
                PaymentWiseReceive::create([
                    'payment_id' => $payment->id,
                    'period_id' => $receive['selected_period'],
                    'receive_date' => $receive['receive_date'],
                    'receive_amount' => $receive['receive_amount'] ?? 0,
                    'late_fee_percentage' => $receive['late_fee_percentage'] ?? 0,
                    'late_fee_receive_amount' => $receive['late_fee_receive_amount'] ?? 0,
                    'vat_percentage' => $receive['vat_percentage'] ?? 0,
                    'tax_percentage' => $receive['tax_percentage'] ?? 0,
                    'late_days' => $receive['late_days'] ?? 0,
                    'late_fee_amount' => $receive['late_fee_receive_amount'] ?? 0,
                ]);

                //Update expiration wise payment date status
                $expirationWisePaymentDate = ExpirationWisePaymentDate::find($receive['selected_period']);
                $expirationWisePaymentDate->update(['paid' => true]);

                // If all period of payment is done than this expiration will be done
                if ($expirationWisePaymentDate->expiratiorn->expiration_wise_payment_dates()->where('paid', false)->count() == 0) {
                    $expirationWisePaymentDate->expiratiorn->update(['all_payment_completed' => true]);
                }
            }

            // pay_order
            foreach ($this->po_section_array as $pay_order) {
                PaymentWisePayOrder::create([
                    'payment_id' => $payment->id,
                    'amount' => $pay_order['po_amount'] ?? 0,
                    'number' => $pay_order['po_number'],
                    'date' => $pay_order['po_date'],
                    'bank_id' => $pay_order['po_bank'],
                ]);
            }

            foreach ($this->deposit_section_array as $deposit) {
                PaymentWiseDeposit::create([
                    'payment_id' => $payment->id,
                    'amount' => $deposit['deposit_amount'],
                    'bank_id' => $deposit['deposit_bank'],
                    'journal_number' => $deposit['journal_number'],
                    'date' => $deposit['deposit_date'],
                ]);
            }

            return response()->streamDownload(function () use ($payment) {
                PDF::loadView('pdf.payment-receipt', [
                    'file_name' => 'Payment receipt',
                    'payment' => $payment
                ])->download();
                $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Success !']);
                redirect()->to('/payment2');
            }, 'Payment receipt generated at ' . date('d-m-Y- h-i-s') . '.pdf');
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => '3 payment section are not equal !']);
        }
    }
}
