<?php

namespace App\Http\Livewire;

use App\Models\PaymentReceive as ModelsPaymentReceive;
use Livewire\Component;

class PaymentReceive extends Component
{
    public $paymentReceives, $form, $selected_id;

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
            $model = ModelsPaymentReceive::find($this->selected_id);
        }else{
            $model = new ModelsPaymentReceive;
        }
        $model->name =  $this->name;
        $model->save();
        $this->name = $this->form = $this->selected_id = null;
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Done!']);
    }

    public function selectForEdit(ModelsPaymentReceive $paymentReceive){
        $this->name = $paymentReceive->name;
        $this->form = true;
        $this->selected_id = $paymentReceive->id;
    }

    public function selectForDelete(ModelsPaymentReceive $paymentReceive){
        $this->selected_id = $paymentReceive->id;
    }

    public function destroy(){
        ModelsPaymentReceive::find($this->selected_id)->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Deleted!']);
        $this->selected_id = null;
    }
    
    public function mount(){
        $this->paymentReceives = ModelsPaymentReceive::latest()->get();
    }

    public function render()
    {
        $this->paymentReceives = ModelsPaymentReceive::latest()->get();
        return view('livewire.payment-receive')->layout('layouts.backend.app');
    }
}
