<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use App\Notifications\InstalmentNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class InstalmentAlertCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'instalment:notification-send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending instalment alert';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $payments = DB::table('users')
        ->join('licenses', 'users.id', '=', 'licenses.user_id')
        ->join('payments', 'licenses.id', '=', 'payments.license_id')
        ->where('paid', false)
        ->whereMonth('last_date_of_payment', date('m'))
        ->whereYear('last_date_of_payment', date('Y'))
        ->select('name', 'email', 'phone', 'license_number', 'amount', 'last_date_of_payment', 'paid')
        ->get();

        foreach($payments as $payment_data){
            Notification::route('mail', [
                $payment_data->email => $payment_data->name,
            ])->notify(new InstalmentNotification($payment_data));
        }

        /**
         *
          +"id": 1
          +"name": "Mr. User"
          +"email": "user@gmail.com"
          +"email_verified_at": null
          +"password": "$2y$10$YIl0ONXCJ8UFxA9wjSSaje8EbtRnWiIeDIfD.fqdCG12vMbyNnAOi"
          +"remember_token": null
          +"created_at": "2021-12-29 13:11:01"
          +"updated_at": "2021-12-29 13:11:01"
          +"created_by": 1
          +"updated_by": 1
          +"deleted_by": null
          +"user_id": 2
          +"license_sub_category_id": 1
          +"license_category_id": 1
          +"license_number": "574"
          +"fee": 100.0
          +"instalment": 10
          +"expire_date": "2010-07"
          +"license_id": 1
          +"payment_method_id": null
          +"transaction": null
          +"amount": 10.0
          +"last_date_of_payment": "2023-02-18"
          +"payment_date": null
          +"paid": 0
         */
    }
}
