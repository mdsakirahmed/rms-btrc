<?php

namespace App\Http\Livewire\Report;

use App\Exports\Statement as ExportsStatement;
use App\Models\Period;
use App\Models\FeeType;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class Statement extends Component
{
    public $selected_fee_type, $selected_period;

    public function render()
    {
        return view('livewire.report.statement', [
            'fee_types' => FeeType::all(),
            'period_groups' => DB::table('periods')->where('fee_type_id', $this->selected_fee_type)->get()->groupBy('period_start_date'),
            'periods' => Period::where('fee_type_id', $this->selected_fee_type)->get()->mapToGroups(function ($item, $key) {
                return [$item->period_label];
            })->toArray()[0] ?? [],
            'exp_wise_payment_dates' => Period::where('period_label', $this->selected_period)->get()

        ])->extends('layouts.backend.app', ['title' => 'Revenue Sharing Statement'])
            ->section('content');
    }

    public function export_as_excel(){
        $file_name = FeeType::where('id', $this->selected_fee_type)->first()->name ?? 'No Fee Type';
        $collection = Period::where('period_label', $this->selected_period)->get();
        return Excel::download(new ExportsStatement($collection, $this->selected_fee_type), $file_name.' '.date('d-m-Y h-i-s a').'.xlsx');
    }

    public function export_as_pdf()
    {
        $file_name = FeeType::where('id', $this->selected_fee_type)->first()->name ?? 'No Fee Type';
        return response()->streamDownload(function () use($file_name) {
            Pdf::loadView('pdf.statement', [
                'file_name' => 'Statement: '.$file_name,
                'selected_fee_type' => $this->selected_fee_type,
                'collections' => Period::where('period_label', $this->selected_period)->get()
            ], [], [
                'format' => 'A4-L'
            ])->download();
        }, $file_name.' download at ' . date('d-m-Y- h-i-s') . '.pdf');
    }
}
