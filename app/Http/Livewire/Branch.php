<?php

namespace App\Http\Livewire;

use App\Models\Bank;
use App\Models\Branch as ModelsBranch;
use Livewire\Component;

class Branch extends Component
{
    public $name, $routing_number, $bank_id;
    public $branch;

    public function create(){
        $this->name = $this->routing_number = $this->bank_id = $this->branch = null;
    }

    public function submit(){
        $validate_data = $this->validate([
            'name' => 'required',
            'routing_number' => 'required',
            'bank_id' => 'required|exists:banks,id',
        ]);
        if($this->branch){
            $this->branch->update($validate_data);
        }else{
            ModelsBranch::create($validate_data);
        }
        $this->create();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Success !']);
    }

    public function select_for_edit(ModelsBranch $branch){
        $this->name = $branch->name;
        $this->routing_number = $branch->routing_number;
        $this->bank_id = $branch->bank_id;
        $this->branch = $branch;
    }

    public function delete(ModelsBranch $branch){
        $branch->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Success !']);
    }

    public function render()
    {
        return view('livewire.branch', [
            'banks' => Bank::latest()->get(),
            'branches' => ModelsBranch::latest()->get(),
        ])->layout('layouts.backend.app');
    }
}
