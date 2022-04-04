<?php

namespace App\Http\Livewire;

use App\Models\LicenseCategory;
use App\Models\LicenseSubCategory;
use App\Models\Operator as ModelsOperator;
use Livewire\Component;

class Operator extends Component
{
    public $category_id, $sub_category_id, $name, $phone, $email, $website, $address, $note, $contact_person_name, $contact_person_designation, $contact_person_phone, $contact_person_email;
    public $category_search_key, $sub_category_search_key;
    public $operator;

    public function create(){
        $this->name = $this->category_id = $this->sub_category_id = $this->operator = null;
    }

    public function submit(){
        $validate_data = $this->validate([
            'category_id' => 'required|exists:license_categories,id',
            'sub_category_id' => 'nullable|numeric',
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string',
            'website' => 'nullable|string',
            'address' => 'nullable|string',
            'note' => 'nullable|string',
            'contact_person_name' => 'required|string',
            'contact_person_designation' => 'nullable|string',
            'contact_person_phone' => 'required|string',
            'contact_person_email' => 'nullable|string',
        ]);
        if($this->operator){
            $this->validate([
                'name' => 'required|unique:operators,name,'.$this->operator->id,
            ]);
            $this->operator->update($validate_data);
        }else{
            $this->validate([
                'name' => 'required|unique:operators,name'
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
