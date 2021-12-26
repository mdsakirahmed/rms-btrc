<?php

namespace App\Http\Livewire;

use App\Models\License;
use Livewire\Component;
use PDF;

class MyLicense extends Component
{
    public $licenses, $payment;
    public function downloadInvoice(License $license)
    {
        $this->license = $license;
        return response()->streamDownload(function () {
            PDF::loadView('pdf.all-payments-of-a-license',  ['license' => $this->license])->download();
        }, 'Payment list print at -'.date('d-m-Y h-i-s').'.pdf');
    }

    public function render()
    {
        $this->licenses = auth()->user()->licenes;
        return view('livewire.my-license')->layout('layouts.backend.app');
    }
}
