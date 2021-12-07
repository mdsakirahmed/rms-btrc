<?php

namespace App\Http\Livewire;

use App\Models\Document as ModelsDocument;
use Livewire\Component;

class Document extends Component
{
    public $documents, $form;

    public function showForm()
    {
        $this->form = true;
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:documents,email,'.$this->selected_document_id,
            'password' => 'required|string|min:4',
            'role' => 'required',
        ]);
        $document = ModelsDocument::updateOrCreate([
            'id' => $this->selected_document_id
        ], [
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);
        $document->syncRoles($this->role);
        $this->name = $this->email = $this->password = $this->role = $this->form = $this->selected_document_id = null;
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'document Successfully Done!']);
    }

    public function selectForEdit(ModelsDocument $document){
        $this->name = $document->name;
        $this->email = $document->email;
        $this->role = $document->roles()->first()->id ?? null;
        $this->form = true;
        $this->selected_document_id = $document->id;
    }

    public function selectForDelete(ModelsDocument $document){
        $this->selected_document_id = $document->id;
    }

    public function destroy(){
        ModelsDocument::find($this->selected_document_id)->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Deleted!']);
        $this->selected_document_id = null;
    }
    
    public function mount(){
        $this->documents = ModelsDocument::latest()->get();
    }

    public function render()
    {
        return view('livewire.document')->layout('layouts.backend.app');
    }
}
