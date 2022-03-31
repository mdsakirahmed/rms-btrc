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
            })
            ->with(['payment' => function ($payment) {
                $payment->with(['expiration' => function ($expiration) {
                    $expiration->with(['operator' => function ($operator) {
                        $operator->with(['category', 'sub_category']);
                    }]);
                }]);
            }])


            ->get();

        //     $data  = Truck::where( function($query) use($request){
        //         return $request->filter_brand ?
        //                $query->from('trucks')->where('brand_id',$request->filter_brand) : '';
        //    })

        // $data_set = DB::table('partial_payments')
        // ->join('banks', 'partial_payments.bank_id', '=', 'banks.id')
        // // ->join('payments', 'partial_payments.payment_id', '=', 'payments.id')
        // // ->join('expirations', 'payments.expiration_id', '=', 'expirations.id')
        // // ->join('operators', 'expirations.operator_id', '=', 'operators.id')
        // // ->join('license_categories', 'operators.category_id', '=', 'license_categories.id')
        // // ->join('license_sub_categories', 'operators.sub_category_id', '=', 'license_sub_categories.id')
        // ->select('operators.name as operator_name', 'banks.id as bank_id', 'banks.name as bank_name', 'pay_order_number')
        // ->where(function ($query) {
        //     dd($query->from('banks'));
        //     return request()->operator ? $query->from('operators')->where('operator_name', request()->operator) : '';
        // })
        // ->where(function ($query) {
        //     return request()->bank ? $query->from('banks')->where('bank_id', request()->bank) : '';
        // })
        // ->where(function ($query) {
        //     return request()->pay_order_number ? $query->from('partial_payments')->where('pay_order_number', request()->pay_order_number) : '';
        // })
        // ->get();

        // dd(request()->operator);

        // dd($data_set);

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
