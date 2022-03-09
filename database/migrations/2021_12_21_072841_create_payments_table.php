<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expiration_id');
            $table->foreignId('bank_id')->nullable();
            $table->foreignId('branch_id')->nullable();
            $table->double('payble_amount')->default(0);
            $table->date('last_date_of_payment');
            $table->date('payment_date')->nullable();
            $table->double('vat')->nullable();
            $table->double('late_fee')->nullable(); // If payment date expire
            $table->boolean('paid')->default(false);
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
        Schema::dropIfExists('payments');
    }
}
