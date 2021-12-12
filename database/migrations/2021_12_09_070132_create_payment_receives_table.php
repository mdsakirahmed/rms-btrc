<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentReceivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_receives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('license_category_id');
            $table->foreignId('license_sub_category_id');
            $table->foreignId('operator_id');
            $table->string('receivable_amount');
            $table->string('receive_date');
            $table->string('receive_amount');
            $table->string('receive_vat');
            $table->string('receive_let_fee');
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
        Schema::dropIfExists('payment_receives');
    }
}
