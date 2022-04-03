<?php

namespace App\Http\Livewire;

use App\Models\LicenseCategory;
use App\Models\LicenseSubCategory;
use App\Models\Operator as ModelsOperator;
use Livewire\Component;

class Operator extends Component
{
    public $name, $category_id, $sub_category_id, $category_search_key, $sub_category_search_key;
    public $operator;

    public function create(){
        $this->name = $this->category_id = $this->sub_category_id = $this->operator = null;
    }

    public function submit(){
        if($this->operator){
            $validate_data = $this->validate([
                'name' => 'required|unique:operators,name,'.$this->operator->id,
                'category_id' => 'required',
                'sub_category_id' => 'nullable',
            ]);
            $this->operator->update($validate_data);
        }else{
            $validate_data = $this->validate([
                'name' => 'required|unique:operators,name',
                'category_id' => 'required',
                'sub_category_id' => 'nullable',
            ]);
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

    public function chose_category(LicenseCategory $category){
        if($this->category_id == $category->id){ // if double click on same element, assign null
            $this->category_id = null;
        }else{
            $this->category_id = $category->id;
        }
    }

    public function chose_sub_category(LicenseSubCategory $sub_category){
        if($this->sub_category_id == $sub_category->id){ // if double click on same element, assign null
            $this->sub_category_id = null;
        }else{
            $this->sub_category_id = $sub_category->id;
        }
    }

    public function render()
    {
        return view('livewire.operator', [
            'operators' => ModelsOperator::latest()->paginate(20),
            'categories' => LicenseCategory::where('name', 'like', '%'.$this->category_search_key.'%')->latest()->get(),
            'sub_categories' => LicenseSubCategory::where('name', 'like', '%'.$this->sub_category_search_key.'%')->latest()->get(),
        ])->extends('layouts.backend.app', ['title' => 'Operator'])
        ->section('content');
    }
}
