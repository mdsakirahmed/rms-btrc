<?php

namespace App\Http\Livewire\Report;

use App\Exports\VatStatementExport;
use App\Models\LicenseCategory;
use App\Models\LicenseSubCategory;
use App\Models\Operator;
use DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class DueStatement extends Component
{
    public $selected_category, $selected_sub_category, $selected_operator, $search;

    public function mount()
    {
        $this->selected_category = 'all';
        $this->selected_sub_category = 'all';
        $this->selected_operator = 'all';
    }

    public function render()
    {
        return view('livewire.report.due-statement', [
            'categories' => LicenseCategory::all(),
            'sub_categories' => LicenseSubCategory::all(),
            'operators' => $this->get_operators(),
            'payments' => $this->get_payments()->paginate(100),
        ])->extends('layouts.backend.app', ['title' => 'VAT Statement'])
            ->section('content');
    }

    public function get_operators()
    {
        return Operator::where(function ($query) {
            if ($this->selected_category != 'all') {
                $query->where('category_id', $this->selected_category);
            }
            if ($this->selected_sub_category != 'all') {
                $query->where('sub_category_id', $this->selected_sub_category);
            }
            if ($this->selected_operator != 'all') {
                $query->where('id', $this->selected_operator);
            }
        })->where('name', 'like', '%' . $this->search . '%')->get();
    }

    public function get_payments()
    {
        $payments = DB::table('payments')
            ->join('payment_wise_receives', 'payments.id', '=', 'payment_wise_receives.payment_id')
            ->join('operators', 'payments.operator_id', '=', 'operators.id')
            ->join('license_categories as categories', 'operators.category_id', '=', 'categories.id')
            ->join('license_sub_categories as sub_categories', 'operators.sub_category_id', '=', 'sub_categories.id')
            ->join('fee_types', 'payment_wise_receives.fee_type_id', '=', 'fee_types.id')
            ->select(
                'operators.name as operator_name',
                'operators.id as operator_id',
                'categories.name as category_name',
                'categories.id as category_id',
                'sub_categories.name as sub_category_name',
                'sub_categories.id as sub_category_id',
                'payments.transaction',
                'fee_types.name as fee_type_name',
                'payment_wise_receives.period_date',
                'payment_wise_receives.receive_date',
                'payment_wise_receives.receive_amount as receive_amount',
                'payment_wise_receives.late_fee_percentage as receive_late_fee',
                'payment_wise_receives.vat_percentage as receive_vat',
                'payment_wise_receives.tax_percentage as receive_tax',
            )->where(function ($query) {
                if ($this->selected_category != 'all') {
                    $query->where('category_id', $this->selected_category);
                }
                if ($this->selected_sub_category != 'all') {
                    $query->where('sub_category_id', $this->selected_sub_category);
                }
                if ($this->selected_operator != 'all') {
                    $query->where('operator_id', $this->selected_operator);
                }
            });

        return $payments;
    }

    public function export()
    {
        $collection = $this->payments()->get();
        return Excel::download(new VatStatementExport($collection), 'Vat statement ' . date('d-m-Y h-i-s a') . '.xlsx');
    }
}
