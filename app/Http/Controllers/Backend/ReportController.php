<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Operator;
use App\Models\PartialPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $data_set =
            PartialPayment::where(function ($query) {
                return request()->start_date ? $query->from('partial_payments')->whereDate('payment_date', '>=', request()->start_date) : '';
            })->where(function ($query) {
                return request()->end_date ? $query->from('partial_payments')->whereDate('payment_date', '<=', request()->end_date) : '';
            })->where(function ($query) {
                return request()->late_fee ? $query->from('partial_payments')->where('late_fee', '>', 0) : '';
            })->where(function ($query) {
                return request()->journal_number ? $query->from('partial_payments')->where('journal_number', request()->journal_number) : '';
            })->where(function ($query) {
                return request()->pay_order_number ? $query->from('partial_payments')->where('pay_order_number', request()->pay_order_number) : '';
            })->where(function ($query) {
                return request()->bank ? $query->from('partial_payments')->where('bank', request()->bank) : '';
            })->with(['payment' => function ($payment) {
                $payment->with(['expiration' => function ($expiration) {
                    $expiration->with(['operator' => function ($operator) {
                        if(request()->operator){
                            $operator->where('name', request()->operator);
                        }
                        $operator->with(['category' => function($category){
                            if(request()->category){
                                $category->where('name', request()->category);
                            }
                        }]);
                        $operator->with(['sub_category' => function($sub_category){
                            if(request()->sub_category){
                                $sub_category->where('name', request()->sub_category);
                            }
                        }]);
                    }]);
                }]);
            }])->get();

        return view('backend.report', [
            'banks' => Bank::latest()->get(),
            'data_set' => $data_set
        ]);
    }

    public function getSuggestionForFilter()
    {
        try {
            return DB::table(request()->table)->select(request()->table . '.' . request()->column . ' as name')
                ->where(request()->column, 'like', '%' . request()->keyword . '%')
                ->get();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function filterSubmit()
    {
    }
}
