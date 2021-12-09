<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('sap_id',36)->nullable()->comment('id ở SAP');

            $table->string('code');
            $table->string('name');

            $table->uuid('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('admins')->onDelete('set null')->onUpdate('cascade');

            $table->string('status', 10)->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['code']);
            $table->index(['sap_id']);
            $table->index(['name']);
            $table->index(['status']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
