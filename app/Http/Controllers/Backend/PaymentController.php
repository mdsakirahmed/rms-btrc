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
            $validation_response = $this->check_validation($request);
            if($validation_response['type'] == 'error'){
                return  $validation_response['message'];
            }
            $payment = Payment::create([
                'operator_id' => $request->payment[0]['operator'],
                'name' => $request->payment[0]['name'],
            ]);
            
            return 'Successfully done';
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
                'type' => 'error',
                'message' => 'Name and operator field is required'
            ];
        }

        // revinue
        foreach($request->revinues as $revinue){
            if(!$revinue['fee_type'] || !$revinue['period'] || !$revinue['reeive_date'] || !$revinue['reeive_amount'] || !$revinue['late_fee'] || !$revinue['vat'] || !$revinue['tax']){
                return [
                    'type' => 'error',
                    'message' => 'All fee_type, period, reeive_date, reeive_amount, late_fee, vat, tax field is required'
                ];
            }
        }

        // pay_order
        foreach($request->pay_orders as $pay_order){
            if(!$pay_order['po_amount'] || !$pay_order['po_number'] || !$pay_order['po_date'] || !$pay_order['po_bank']){
                return [
                    'type' => 'error',
                    'message' => 'All po_amount, po_number, po_date, po_bank field is required'
                ];
            }
        }
        
        // deposit
        foreach($request->deposits as $deposit){
            if(!$deposit['journal_number'] || !$deposit['daposit_date'] || !$deposit['deposit_bank']){
                return [
                    'type' => 'error',
                    'message' => 'All journal_number, daposit_date, deposit_bank field is required'
                ];
            }
        }
    }
}
