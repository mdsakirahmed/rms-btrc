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
            $table->foreignId('receive_fee_id');
            $table->foreignId('receive_period_id');
            $table->double('receivable_amount')->default(0);
            $table->date('receive_date');
            $table->double('receive_amount')->default(0);
            $table->double('receive_vat')->default(0);
            $table->double('receive_let_fee')->default(0);
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
