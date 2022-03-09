<?php

namespace App\Http\Livewire;

use App\Models\Expiration as ModelsExpiration;
use App\Models\Operator;
use Livewire\Component;

class Expiration extends Component
{
    public $operator_id, $starting_date, $ending_date, $total_price, $total_iteration;
    public $operator, $expiration;

    public function create(){
        $this->starting_date = $this->ending_date = $this->total_price = $this->total_iteration = null;
    }

    public function submit(){
        $validate_data = $this->validate([
            'operator_id' => 'required|exists:operators,id',
            'starting_date' => 'required|date',
            'ending_date' => 'required|date',
            'total_price' => 'required|numeric',
            'total_iteration' => 'required|numeric',
        ]);
        if($this->expiration){
            $this->expiration->update($validate_data);
        }else{
            ModelsExpiration::create($validate_data);
        }
        $this->create();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Success !']);
    }

    public function select_for_edit(ModelsExpiration $expiration){
        $this->starting_date = $expiration->starting_date;
        $this->ending_date = $expiration->ending_date;
        $this->total_price = $expiration->total_price;
        $this->total_iteration = $expiration->total_iteration;
        $this->expiration = $expiration;
    }

    public function delete(ModelsExpiration $expiration){
        $expiration->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Success !']);
    }

    public function mount(){
        $this->operator = Operator::find(request()->operator);
        if($this->operator){
            $this->operator_id = $this->operator->id;
        }
    }

    public function render()
    {
        if($this->operator){
            $expirations = ModelsExpiration::latest()->where('operator_id', $this->operator->id)->get();
        }else{
            $expirations = ModelsExpiration::latest()->get();
        }
        // dd($expirations);
        return view('livewire.expiration', [
            'expirations' => $expirations
        ])->layout('layouts.backend.app');
    }
}
