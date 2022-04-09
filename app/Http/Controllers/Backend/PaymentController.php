<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Expiration;
use App\Models\LicenseCategory;
use App\Models\LicenseCategoryWiseFeeType;
use App\Models\LicenseSubCategory;
use App\Models\Operator;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(){
        $operators = $fee_types = $periods = $fee_type_wise_periods = [];

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
        // dd($fee_type_wise_periods);
        // if(request()->category && request()->fee_type){
        //     $expiration = Expiration::find(request()->category);
        //     $category_wise_fee_type = LicenseCategoryWiseFeeType::find(request()->fee_type);
        //     if($expiration && $category_wise_fee_type){
        //         for($issue_date = $expiration->issue_date; $issue_date < $expiration->expire_date; $issue_date->modify('+'.$category_wise_fee_type->period_month.' month')){
        //             array_push($periods, $issue_date->format('d-m-Y'));
        //         }
        //     }
        // }
        // dd($fee_types);
        return view('backend.payment', [
            'categories' => LicenseCategory::all(),
            'sub_categories' => LicenseSubCategory::all(),
            'operators' =>$operators,
            'fee_types' =>$fee_types,
            'periods' =>$periods,
            'fee_type_wise_periods' =>$fee_type_wise_periods,
        ]);
    }
}
