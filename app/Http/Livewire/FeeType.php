<?php

namespace App\Http\Livewire;

use App\Models\FeeType as ModelsFeeType;
use Livewire\Component;

class FeeType extends Component
{
    public $name, $period_format;
    public $fee_type;

    public function create()
    {
        $this->name = $this->period_format = $this->schedule_include_to_beginning_of_period = $this->schedule_day = $this->schedule_month = $this->schedule_substract_day = $this->fee_type = $this->period_start_with_issue_date = $this->period_month = null;
    }

    public function submit()
    {
        $validate_data = $this->validate([
            'name' => 'required',
            'period_format' => 'required',
            'schedule_day' => 'required|numeric|min:0|max:30',
            'schedule_month' => 'required|numeric|min:0|max:12',
            'schedule_substract_day' => 'required|numeric|min:0|max:30',
            'period_start_with_issue_date' => 'required|boolean',
            'period_month' => 'required|numeric|min:1|max:12',
            'schedule_include_to_beginning_of_period' => 'required|boolean'
        ]);
        if ($this->fee_type) {
             $this->fee_type->update($validate_data);
             $this->fee_type;
        } else {
            ModelsFeeType::create($validate_data);
        }
        $this->create();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Success !']);
    }

    public function select_for_edit(ModelsFeeType $fee_type)
    {
        $this->name = $fee_type->name;
        $this->period_format = $fee_type->period_format;
        $this->schedule_day = $fee_type->schedule_day;
        $this->schedule_month = $fee_type->schedule_month;
        $this->schedule_substract_day = $fee_type->schedule_substract_day;
        $this->period_start_with_issue_date = $fee_type->period_start_with_issue_date;
        $this->period_month = $fee_type->period_month;
        $this->schedule_include_to_beginning_of_period = $fee_type->schedule_include_to_beginning_of_period;
        $this->fee_type = $fee_type;
    }

    public function delete(ModelsFeeType $fee_type)
    {
        $fee_type->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Success !']);
    }

    public function render()
    {
        return view('livewire.fee-type', [
            'fee_types' => ModelsFeeType::all()
        ])->extends('layouts.backend.app', ['title' => 'Fee type'])
            ->section('content');
    }
}
