<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Operator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function getSuggestionForFilter(){
        try{
            return DB::table(request()->table)->select(request()->table.'.'.request()->column.' as name')
            ->where(request()->column, 'like', '%' . request()->keyword . '%')
            ->get();
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
}
