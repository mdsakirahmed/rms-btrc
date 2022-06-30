<?php

namespace App\Http\Livewire;

use App\Models\Bank;
use App\Models\Expiration;
use App\Models\FeeType;
use App\Models\LicenseCategory;
use App\Models\LicenseCategoryWiseFeeType;
use App\Models\LicenseSubCategory;
use App\Models\Operator;
use App\Models\Payment as ModelsPayment;
use App\Models\PaymentWiseDeposit;
use App\Models\PaymentWisePayOrder;
use App\Models\PaymentWiseReceive;
use App\Models\Period;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use niklasravnsborg\LaravelPdf\Facades\Pdf as PDF;

class PaymentEdit extends Component
{
    public $payment;
    public $transaction, $selected_category, $selected_sub_category, $selected_operator, $selected_expiration;
    public $receive_section_array = [], $po_section_array = [], $deposit_section_array = [];

    public function mount(\App\Models\Payment $payment){
        $this->payment = $payment;
        $this->transaction = $this->payment->transaction;
        $this->selected_category = $this->payment->operator->category_id;
        $this->selected_sub_category = $this->payment->operator->sub_category_id;
        $this->selected_operator = $this->payment->operator_id;
        $this->selected_expiration = Expiration::where('operator_id', $this->selected_operator)->where('paid', false)->first() ?? null;

        //Receive data bind
        foreach ($payment->receives as $key => $receive){
            array_push($this->receive_section_array, [
                'selected_fee_type' =>  $receive->period->fee_type_id,
                'selected_period' => $receive->period_id,
                'schedule_date' => $receive->period->period_schedule_date->format('d-M-Y'),
                'receive_date' => $receive->receive_date->format('Y-m-d'),
                'receivable' => $receive->period->total_receivable,
                'receive_amount' => $receive->receive_amount,
                'late_fee_receive_amount' => $receive->late_fee_receive_amount,
                'vat_receive_amount' => round(($receive->vat_percentage/100) * $receive->receive_amount),
                'tax_receive_amount' => round(($receive->tax_percentage/100) * $receive->receive_amount),
                'payment_wise_receive_id' => $receive->id,
            ]);
            $this->receive_section_array[$key]['periods'] = Period::where('expiration_id', $this->selected_expiration->id ?? null)->where('fee_type_id', $receive->period->fee_type_id)->get();
        }

        //PO data bind
        foreach ($payment->pay_orders as $key => $pay_order){
            array_push($this->po_section_array, [
                'po_amount' =>  $pay_order->amount,
                'po_number' => $pay_order->number,
                'po_date' => $pay_order->date->format('Y-m-d'),
                'po_bank' => $pay_order->bank_id,
                'payment_wise_po_id' => $pay_order->id,
            ]);
        }

        //Deposit data bind
        foreach ($payment->deposits as $key => $deposit){
            array_push($this->deposit_section_array, [
                'po_number' =>  $deposit->po_number,
                'deposit_amount' => $deposit->amount,
                'deposit_date' => $deposit->date->format('Y-m-d'),
                'deposit_bank' => $deposit->bank_id,
                'journal_number' => $deposit->journal_number,
                'payment_wise_deposit_id' => $deposit->id,
            ]);
        }
    }

