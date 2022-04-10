<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentWiseReceivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_wise_receives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_id');
            $table->foreignId('fee_type_id');
            $table->date('period_date');
            $table->date('receive_date');
            $table->double('receive_amount')->default(0);
            $table->double('late_fee_percentage')->default(0);
            $table->double('vat_percentage')->default(0);
            $table->double('tax_percentage')->default(0);
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
        Schema::dropIfExists('payment_wise_receives');
    }
}
