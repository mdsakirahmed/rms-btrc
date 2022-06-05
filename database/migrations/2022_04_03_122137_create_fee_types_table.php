<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeeTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('period_format')->default(1)->comment('1-Jan/2018-19 | 2-Jan-Feb/2022');
            /*
            License Fee period format "Jan/2018-19" | Revenue Sharing fee period format "Jan-Feb/2022" | Spectrum Charge fee period format "Jan-Mar/2022"
            */
            $table->integer('schedule_day')->default(0);
            $table->integer('schedule_month')->default(0);
            $table->boolean('schedule_include_to_beginning_of_period')->default(true);
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
        Schema::dropIfExists('fee_types');
    }
}
