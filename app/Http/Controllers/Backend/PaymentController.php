<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Expiration;
use App\Models\LicenseCategory;
use App\Models\LicenseCategoryWiseFeeType;
use App\Models\LicenseSubCategory;
use App\Models\Operator;
use App\Models\Payment;
use App\Models\PaymentWiseDeposit;
use App\Models\PaymentWisePayOrder;
use App\Models\PaymentWiseReceive;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(){
        $operators = $fee_types = $fee_type_wise_periods = [];

        if(request()->category){
            // $operators = Operator::where('category_id', request()->category)->get();
            $operators = Operator::where('category_id', request()->category)
            ->whereHas('expirations', function($query){
                $query->where('expire_date', '>=', Carbon::today());
            })->get();
        }

        if(request()->category){
            $fee_types = LicenseCategoryWiseFeeType::where('category_id', request()->category)->with('fee_type')->get();
            $expiration = Expiration::find(request()->category);
            if($expiration)
            foreach($fee_types as $fee_type){
                $category_wise_fee_type = LicenseCategoryWiseFeeType::find($fee_type->fee_type_id);
                for($issue_date = $expiration->issue_date; $issue_date < $expiration->expire_date; $issue_date->modify('+'.$category_wise_fee_type->period_month.' month')){
                    array_push($fee_type_wise_periods,[
                        'fee_type' => $fee_type->fee_type_id,
                        'periods' => $issue_date->format('d-m-Y')
                    ]);
                }
            }
        }
        return view('backend.payment', [
            'banks' => Bank::all(),
            'categories' => LicenseCategory::all(),
            'sub_categories' => LicenseSubCategory::all(),
            'operators' =>$operators,
            'fee_types' =>$fee_types,
            'fee_type_wise_periods' =>$fee_type_wise_periods,
        ]);
    }

    public function store(Request $request){
        try{
            // Check validation
            $validation_response = $this->check_validation($request);

            // Validation error response
            if($validation_response['error']){
                return  $validation_response;
            }
           
            // Payment
            $payment = Payment::create([
                'operator_id' => $request->payment[0]['operator'],
                'name' => $request->payment[0]['name'],
            ]);
            
            // Receive
            foreach($request->receives as $receive){
                PaymentWiseReceive::create([
                    'payment_id' => $payment->id,
                    'fee_type_id' => $receive['fee_type'],
                    'period_date' => date('Y-m-d', strtotime($receive['period'])),
                    'receive_date' => $receive['receive_date'],
                    'receive_amount' => $receive['receive_amount'],
                    'late_fee_percentage' => $receive['late_fee'],
                    'vat_percentage' => $receive['vat'],
                    'tax_percentage' => $receive['tax'],
                ]);
            }

            // pay_order
            foreach($request->pay_orders as $pay_order){
                PaymentWisePayOrder::create([
                    'payment_id' => $payment->id,
                    'amount' => $pay_order['po_amount'],
                    'number' => $pay_order['po_number'],
                    'date' => $pay_order['po_date'],
                    'bank_id' => $pay_order['po_bank'],
                ]);
            }
            
            foreach($request->deposits as $deposit){
                PaymentWiseDeposit::create([
                    'payment_id' => $payment->id,
                    'bank_id' => $deposit['deposit_bank'],
                    'journal_number' => $deposit['journal_number'],
                    'date' => $deposit['daposit_date'],
                ]);
            }
            return [
                'error' => false,
            ];
        }catch(\Exception $expiration){
            return [
                'message' => $expiration->getMessage()
            ];
        }
       
    }

    // Helper function for payment store
    public function check_validation(Request $request){
        // Payment
        if(!$request->payment[0]['operator'] || !$request->payment[0]['name']){
            return [
                'error' => true,
                'area' => 'payment',
                'message' => 'Name and operator field is required'
            ];
        }

        // receive
        foreach($request->receives as $receive){
            if(!$receive['fee_type'] || !$receive['period'] || !$receive['receive_date'] || !$receive['receive_amount'] || !$receive['late_fee'] || !$receive['vat'] || !$receive['tax']){
                return [
                    'error' => true,
                    'area' => 'receive',
                    'message' => 'All fee_type, period, receive date, receive amount, late fee, vat, tax field is required'
                ];
            }
        }

        // pay_order
        foreach($request->pay_orders as $pay_order){
            if(!$pay_order['po_amount'] || !$pay_order['po_number'] || !$pay_order['po_date'] || !$pay_order['po_bank']){
                return [
                    'type' => 'error',
                    'area' => 'pay_order',
                    'message' => 'All po amount, po number, po date, po bank field is required'
                ];
            }
        }
        
        // deposit
        foreach($request->deposits as $deposit){
            if(!$deposit['journal_number'] || !$deposit['daposit_date'] || !$deposit['deposit_bank']){
                return [
                    'error' => true,
                    'area' => 'deposit',
                    'message' => 'All journal number, daposit date, deposit bank field is required'
                ];
            }
        }

        return [
            'error' => false
        ];
    }
}
