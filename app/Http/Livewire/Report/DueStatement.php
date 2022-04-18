<?php

namespace App\Http\Livewire\Report;

use App\Exports\DueStatementExport;
use App\Models\LicenseCategory;
use App\Models\LicenseSubCategory;
use DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\Paginator;

class DueStatement extends Component
{

    public $selected_category, $selected_sub_category, 
    $search_for_category_name, $search_for_sub_category_name, $search_for_operator_name,
    $search_for_receive_fee_type_name, $search_for_receive_period_date;

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
        // dd($this->get_payments()->get());
        return view('livewire.report.due-statement', [
            'categories' => LicenseCategory::all(),
            'sub_categories' => LicenseSubCategory::all(),
            'operators' => $this->get_payments()->paginate(100),
        ])->extends('layouts.backend.app', ['title' => 'Due Statement'])
            ->section('content');
    }

    public function get_payments()
    {
        return DB::table('operators')
        ->join('license_categories as categories', 'operators.category_id', '=', 'categories.id')
        ->join('license_sub_categories as sub_categories', 'operators.sub_category_id', '=', 'sub_categories.id')
        ->join('expirations', 'operators.id', '=', 'expirations.operator_id')
        ->join('expiration_wise_payment_dates', 'expirations.id', '=', 'expiration_wise_payment_dates.expiration_id')->where('paid', false)->where('period_date', '<', date('Y-m-d'))
        ->join('fee_types', 'expiration_wise_payment_dates.fee_type_id', '=', 'fee_types.id')
        ->select(
            'operators.*',
            'categories.name as category_name',
            'categories.id as category_id',
            'sub_categories.name as sub_category_name',
            'sub_categories.id as sub_category_id',
            'fee_types.name as fee_type_name',
            'expiration_wise_payment_dates.period_date as period_date',
        )->where(function ($query) {
            $query->where('categories.name', 'like', '%' . $this->search_for_category_name . '%');
            $query->where('sub_categories.name', 'like', '%' . $this->search_for_sub_category_name . '%');
            $query->where('operators.name', 'like', '%' . $this->search_for_operator_name . '%');
            $query->where('fee_types.name', 'like', '%' . $this->search_for_receive_fee_type_name . '%');
            $query->where('expiration_wise_payment_dates.period_date', 'like', '%' . $this->search_for_receive_period_date . '%');
        });
    }

    public function export()
    {
        $collection = $this->get_payments()->get();
        return Excel::download(new DueStatementExport($collection), 'Due statement ' . date('d-m-Y h-i-s a') . '.xlsx');
    }
}
