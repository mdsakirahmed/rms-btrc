<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use PDF;

use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function payment_receipt(Payment $payment){
        return response()->streamDownload(function () use ($payment) {
            PDF::loadView('pdf.payment-receipt', [
                'file_name' => 'Collection Receipt',
                'payment' => $payment
            ])->stream('Payment Receipt Generated at '.date('d-m-Y- h-i-s').'.pdf');
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Success !']);
            redirect()->to('/payment');
        }, 'Payment receipt generated at ' . date('d-m-Y- h-i-s') . '.pdf');
    }
}
