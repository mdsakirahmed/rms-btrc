<?php

use App\Http\Controllers\SslCommerzPaymentController;
use App\Models\User;
use App\Notifications\InstalmentNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('frontend.home');
});

require __DIR__.'/auth.php';
require __DIR__.'/backend.php';


// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

Route::get('test', function () {

    $users = DB::table('users')
    ->join('licenses', 'users.id', '=', 'licenses.user_id')
    ->join('payments', 'licenses.id', '=', 'payments.license_id')
    ->where('paid', false)
    ->where('last_date_of_payment', '<=', Carbon::now()->subDays(10)->toDateTimeString())
    ->select('name', 'email', 'phone', 'license_number', 'amount', 'last_date_of_payment', 'paid')
    ->get();
    /**
     *  +"id": 1
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
    dd($users);
});
