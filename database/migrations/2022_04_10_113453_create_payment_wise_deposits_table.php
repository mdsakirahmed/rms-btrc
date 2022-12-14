<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentWiseDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_wise_deposits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_id');
            $table->foreignId('bank_id');
            $table->foreignId('deposit_by_user_id')->nullable();
            $table->double('amount')->default(0);
            $table->string('journal_number');
            $table->date('date');
            $table->string('po_number')->nullable();
            $table->text('slip')->nullable();
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
        Schema::dropIfExists('payment_wise_deposits');
    }
}
