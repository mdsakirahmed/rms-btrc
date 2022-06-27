<?php

namespace App\Http\Livewire;

use App\Exports\ActivityExport;
use Livewire\Component;
use Spatie\Activitylog\Models\Activity as ModelsActivity;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class Activity extends Component
{
    public function mount(){
        $this->type = request()->type;
    }

    public function render()
    {
        return view('livewire.activity',[
            'activities' => ModelsActivity::where(function($query){
                if($this->type == 'delete'){
                    $query->where('log_name', 'delete')->where('read', false);
                }else if($this->type == 'edit'){
                    $query->where('log_name', 'edit')->where('read', false);
                }
            })->latest()->paginate(10)
        ])->extends('layouts.backend.app', ['title' => 'Activity'])
        ->section('content');
    }

    public function export_as_pdf(){
        return response()->streamDownload(function () {
            Pdf::loadView('pdf.activity-history', [
                'file_name' => 'Activity History',
                'collections' =>  ModelsActivity::where(function($query){
                    if($this->type == 'delete'){
                        $query->where('log_name', 'delete')->where('read', false);
                    }else if($this->type == 'edit'){
                        $query->where('log_name', 'edit')->where('read', false);
                    }
                })->latest()->get()
            ], [], [
                'format' => 'A4-L'
            ])->download();
        }, 'Activity history download at ' . date('d-m-Y- h-i-s') . '.pdf');
    }

    public function export_as_excel(){
        $collection = ModelsActivity::where(function($query){
            if($this->type == 'delete'){
                $query->where('log_name', 'delete')->where('read', false);
            }else if($this->type == 'edit'){
                $query->where('log_name', 'edit')->where('read', false);
            }
        })->latest()->get();
        return Excel::download(new ActivityExport($collection), 'Activity history ' . date('d-m-Y h-i-s a') . '.xlsx');
    }

    public function all_make_as_read(){
        ModelsActivity::where(function($query){
            if($this->type == 'delete'){
                $query->where('log_name', 'delete');
            }else if($this->type == 'edit'){
                $query->where('log_name', 'edit');
            }
        })->update(['read' => true]);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Success !']);
    }
}
