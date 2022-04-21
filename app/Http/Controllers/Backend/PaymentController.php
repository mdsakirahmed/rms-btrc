<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Expiration;
use App\Models\ExpirationWisePaymentDate;
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
        $operators = $sub_categories = $fee_types = $fee_type_wise_periods = $fee_type_wise_pre_set_money = [];

        if(request()->category){
            // $operators = Operator::where('category_id', request()->category)->get();
            $sub_categories = LicenseSubCategory::all();
            $operators = Operator::where('category_id', request()->category)
            ->whereHas('expirations', function($query){
                $query->where('expire_date', '>=', Carbon::today());
            })->where('sub_category_id', request()->sub_category ?? null)->get();
        }

        if(request()->category && request()->operator){
            $category_wise_fee_types = LicenseCategoryWiseFeeType::where('category_id', request()->category)->with('fee_type')->get();
            $expiration = Expiration::where('all_payment_completed', false)
            ->where('operator_id', request()->operator)
            ->first();
            if($expiration)
            foreach($category_wise_fee_types as $category_wise_fee_type){
                array_push($fee_type_wise_pre_set_money,[
                    'fee_type' => $category_wise_fee_type->fee_type_id,
                    'amount' => $category_wise_fee_type->amount,
                    'late_fee' => $category_wise_fee_type->late_fee,
                    'vat' => $category_wise_fee_type->vat,
                    'tax' => $category_wise_fee_type->tax,
                ]);

                for($issue_date = $expiration->issue_date; $issue_date < $expiration->expire_date; $issue_date->modify('+'.$category_wise_fee_type->period_month.' months')){
                    array_push($fee_type_wise_periods,[
                        'fee_type' => $category_wise_fee_type->fee_type_id,
                        'period' => $issue_date->format('d-m-Y'),
                    ]);
                }
            }
        }
        return view('backend.payment', [
            'banks' => Bank::all(),
            'categories' => LicenseCategory::all(),
            'sub_categories' => $sub_categories,
            'operators' =>$operators,
            'fee_types' =>$category_wise_fee_types ?? [],
            'fee_type_wise_periods' =>$fee_type_wise_periods,
            'fee_type_wise_pre_set_money' =>$fee_type_wise_pre_set_money,
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
                'transaction' => $request->payment[0]['transaction'],
            ]);
            $expiration = Expiration::where('all_payment_completed', false)
                ->where('operator_id', $request->payment[0]['operator'])
                ->first();
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
                
                //Update expiration wise payment date status
                ExpirationWisePaymentDate::where('expiration_id', $expiration->id)
                ->where('fee_type_id', $receive['fee_type'])
                ->where('period_date', date('Y-m-d', strtotime($receive['period'])))
                ->update(['paid' => true]);
                
                // If all period of payment is done than this expiration will be done
                if(ExpirationWisePaymentDate::where('expiration_id', $expiration->id)->where('paid', false)->count() == 0){
                    $expiration->update(['all_payment_completed' => true]);
                }
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
        if(!$request->payment[0]['operator'] || !$request->payment[0]['transaction']){
            return [
                'error' => true,
                'area' => 'payment',
                'message' => 'Transaction and operator field is required'
            ];
        }

        // receive
        foreach($request->receives as $receive){
            if(!$receive['fee_type'] || !$receive['period'] || !$receive['receive_date'] || !$receive['receive_amount'] || !$receive['late_fee'] || !$receive['vat'] || !$receive['tax']){
                return [
                    'error' => true,
                    'area' => 'receive',
                    'message' => 'All fee type, period, receive date, receive amount, late fee, vat, tax field is required'
                ];
            }
        }

        // pay_order
        foreach($request->pay_orders as $pay_order){
            if(!$pay_order['po_amount'] || !$pay_order['po_number'] || !$pay_order['po_date'] || !$pay_order['po_bank']){
                return [
                    'error' => true,
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
