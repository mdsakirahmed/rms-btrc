<?php

namespace App\Http\Livewire;

use App\Models\LicenseCategory;
use App\Models\LicenseSubCategory;
use App\Models\Operator as ModelsOperator;
use Livewire\Component;
use Illuminate\Pagination\Paginator;

class Operator extends Component
{
    public $category_id, $sub_category_id, $name, $phone, $email, $website, $address, $note, $contact_person_name, $contact_person_designation, $contact_person_phone, $contact_person_email;
    public $operator, $search_for_name;


    public function setPage($url)
    {
        $this->currentPage = explode('page=', $url)[1];
        Paginator::currentPageResolver(function () {
            return $this->currentPage;
        });
    }

    public function create()
    {
        $this->category_id =
        $this->sub_category_id =
        $this->name =
        $this->phone =
        $this->email =
        $this->website =
        $this->address =
        $this->note =
        $this->contact_person_name =
        $this->contact_person_designation =
        $this->contact_person_phone =
        $this->operator =
        $this->contact_person_email = null;
    }

    public function submit()
    {
        $validate_data = $this->validate([
            'category_id' => 'required|exists:license_categories,id',
            'sub_category_id' => 'nullable|exists:license_sub_categories,id',
            'name' => 'required|unique:operators,name,' . ($this->operator ? $this->operator->id : null),
            'phone' => 'nullable|string',
            'email' => 'nullable|string',
            'website' => 'nullable|string',
            'address' => 'nullable|string',
            'note' => 'nullable|string',
            'contact_person_name' => 'nullable|string',
            'contact_person_designation' => 'nullable|string',
            'contact_person_phone' => 'nullable|string',
            'contact_person_email' => 'nullable|string',
        ],[],[
            'category_id' => 'Category',
            'sub_category_id' => 'Sub category',
        ]);
        if ($this->operator) {
            $this->operator->update($validate_data);
        } else {
            ModelsOperator::create($validate_data);
        }
        $this->create();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Success !']);
    }

    public function select_for_edit(ModelsOperator $operator)
    {
        $this->operator = $operator;
        $this->category_id = $operator->category_id;
        $this->sub_category_id = $operator->sub_category_id;
        $this->name = $operator->name;
        $this->phone = $operator->phone;
        $this->email = $operator->email;
        $this->website = $operator->website;
        $this->address = $operator->address;
        $this->note = $operator->note;
        $this->contact_person_name = $operator->contact_person_name;
        $this->contact_person_designation = $operator->contact_person_designation;
        $this->contact_person_phone = $operator->contact_person_phone;
        $this->contact_person_email = $operator->contact_person_email;
    }

    public function select_for_delete(ModelsOperator $operator)
    {
        $this->selected_operator_for_delete = $operator;
    }

    public function delete()
    {
        if($this->selected_operator_for_delete){
            $this->selected_operator_for_delete->delete();
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Success !']);
        }else{
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'Not found !']);
        }
    }

    public function chose_category(LicenseCategory $category)
    {
        if ($this->category_id == $category->id) { // if double click on same element, assign null
            $this->category_id = null;
        } else {
            $this->category_id = $category->id;
        }
    }

    public function chose_sub_category(LicenseSubCategory $sub_category)
    {
        if ($this->sub_category_id == $sub_category->id) { // if double click on same element, assign null
            $this->sub_category_id = null;
        } else {
            $this->sub_category_id = $sub_category->id;
        }
    }

    public function render()
    {
        return view('livewire.operator', [
            'operators' => $this->get_operators()->paginate(20),
            'categories' => LicenseCategory::latest()->get(),
            'sub_categories' => LicenseSubCategory::where('category_id', $this->category_id)->latest()->get(),
        ])->extends('layouts.backend.app', ['title' => 'Operator'])
            ->section('content');
    }

    public function get_operators()
    {
        return  ModelsOperator::where('name', 'like', '%' . $this->search_for_name . '%')
            ->where(function($query) {
                if($this->category_id)
                $query->where('category_id', $this->category_id);
            })->where(function($query) {
                if($this->sub_category_id)
                $query->where('sub_category_id', $this->sub_category_id);
            })->latest();
    }
}
