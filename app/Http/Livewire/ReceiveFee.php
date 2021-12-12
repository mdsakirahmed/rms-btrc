<?php

namespace App\Http\Livewire;

use App\Models\ReceiveFee as ModelsReceiveFee;
use Livewire\Component;

class ReceiveFee extends Component
{
    public $receive_fees, $form, $selected_id;

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
            $model = ModelsReceiveFee::find($this->selected_id);
        }else{
            $model = new ModelsReceiveFee;
        }
        $model->name =  $this->name;
        $model->save();
        $this->name = $this->form = $this->selected_id = null;
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Done!']);
    }

    public function selectForEdit(ModelsReceiveFee $receive_fee){
        $this->name = $receive_fee->name;
        $this->form = true;
        $this->selected_id = $receive_fee->id;
    }

    public function selectForDelete(ModelsReceiveFee $receive_fee){
        $this->selected_id = $receive_fee->id;
    }

    public function destroy(){
        ModelsReceiveFee::find($this->selected_id)->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Deleted!']);
        $this->selected_id = null;
    }
    
    public function mount(){
        $this->receive_fees = ModelsReceiveFee::latest()->get();
    }

    public function render()
    {
        $this->receive_fees = ModelsReceiveFee::latest()->get();
        return view('livewire.receive-fee')->layout('layouts.backend.app');
    }
}
