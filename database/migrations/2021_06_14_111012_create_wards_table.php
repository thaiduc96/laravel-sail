<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wards', function (Blueprint $table) {
            $table->id();
            $table->string('name',40);
            $table->string('slug',40);
            $table->string('type',20);
            $table->string('name_with_type',70);
            $table->string('path',90);
            $table->string('path_with_type',150);

            $table->unsignedBigInteger('district_id');
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('wards');
    }
}
