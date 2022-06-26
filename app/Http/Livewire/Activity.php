<?php

namespace App\Http\Livewire;

use App\Exports\ActivityExport;
use Livewire\Component;
use Spatie\Activitylog\Models\Activity as ModelsActivity;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class Activity extends Component
{
    public function render()
    {
        return view('livewire.activity',[
            'activities' => ModelsActivity::where(function($query){
                if(request()->type == 'delete'){
                    $query->where('log_name', 'delete');
                    ModelsActivity::where('log_name', 'delete')->update(['read' => true]);
                }else if(request()->type == 'edit'){
                    $query->where('log_name', 'edit');
                    ModelsActivity::where('log_name', 'edit')->update(['read' => true]);
                }
            })->latest()->paginate(10)
        ])->extends('layouts.backend.app', ['title' => 'Activity'])
        ->section('content');
    }

    public function export_as_pdf(){
        return response()->streamDownload(function () {
            Pdf::loadView('pdf.activity-history', [
                'file_name' => 'Activity History',
                'collections' =>  ModelsActivity::all()
            ], [], [
                'format' => 'A4-L'
            ])->download();
        }, 'Activity history download at ' . date('d-m-Y- h-i-s') . '.pdf');
    }

    public function export_as_excel(){
        $collection = ModelsActivity::where(function($query){
            if(request()->type == 'delete'){
                $query->where('log_name', 'delete');
            }else if(request()->type == 'edit'){
                $query->where('log_name', 'edit');
            }
        })->latest()->get();
        return Excel::download(new ActivityExport($collection), 'Activity history ' . date('d-m-Y h-i-s a') . '.xlsx');
    }
}
