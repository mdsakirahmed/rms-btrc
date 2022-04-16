<?php

namespace App\Http\Livewire\Report;

use App\Models\LicenseCategory;
use App\Models\LicenseSubCategory;
use App\Models\Operator;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class OperatorDetail extends Component
{
    public $selected_category, $selected_sub_category, $selected_operator, $search;

    public function mount(){
        $this->selected_category = 'all';
        $this->selected_sub_category = 'all';
    }

    public function render()
    {
        // dd($this->get_operators()->get());
        return view('livewire.report.operator-detail',[
            'categories' => LicenseCategory::all(),
            'sub_categories' => LicenseSubCategory::all(),
            'operators' => $this->get_operators()->paginate(100)
        ])->extends('layouts.backend.app', ['title' => 'Operator Detail'])
        ->section('content');
    }

    public function get_operators(){
        return Operator::where(function($query){
            if($this->selected_category != 'all'){
                $query->where('category_id', $this->selected_category);
            }
            if($this->selected_sub_category != 'all'){
                $query->where('sub_category_id', $this->selected_sub_category);
            }
        })->where('name', 'like', '%' . $this->search . '%');
    }

    public function export(){
        $collection = $this->get_operators()->get();
        return Excel::download(new Operator($collection), 'Operator details '.date('d-m-Y h-i-s a').'.xlsx');
    }
}
