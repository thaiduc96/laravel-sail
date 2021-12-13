<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('sap_id',36)->nullable()->comment('id ở SAP');

            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phones',30)->nullable();
            $table->string('sale_org')->nullable();
            $table->string('company')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['sap_id']);
            $table->index(['name']);
            $table->index(['email']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
