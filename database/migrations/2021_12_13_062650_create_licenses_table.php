<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('license_category_id')->nullable();
            $table->foreignId('license_sub_category_id')->nullable();
            $table->string('license_number')->unique();
            $table->double('fee');
            $table->integer('instalment');
            $table->string('issue_date')->nullable();
            $table->string('expire_date');
            $table->string('renewal_date')->nullable();
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('contac_number')->nullable();
            $table->string('website')->nullable();
            $table->string('name_and_designation_of_the_contact_person')->nullable();
            $table->string('mobile_number_of_contact_person')->nullable();
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
        Schema::dropIfExists('licenses');
    }
}
