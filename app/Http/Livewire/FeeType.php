<?php

namespace App\Http\Livewire;

use App\Models\FeeType as ModelsFeeType;
use App\Models\FeeTypeWisePeriod;
use Livewire\Component;

class FeeType extends Component
{
    public $name, $period_format, $periods = [];
    public $fee_type;

    public function create()
    {
        $this->periods = [];
        $this->name = $this->period_format = $this->schedule_day = $this->schedule_month = $this->fee_type = null;
    }

    public function submit()
    {
        $validate_data = $this->validate([
            'name' => 'required',
            'period_format' => 'required',
            'schedule_day' => 'required|numeric|min:0|max:30',
            'schedule_month' => 'required|numeric|min:0|max:12',
        ]);
        if ($this->fee_type) {
             $this->fee_type->update($validate_data);
             $this->fee_type->periods()->delete();
             $model = $this->fee_type;
        } else {
            $model = ModelsFeeType::create($validate_data);
        }
        foreach ($this->periods as $period) {
            FeeTypeWisePeriod::create([
                'fee_type_id' => $model->id,
                'starting_month' => $period['start_month'],
                'ending_month' => $period['end_month'],
            ]);
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
        $this->fee_type = $fee_type;
        $this->periods = [];
        foreach($fee_type->periods as $period){
            array_push($this->periods,[
                'start_month' => $period->starting_month,
                'end_month' => $period->ending_month,
            ]);
        }
    }

    public function delete(ModelsFeeType $fee_type)
    {
        $fee_type->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Success !']);
    }

    public function add_or_remove_period($action_type = null)
    {
        if ($action_type == 'add') {
            array_push($this->periods, null);
        } else {
            unset($this->periods[array_search(null, $this->periods)]);
        }
        $this->periods = array_values($this->periods);
    }

    public function render()
    {
        return view('livewire.fee-type', [
            'fee_types' => ModelsFeeType::all()
        ])->extends('layouts.backend.app', ['title' => 'Fee type'])
            ->section('content');
    }
}
