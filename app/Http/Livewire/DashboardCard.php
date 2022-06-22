<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DashboardCard extends Component
{
    public $title, $value, $color;
    public function render()
    {
        return view('livewire.dashboard-card',[
            'cards' => \App\Models\DashboardCard::all()
        ])->extends('layouts.backend.app', ['title' => 'Dashboard Card'])
            ->section('content');
    }

    public function select_for_edit(\App\Models\DashboardCard $card){
        $this->selected_card = $card;
        $this->title = $card->title;
        $this->value = $card->value;
        $this->color = $card->color;
    }

    public function submit(){
        $validated_data = $this->validate([
            'title' => 'required|string',
            'value' => 'required|numeric',
            'color' => 'required|string'
        ]);
        $this->selected_card->update($validated_data);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Success !']);
    }
}
