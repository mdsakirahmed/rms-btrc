<?php

namespace App\Http\Livewire\Report;

use App\Exports\VatStatementExport;
use App\Models\LicenseCategory;
use App\Models\LicenseSubCategory;
use DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\Paginator;

class VatStatement extends Component
{

    public $selected_category, $selected_sub_category, $search,
        $category_name, $sub_category_name, $operator_name, $receive_date, $fee_type_name, $period_date, $receive_amount,
        $receive_vat;

    public function setPage($url)
    {
        $this->currentPage = explode('page=', $url)[1];
        Paginator::currentPageResolver(function () {
            return $this->currentPage;
        });
    }

    public function mount()
    {
        $this->selected_category = 'all';
        $this->selected_sub_category = 'all';
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.report.vat-statement', [
            'categories' => LicenseCategory::all(),
            'sub_categories' => LicenseSubCategory::all(),
            'payments' => $this->get_payments()->paginate(100),
        ])->extends('layouts.backend.app', ['title' => 'VAT Statement'])
            ->section('content');
    }

    public function get_payments()
    {
        return DB::table('payments')
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
                'fee_types.name as fee_type_name',
                'payment_wise_receives.period_date',
                'payment_wise_receives.receive_date',
                'payment_wise_receives.receive_amount as receive_amount',
                'payment_wise_receives.vat_percentage as receive_vat',
            )->where(function ($query) {
                if ($this->selected_category != 'all') {
                    $query->where('category_id', $this->selected_category);
                }
                if ($this->selected_sub_category != 'all') {
                    $query->where('sub_category_id', $this->selected_sub_category);
                }
                $query->where('categories.name', 'like', '%' . $this->category_name . '%');
                $query->where('sub_categories.name', 'like', '%' . $this->sub_category_name . '%');
                $query->where('operators.name', 'like', '%' . $this->operator_name . '%');
                $query->where('payment_wise_receives.receive_date', 'like', '%' . $this->receive_date . '%');
                $query->where('fee_types.name', 'like', '%' . $this->fee_type_name . '%');
                $query->where('payment_wise_receives.period_date', 'like', '%' . $this->period_date . '%');
                $query->where('payment_wise_receives.receive_amount', 'like', '%' . $this->receive_amount . '%');
                $query->where('payment_wise_receives.vat_percentage', 'like', '%' . $this->receive_vat . '%');
            });
    }

    public function export()
    {
        $collection = $this->payments()->get();
        return Excel::download(new VatStatementExport($collection), 'Vat statement ' . date('d-m-Y h-i-s a') . '.xlsx');
    }
}
