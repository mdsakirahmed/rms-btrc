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
            $table->foreignId('period_id');
            $table->double('late_fee_percentage')->default(0);
            $table->double('vat_percentage')->default(0);
            $table->double('tax_percentage')->default(0);
            $table->double('receive_amount')->default(0);
            $table->date('receive_date');
            $table->integer('late_days')->default(0);
            $table->double('late_fee_receivable_amount')->default(0)->comment('Due days wise count');
            $table->double('late_fee_receive_amount')->default(0);
            $table->foreignId('created_by')->nullable();
            $table->foreignId('updated_by')->nullable();
            $table->foreignId('deleted_by')->nullable();
            $table->softDeletes();
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
