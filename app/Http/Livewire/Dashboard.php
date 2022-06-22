<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard',[
            'cards' => \App\Models\DashboardCard::all()
        ])->extends('layouts.backend.app', ['title' => 'Dashboard'])
        ->section('content');
    }
}
