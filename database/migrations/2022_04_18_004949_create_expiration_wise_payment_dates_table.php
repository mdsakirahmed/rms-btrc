<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpirationWisePaymentDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expiration_wise_payment_dates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expiration_id');
            $table->foreignId('fee_type_id');
            $table->boolean('paid')->default(false);
            $table->integer('payment_number');
            $table->date('period_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expiration_wise_payment_dates');
    }
}
