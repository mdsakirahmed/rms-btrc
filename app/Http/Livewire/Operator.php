<?php

namespace App\Http\Livewire;

use App\Models\LicenseCategory;
use App\Models\LicenseSubCategory;
use App\Models\Operator as ModelsOperator;
use Livewire\Component;

class Operator extends Component
{
    public $name, $category_id, $sub_category_id;
    public $operator;

    public function create(){
        $this->name = $this->category_id = $this->sub_category_id = $this->operator = null;
    }

    public function submit(){
        $validate_data = $this->validate([
            'name' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
        ]);
        if($this->operator){
            $this->operator->update($validate_data);
        }else{
            ModelsOperator::create($validate_data);
        }
        $this->create();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Success !']);
    }

    public function select_for_edit(ModelsOperator $operator){
        $this->name = $operator->name;
        $this->category_id = $operator->category_id;
        $this->sub_category_id = $operator->sub_category_id;
        $this->operator = $operator;
    }

    public function delete(ModelsOperator $operator){
        $operator->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Success !']);
    }


    public function render()
    {
        return view('livewire.operator', [
            'operators' => ModelsOperator::latest()->get(),
            'categories' => LicenseCategory::latest()->get(),
            'sub_categories' => LicenseSubCategory::latest()->get()
        ])->layout('layouts.backend.app');
    }
}
