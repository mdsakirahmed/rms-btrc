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
    public $category_search_key, $sub_category_search_key;
    public $operator;
    public $search_for_name, $search_for_category, $search_for_sub_category;


    public function setPage($url)
    {
        $this->currentPage = explode('page=', $url)[1];
        Paginator::currentPageResolver(function () {
            return $this->currentPage;
        });
    }

    public function create()
    {
        $this->category_id = $this->sub_category_id = $this->name = $this->phone = $this->email = $this->website = $this->address = $this->note = $this->contact_person_name = $this->contact_person_designation = $this->contact_person_phone = $this->contact_person_email = null;
    }

    public function submit()
    {
        $validate_data = $this->validate([
            'category_id' => 'required|exists:license_categories,id',
            'sub_category_id' => 'nullable|numeric',
            'name' => 'required|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|string',
            'website' => 'nullable|string',
            'address' => 'nullable|string',
            'note' => 'nullable|string',
            'contact_person_name' => 'required|string',
            'contact_person_designation' => 'nullable|string',
            'contact_person_phone' => 'nullable|string',
            'contact_person_email' => 'nullable|string',
        ]);
        if ($this->operator) {
            $this->validate([
                'name' => 'required|unique:operators,name,' . $this->operator->id,
            ]);
            $this->operator->update($validate_data);
        } else {
            $this->validate([
                'name' => 'required|unique:operators,name'
            ]);
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

    public function delete(ModelsOperator $operator)
    {
        $operator->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Success !']);
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
            'categories' => LicenseCategory::where('name', 'like', '%' . $this->category_search_key . '%')->latest()->get(),
            'sub_categories' => LicenseSubCategory::where('name', 'like', '%' . $this->sub_category_search_key . '%')->latest()->get(),
        ])->extends('layouts.backend.app', ['title' => 'Operator'])
            ->section('content');
    }

    public function get_operators()
    {
        return  ModelsOperator::where('name', 'like', '%' . $this->search_for_name . '%')
            ->with(['category', 'sub_category'])
            ->whereHas('category', function ($category) {
                $category->where('name', 'like', '%' . $this->search_for_category . '%');
            })
            ->whereHas('sub_category', function ($sub_category) {
                $sub_category->where('name', 'like', '%' . $this->search_for_sub_category . '%');
            })
            ->latest();
    }
}
