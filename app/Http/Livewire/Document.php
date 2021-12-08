<?php

namespace App\Http\Livewire;

use App\Models\Document as ModelsDocument;
use Livewire\Component;
use Livewire\WithFileUploads;

class Document extends Component
{
    use WithFileUploads;
    
    public $documents, $form, $selected_document_id, $name, $file;

    public function showForm()
    {
        $this->form = true;
        $this->name = $this->file = $this->selected_user_id = null;
    }

    public function submit()
    {
        if($this->selected_document_id){
            $this->validate([
                'name' => 'required|string',
                'file' => 'nullable|file',
            ]);
            $document_model = ModelsDocument::find($this->selected_document_id);
        }else{
            $this->validate([
                'name' => 'required|string',
                'file' => 'required|file',
            ]);
            $document_model = new ModelsDocument;
        }
        $document_model->name =  $this->name;
        if($this->file){
            $document_model->file = 'storage/'.$this->file->store('documents', 'public');
        }
        $document_model->save();
        $this->name = $this->file = $this->form = $this->selected_document_id = null;
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Document Successfully Done!']);
    }

    public function selectForEdit(ModelsDocument $document){
        $this->name = $document->name;
        // $this->file = $document->file;
        $this->file = null;
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
        $this->documents = ModelsDocument::latest()->get();
        return view('livewire.document')->layout('layouts.backend.app');
    }
}
