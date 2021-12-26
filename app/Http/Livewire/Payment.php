<?php

namespace App\Http\Livewire;

use App\Models\License;
use App\Models\Payment as ModelsPayment;
use Livewire\Component;
use App\Library\SslCommerz\SslCommerzNotification;
use DB;

class Payment extends Component
{
    public $license_number, $payments, $selected_payment_for_pay;

    public function search()
    {
        // $this->validate(['license_number' => 'required|string|exists:licenses,license_number']);
        $license = License::where('license_number', $this->license_number)->first();
        if ($license) {
            $this->payments = $license->payments;
        } else {
            $this->payments = null;
        }
    }

    public function selectForPay(ModelsPayment $payment)
    {
        $this->selected_payment_for_pay = $payment;
    }

    public function makePayment(ModelsPayment $payment)
    {
        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = $payment->amount; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # PAYMENT INFORMATION
        $post_data['payment_id'] = $payment->id;
        $post_data['license_number'] = $payment->license->license_number;

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $payment->license->user->name;
        $post_data['cus_email'] = $payment->license->user->email;
        $post_data['cus_add1'] = $payment->license->user->address ?? '-';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $payment->license->user->phone ?? '-';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "";
        $post_data['ship_add1'] = "";
        $post_data['ship_add2'] = "";
        $post_data['ship_city'] = "";
        $post_data['ship_state'] = "";
        $post_data['ship_postcode'] = "";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "License";
        $post_data['product_category'] = $payment->license->category->name ?? "-";
        $post_data['product_profile'] = "-";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        // Invalid Information! 'shipping_method' is missing. Shipping method of the order.
        // Example: YES or NO or Courier or Air or Ship or Truck. if shipping_method='NO', then Shipment Information/address not necessary.

        #Before  going to initiate the payment order status need to insert or update as Pending.
        // $update_product = DB::table('orders')
        //     ->where('transaction_id', $post_data['tran_id'])
        //     ->updateOrInsert([
        //         'name' => $post_data['cus_name'],
        //         'email' => $post_data['cus_email'],
        //         'phone' => $post_data['cus_phone'],
        //         'amount' => $post_data['total_amount'],
        //         'status' => 'Pending',
        //         'address' => $post_data['cus_add1'],
        //         'transaction_id' => $post_data['tran_id'],
        //         'currency' => $post_data['currency']
        //     ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        // $payment_options = $sslc->makePayment($post_data, 'hosted');
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');
        // "{"status":"fail","data":null,"message":"Invalid Information! 'store_id' is missing or empty."}"
        // "{"status":"success","data":"https:\/\/sandbox.sslcommerz.com\/EasyCheckOut\/testcde47435d241da67afc42b180088778c1fc","logo":"https:\/\/sandbox.sslcommerz.com\/stores\/logos\/demoLogo.png"}"
        // dd(json_decode($payment_options)->status);
        if (json_decode($payment_options)->status == 'success') {
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Ready for payment!']);
            // return redirect()->to(json_decode($payment_options)->data);
            return redirect()->away(json_decode($payment_options)->data);
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => json_decode($payment_options)->message]);
        }

        // if (!is_array($payment_options)) {
        //     print_r($payment_options);
        //     $payment_options = array();
        // }
    }

    public function render()
    {
        return view('livewire.payment')->layout('layouts.backend.app');
    }
}
