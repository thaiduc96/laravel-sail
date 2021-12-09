<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarehousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouses', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('sap_id',36)->nullable()->comment('id ở SAP');

            $table->string('status', 10)->nullable();
            $table->string('code',30);
            $table->string('name');

            $table->timestamps();
            $table->softDeletes();

            $table->index(['status']);
            $table->index(['code']);
            $table->index(['name']);
            $table->index(['sap_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warehouses');
    }
}
