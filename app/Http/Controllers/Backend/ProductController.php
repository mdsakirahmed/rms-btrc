<?php

namespace App\Http\Controllers\Backend;

use App\Exports\ProductExport;
use App\Http\Controllers\Controller;
use App\Imports\ProductImport;
use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function index(){
        $products = Product::latest()->get();
        return view('backend.product.index', compact('products'));
    }

    public function export(){
        return Excel::download(new ProductExport, 'products '.date('d-m-Y h-i-s a').'.xlsx');
    }

    public function import(Request $request){
        try{
            Excel::import(new ProductImport, request()->file('file'));
            toastr()->success('Successfully import');
        }catch(\Exception $e){
            toastr()->error('Something went wrong');
        }
        return back();
    }
}
