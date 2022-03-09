<?php

namespace App\Http\Livewire;

use App\Models\Bank as ModelsBank;
use Livewire\Component;

class Bank extends Component
{
    public $name;
    public $bank;

    public function create(){
        $this->name = $this->bank = null;
    }

    public function submit(){
        $validate_data = $this->validate([
            'name' => 'required'
        ]);
        if($this->bank){
            $this->bank->update($validate_data);
        }else{
            ModelsBank::create($validate_data);
        }
        $this->create();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Success !']);
    }

    public function select_for_edit(ModelsBank $bank){
        $this->name = $bank->name;
        $this->bank = $bank;
    }

    public function delete(ModelsBank $bank){
        $bank->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Success !']);
    }

    public function render()
    {
        return view('livewire.bank', [
            'banks' => ModelsBank::latest()->get()
        ])->layout('layouts.backend.app');
    }
}
