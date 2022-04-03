<?php

namespace App\Http\Livewire;

use App\Models\FeeType as ModelsFeeType;
use Livewire\Component;

class FeeType extends Component
{
    public $name;
    public $fee_type;

    public function create(){
        $this->name = $this->fee_type = null;
    }

    public function submit(){
        $validate_data = $this->validate([
            'name' => 'required'
        ]);
        if($this->fee_type){
            $this->fee_type->update($validate_data);
        }else{
            ModelsFeeType::create($validate_data);
        }
        $this->create();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Success !']);
    }

    public function select_for_edit(ModelsFeeType $fee_type){
        $this->name = $fee_type->name;
        $this->fee_type = $fee_type;
    }

    public function delete(ModelsFeeType $fee_type){
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
