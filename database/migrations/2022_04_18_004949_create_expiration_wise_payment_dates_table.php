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
            $table->integer('payment_number');
            $table->date('period_start_date');
            $table->date('period_end_date');
            $table->date('period_schedule_date');
            $table->string('period_label');
            $table->double('total_receivable')->default(0);
            $table->foreignId('created_by')->nullable();
            $table->foreignId('updated_by')->nullable();
            $table->foreignId('deleted_by')->nullable();
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
