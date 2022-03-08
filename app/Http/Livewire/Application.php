<?php

namespace App\Http\Livewire;

use App\Models\Application as ModelsApplication;
use Livewire\Component;

class Application extends Component
{
    public $name, $application_fee, $processing_fee;
    public $application;

    public function create(){
        $this->name = $this->application_fee = $this->processing_fee = $this->application = null;
    }

    public function submit(){
        $validate_data = $this->validate([
            'name' => 'required',
            'application_fee' => 'required',
            'processing_fee' => 'required',
        ]);
        if($this->application){
            $this->application->update($validate_data);
        }else{
            ModelsApplication::create($validate_data);
        }
        $this->create();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Success !']);
    }

    public function select_for_edit(ModelsApplication $application){
        $this->name = $application->name;
        $this->application_fee = $application->application_fee;
        $this->processing_fee = $application->processing_fee;
        $this->application = $application;
    }

    public function change_approval(ModelsApplication $application){
        $application->approved = !$application->approved;
        $application->save();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Success !']);
    }

    public function delete(ModelsApplication $application){
        $application->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Success !']);
    }

    public function render()
    {
        return view('livewire.application', [
            'applications' => ModelsApplication::latest()->get()
        ])->layout('layouts.backend.app');
    }
}
