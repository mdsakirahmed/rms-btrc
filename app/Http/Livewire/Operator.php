<?php

namespace App\Http\Livewire;

use App\Models\Operator as ModelsOperator;
use Livewire\Component;

class Operator extends Component
{
    public $operators, $form, $selected_id;

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
            $model = ModelsOperator::find($this->selected_id);
        }else{
            $model = new ModelsOperator;
        }
        $model->name =  $this->name;
        $model->save();
        $this->name = $this->form = $this->selected_id = null;
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Done!']);
    }

    public function selectForEdit(ModelsOperator $licenseSubCategory){
        $this->name = $licenseSubCategory->name;
        $this->form = true;
        $this->selected_id = $licenseSubCategory->id;
    }

    public function selectForDelete(ModelsOperator $licenseSubCategory){
        $this->selected_id = $licenseSubCategory->id;
    }

    public function destroy(){
        ModelsOperator::find($this->selected_id)->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Deleted!']);
        $this->selected_id = null;
    }
    
    public function mount(){
        $this->operators = ModelsOperator::latest()->get();
    }

    public function render()
    {
        $this->operators = ModelsOperator::latest()->get();
        return view('livewire.operator')->layout('layouts.backend.app');
    }
}
