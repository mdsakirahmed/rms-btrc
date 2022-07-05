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
            $table->foreignId('category_id')->comment('id of license_categories table');
            $table->foreignId('sub_category_id')->nullable();
            $table->string('name');
            $table->integer('period_format')->default(1)->comment('1-Jan/2018-19 | 2-Jan-Feb/2022');
            //License Fee period format "Jan/2018-19" | Revenue Sharing fee period format "Jan-Feb/2022" | Spectrum Charge fee period format "Jan-Mar/2022"
            $table->integer('schedule_day')->default(0);
            $table->integer('schedule_month')->default(0);
            $table->integer('schedule_subtract_day')->default(0);
            $table->integer('period_month')->default(0);
            $table->integer('free_month_at_start')->default(0);
            $table->boolean('period_start_with_issue_date')->default(false);
            //License fee start with issue date but revenue sharing and others start with calendar year
            $table->boolean('schedule_include_to_beginning_of_period')->default(true);
            $table->double('amount')->default(0)->comment('total amount');
            $table->double('late_fee')->default(0)->comment('in percentage');
            $table->double('vat')->default(0)->comment('in percentage');
            $table->double('tax')->default(0)->comment('in percentage');
            $table->foreignId('created_by')->nullable();
            $table->foreignId('updated_by')->nullable();
            $table->foreignId('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
