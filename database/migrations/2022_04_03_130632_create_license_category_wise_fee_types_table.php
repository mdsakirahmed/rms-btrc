<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicenseCategoryWiseFeeTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('license_category_wise_fee_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->comment('id of license_categories table');
            $table->foreignId('fee_type_id')->comment('id of fee_types table');
            $table->integer('period_month')->default(0)->comment('month count'); //
            $table->integer('schedule_day')->default(0)->comment('day count');
            $table->double('amount')->default(0)->comment('total amount');
            $table->double('late_fee')->default(0)->comment('in percentage');
            $table->double('vat')->default(0)->comment('in percentage');
            $table->double('tax')->default(0)->comment('in percentage');
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
        Schema::dropIfExists('license_category_wise_fee_types');
    }
}