    public function render()
    {
        $this->selected_expiration = Expiration::where('operator_id', $this->selected_operator)->where('paid', false)->first() ?? null;

        $data = [
            'categories' => LicenseCategory::all(),
            'sub_categories' => LicenseSubCategory::all(),
            'po_banks' => Bank::where('type', 'po')->get(),
            'deposit_banks' => Bank::where('type', 'deposit')->get(),
            'users' => User::all(),
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
                if ($this->selected_operator && $this->selected_expiration) {
                    $query->whereIn('id', $this->selected_expiration->periods()->distinct()->pluck('fee_type_id'));
                } else {
                    $query->whereIn('id', []);
                }
            })->get()
        ];

        return view('livewire.payment-edit', $data)->extends('layouts.backend.app', ['title' => 'Payment Edit'])
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

    public function make_as_lock_or_unlock($section, $rm_key)
    {
        if ($section == 'receive') {
            $this->receive_section_array[$rm_key]['lock'] = !($this->receive_section_array[$rm_key]['lock'] ?? false);
        } elseif ($section == 'po') {
            $this->po_section_array[$rm_key]['lock'] = !($this->po_section_array[$rm_key]['lock'] ?? false);
        } elseif ($section == 'deposit') {
            $this->deposit_section_array[$rm_key]['lock'] = !($this->deposit_section_array[$rm_key]['lock'] ?? false);
        }
    }

    public function make_as_reset($section, $key)
    {
        if ($section == 'receive') {
            $this->receive_section_array[$key]['selected_fee_type'] = '';
            $this->receive_section_array[$key]['selected_period'] = '';
            $this->receive_section_array[$key]['schedule_date'] = null;
            $this->receive_section_array[$key]['receive_date'] = null;
            $this->receive_section_array[$key]['receive_amount'] = null;
            $this->receive_section_array[$key]['receivable'] = null;
            $this->receive_section_array[$key]['late_fee_receive_amount'] = null;
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'Reset']);
        } elseif ($section == 'po') {
            $this->po_section_array[$key]['po_amount'] = null;
            $this->po_section_array[$key]['po_number'] = null;
            $this->po_section_array[$key]['po_date'] = null;
            $this->po_section_array[$key]['po_bank'] = '';
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'Reset']);

        } elseif ($section == 'deposit') {
            $this->deposit_section_array[$key]['po_number'] = null;
            $this->deposit_section_array[$key]['deposit_amount'] = null;
            $this->deposit_section_array[$key]['deposit_bank'] = '';
            $this->deposit_section_array[$key]['journal_number'] = null;
            $this->deposit_section_array[$key]['deposit_date'] = null;
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'Reset']);

        }
    }

    public function fee_type_change($key)
    {
        $fee_type_id = $this->receive_section_array[$key]['selected_fee_type'];
        $this->receive_section_array[$key]['periods'] = Period::where('expiration_id', $this->selected_expiration->id ?? null)->where('fee_type_id', $fee_type_id)->get();

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
        $this->receive_section_array[$key]['schedule_date'] = Period::find($this->receive_section_array[$key]['selected_period'])->period_schedule_date->format('d-M-Y');
        if(Period::find($this->receive_section_array[$key]['selected_period'])->total_receivable > 0){
            $this->receive_section_array[$key]['receivable_field_disabled'] = true;
            $this->receive_section_array[$key]['receivable'] =  Period::find($this->receive_section_array[$key]['selected_period'])->total_due_amount();
        }else{
            $this->receive_section_array[$key]['receivable_field_disabled'] = false;
            $this->fee_type_change($key);
        }
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
        $late_fee_receivable_amount_of_one_year = ((($this->receive_section_array[$key]['receive_amount'] ?? 0) / 100) * $category_wise_fee_type->late_fee) ?? 0;
        $schedule_date = Period::find($this->receive_section_array[$key]['selected_period'])->period_schedule_date;
        $this->receive_section_array[$key]['late_days'] = 0;
        if (Carbon::parse($this->receive_section_array[$key]['receive_date'])->diffInDays($schedule_date, false) < 0) {
            $this->receive_section_array[$key]['late_days'] =  abs(Carbon::parse($this->receive_section_array[$key]['receive_date'])->diffInDays($schedule_date, false));
        }
        $this->receive_section_array[$key]['late_fee_receive_amount'] = round(($late_fee_receivable_amount_of_one_year / 365) * $this->receive_section_array[$key]['late_days']);
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
        $late_fee_receivable_amount_of_one_year = ((($this->receive_section_array[$key]['receive_amount'] ?? 0) / 100) * $category_wise_fee_type->late_fee) ?? 0;
        $schedule_date = Period::find($this->receive_section_array[$key]['selected_period'])->period_schedule_date;
        $this->receive_section_array[$key]['late_days'] = 0;
        if (Carbon::parse($this->receive_section_array[$key]['receive_date'])->diffInDays($schedule_date, false) < 0) {
            $this->receive_section_array[$key]['late_days'] =  abs(Carbon::parse($this->receive_section_array[$key]['receive_date'])->diffInDays($schedule_date, false));
        }
        $this->receive_section_array[$key]['late_fee_receive_amount'] = round(($late_fee_receivable_amount_of_one_year / 365) * $this->receive_section_array[$key]['late_days']);

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
                $this->receive_section_array[$key]['receivable'] = null;
                $this->receive_section_array[$key]['receive_amount'] = null;
                $this->receive_section_array[$key]['late_fee_receive_amount'] = null;
            }
        }
        if($section == 'po'){
            foreach($this->po_section_array as $key => $po){
                $this->po_section_array[$key]['po_amount'] = null;
                $this->po_section_array[$key]['po_number'] = null;
                $this->po_section_array[$key]['po_date'] = null;
                $this->po_section_array[$key]['po_bank'] = '';
            }
        }
        if($section == 'deposit'){
            foreach($this->po_section_array as $key => $po){
                $this->deposit_section_array[$key]['deposit_amount'] = null;
                $this->deposit_section_array[$key]['deposit_bank'] = '';
                $this->deposit_section_array[$key]['journal_number'] = null;
                $this->deposit_section_array[$key]['deposit_date'] = null;
            }
        }
    }

    public function submit()
    {
        if($this->payment->created_at->diffInDays()<=3 || auth()->user()->can('master')) {
            $this->validate([
                'transaction' => 'required',
                'selected_category' => 'required',
                'selected_sub_category' => 'required',
                'selected_operator' => 'required',
                'selected_expiration' => 'required',
                'receive_section_array.*.selected_fee_type' => 'required',
                'receive_section_array.*.selected_period' => 'required',
                'receive_section_array.*.schedule_date' => 'required',
                'receive_section_array.*.receive_date' => 'required',
                'receive_section_array.*.receivable' => 'required',
                'receive_section_array.*.receive_amount' => 'required',
                'receive_section_array.*.late_fee_receive_amount' => 'required',
                'receive_section_array.*.vat_receive_amount' => 'required',
                'receive_section_array.*.tax_receive_amount' => 'required',

                'po_section_array.*.po_amount' => 'required',
                'po_section_array.*.po_number' => 'required',
                'po_section_array.*.po_date' => 'required',
                'po_section_array.*.po_bank' => 'required',

                'deposit_section_array.*.deposit_amount' => 'required',
                'deposit_section_array.*.deposit_bank' => 'required',
                'deposit_section_array.*.journal_number' => 'required',
                'deposit_section_array.*.deposit_date' => 'required',
                'deposit_section_array.*.po_number' => 'required',
                // 'deposit_section_array.*.deposit_by' => 'required',
                // 'deposit_section_array.*.deposit_slip' => 'required',
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

                'po_section_array.*.po_amount' => 'PO Amount',
                'po_section_array.*.po_number' => 'PO Number',
                'po_section_array.*.po_date' => 'PO Date',
                'po_section_array.*.po_bank' => 'PO Bank',

                'deposit_section_array.*.deposit_amount' => 'Deposit Amount',
                'deposit_section_array.*.deposit_bank' => 'Deposit Bank',
                'deposit_section_array.*.journal_number' => 'Journal Number',
                'deposit_section_array.*.deposit_date' => 'Deposit Date',
                'deposit_section_array.*.po_number' => 'PO Number',
                // 'deposit_section_array.*.deposit_by' => 'Deposit by',
                // 'deposit_section_array.*.deposit_slip' => 'Seposit Slip',
            ]);
            if (round(array_sum(array_column($this->receive_section_array, 'receive_amount')) + array_sum(array_column($this->receive_section_array, 'late_fee_receive_amount')) + array_sum(array_column($this->receive_section_array, 'vat_receive_amount')))
                == round(array_sum(array_column($this->po_section_array, 'po_amount')))
                && round(array_sum(array_column($this->po_section_array, 'po_amount')))
                == round(array_sum(array_column($this->deposit_section_array, 'deposit_amount')))
            ) {

                // Payment
                $payment = $this->payment;
                $this->payment->update([
                    'operator_id' => $this->selected_operator,
                    'expiration_id' => $this->selected_expiration->id,
                    'transaction' => $this->transaction,
                ]);


                // Delete all payment_wise_receives from db
                $this->payment->receives()->whereNotIn('id', array_column($this->receive_section_array, 'payment_wise_receive_id'))->delete();

                // Receive
                foreach ($this->receive_section_array as $receive) {
                    // Set receivable amount at first time only
                    $period = Period::find($receive['selected_period']);
                    if ($period->total_receivable == 0) {
                        $period->update([
                            'total_receivable' => $receive['receivable']
                        ]);
                    }
                    if (isset($receive['payment_wise_receive_id'])) {
                        $paymentWiseReceive = PaymentWiseReceive::find($receive['payment_wise_receive_id']);
                    } else {
                        $paymentWiseReceive = new PaymentWiseReceive();
                    }
                    $paymentWiseReceive->payment_id = $payment->id;
                    $paymentWiseReceive->period_id = $receive['selected_period'];
                    $paymentWiseReceive->receive_date = $receive['receive_date'];
                    $paymentWiseReceive->receive_amount = $receive['receive_amount'] ?? 0;
                    $paymentWiseReceive->late_fee_percentage = $receive['late_fee_percentage'] ?? 0;
                    $paymentWiseReceive->late_fee_receive_amount = $receive['late_fee_receive_amount'] ?? 0;
                    $paymentWiseReceive->vat_percentage = $receive['vat_percentage'] ?? 0;
                    $paymentWiseReceive->tax_percentage = $receive['tax_percentage'] ?? 0;
                    $paymentWiseReceive->late_days = $receive['late_days'] ?? 0;
                    $paymentWiseReceive->late_fee_receivable_amount = $receive['late_fee_receive_amount'] ?? 0;
                    $paymentWiseReceive->save();
                }

                // Delete all payment_wise_pay_orders from db
                $this->payment->pay_orders()->whereNotIn('id', array_column($this->po_section_array, 'payment_wise_po_id'))->delete();

                // pay_order
                foreach ($this->po_section_array as $pay_order) {
                    if (isset($pay_order['payment_wise_po_id'])) {
                        $paymentWisePayOrder = PaymentWisePayOrder::find($pay_order['payment_wise_po_id']);
                    } else {
                        $paymentWisePayOrder = new PaymentWisePayOrder();
                    }
                    $paymentWisePayOrder->payment_id = $payment->id;
                    $paymentWisePayOrder->amount = $pay_order['po_amount'] ?? 0;
                    $paymentWisePayOrder->number = $pay_order['po_number'];
                    $paymentWisePayOrder->date = $pay_order['po_date'];
                    $paymentWisePayOrder->bank_id = $pay_order['po_bank'];
                    $paymentWisePayOrder->save();
                }

                // Delete all payment_wise_deposits from db
                $this->payment->deposits()->whereNotIn('id', array_column($this->deposit_section_array, 'payment_wise_deposit_id'))->delete();

                // Deposit
                foreach ($this->deposit_section_array as $deposit) {
                    if (isset($deposit['payment_wise_deposit_id'])) {
                        $paymentWiseDeposit = PaymentWiseDeposit::find($deposit['payment_wise_deposit_id']);
                    } else {
                        $paymentWiseDeposit = new PaymentWiseDeposit();
                    }
                    $paymentWiseDeposit->payment_id = $payment->id;
                    $paymentWiseDeposit->amount = $deposit['deposit_amount'];
                    $paymentWiseDeposit->bank_id = $deposit['deposit_bank'];
                    $paymentWiseDeposit->journal_number = $deposit['journal_number'];
                    $paymentWiseDeposit->date = $deposit['deposit_date'];
                    $paymentWiseDeposit->po_number = $deposit['po_number'];
                    $paymentWiseDeposit->deposit_by_user_id = $deposit['deposit_by'] ?? null;
                    $paymentWiseDeposit->slip = $deposit['deposit_slip'] ?? null;
                    $paymentWiseDeposit->save();
                }

                $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'Success !']);

            } else {
                $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'Collection, PO and Deposit are not equal !']);
            }
        }else{
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'Action Disabled !']);
        }
    }
}
