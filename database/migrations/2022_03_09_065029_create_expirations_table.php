<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpirationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expirations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('operator_id');
            $table->date('issue_date');
            $table->date('expire_date');
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
        Schema::dropIfExists('expirations');
    }
}
