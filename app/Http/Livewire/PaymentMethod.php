<?php

namespace App\Http\Livewire;

use App\Models\PaymentMethod as ModelsPaymentMethod;
use Livewire\Component;

class PaymentMethod extends Component
{
    public $paymentMethods, $form, $selected_id;

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
            $model = ModelsPaymentMethod::find($this->selected_id);
        }else{
            $model = new ModelsPaymentMethod;
        }
        $model->name =  $this->name;
        $model->save();
        $this->name = $this->form = $this->selected_id = null;
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Done!']);
    }

    public function selectForEdit(ModelsPaymentMethod $paymentMethod){
        $this->name = $paymentMethod->name;
        $this->form = true;
        $this->selected_id = $paymentMethod->id;
    }

    public function selectForDelete(ModelsPaymentMethod $paymentMethod){
        $this->selected_id = $paymentMethod->id;
    }

    public function destroy(){
        ModelsPaymentMethod::find($this->selected_id)->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Deleted!']);
        $this->selected_id = null;
    }

    public function render()
    {
        $this->paymentMethods = ModelsPaymentMethod::latest()->get();
        return view('livewire.payment-method')->layout('layouts.backend.app');
    }
}
