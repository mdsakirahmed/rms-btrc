<?php

namespace App\Http\Livewire;

use App\Models\ReceivePeriod as ModelsReceivePeriod;
use Livewire\Component;

class ReceivePeriod extends Component
{
    public $receive_periods, $form, $selected_id;

    public function showForm()
    {
        $this->form = true;
        $this->name = $this->file = $this->selected_id = null;
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required|string',
        ]);
        if($this->selected_id){
            $model = ModelsReceivePeriod::find($this->selected_id);
        }else{
            $model = new ModelsReceivePeriod;
        }
        $model->name =  $this->name;
        $model->save();
        $this->name = $this->form = $this->selected_id = null;
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Done!']);
    }

    public function selectForEdit(ModelsReceivePeriod $receive_period){
        $this->name = $receive_period->name;
        $this->form = true;
        $this->selected_id = $receive_period->id;
    }

    public function selectForDelete(ModelsReceivePeriod $receive_period){
        $this->selected_id = $receive_period->id;
    }

    public function destroy(){
        ModelsReceivePeriod::find($this->selected_id)->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Deleted!']);
        $this->selected_id = null;
    }
    
    public function mount(){
        $this->receive_periods = ModelsReceivePeriod::latest()->get();
    }

    public function render()
    {
        $this->receive_periods = ModelsReceivePeriod::latest()->get();
        return view('livewire.receive-period')->layout('layouts.backend.app');
    }
}
