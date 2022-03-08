<?php

namespace App\Http\Livewire;

use App\Models\Application as ModelsApplication;
use Livewire\Component;

class Application extends Component
{
    public $name, $application_fee, $processing_fee;

    public function create(){
        $this->name = $this->application_fee = $this->processing_fee = null;
    }

    public function submit(){
        $validate_data = $this->validate([
            'name' => 'required',
            'application_fee' => 'required',
            'processing_fee' => 'required',
        ]);
        ModelsApplication::create($validate_data);
        $this->create();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Success !']);
    }

    public function render()
    {
        return view('livewire.application', [
            'applications' => ModelsApplication::latest()->get()
        ])->layout('layouts.backend.app');
    }
}
