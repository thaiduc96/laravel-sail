<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->string('name',40);
            $table->string('slug',40);
            $table->string('type',20);
            $table->string('name_with_type',50);
            $table->string('path',70);
            $table->string('path_with_type',100);

            $table->unsignedBigInteger('province_id');
            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade')->onUpdate('cascade');

            $table->index(['name']);
            $table->index(['slug']);
            $table->index(['type']);
            $table->index(['name_with_type']);
            $table->index(['path']);
            $table->index(['path_with_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('districts');
    }
}
