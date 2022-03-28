<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartialPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partial_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_id');
            $table->foreignId('bank_id')->nullable();
            $table->date('payment_date')->nullable();
            $table->double('paid_amount')->nullable();
            $table->double('vat')->nullable();
            $table->double('late_fee')->nullable(); // If payment date expire
            $table->string('pay_order_number')->nullable();
            $table->string('journal_number')->nullable();
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
        Schema::dropIfExists('partial_payments');
    }
}
