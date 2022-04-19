<?php

namespace App\Http\Livewire\Report;

use App\Exports\OperatorDetailExport;
use App\Models\LicenseCategory;
use App\Models\LicenseSubCategory;
use App\Models\Operator;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class OperatorDetail extends Component
{
    public $selected_category, $selected_sub_category, $selected_operator, $search;

    public function mount(){
        $this->selected_category = 'all';
        $this->selected_sub_category = 'all';
        $this->selected_operator = 'all';
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
            if($this->selected_operator != 'all'){
                $query->where('id', $this->selected_operator);
            }
        })->where('name', 'like', '%' . $this->search . '%');
    }

    public function export_as_excel(){
        $collection = $this->get_operators()->get();
        return Excel::download(new OperatorDetailExport($collection), 'Operator detail '.date('d-m-Y h-i-s a').'.xlsx');
    }

    public function export_as_pdf()
    {
        return response()->streamDownload(function () {
            Pdf::loadView('pdf.operator-detail', [
                'file_name' => 'Operator detail',
                'collections' => $this->get_operators()->get()
            ], [], [
                'format' => 'A4-L'
            ])->download();
        }, 'Operator detail download at ' . date('d-m-Y- h-i-s') . '.pdf');
    }
}
