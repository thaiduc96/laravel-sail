<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvincesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provinces', function (Blueprint $table) {
            $table->id();
            $table->string('name',40);
            $table->string('slug',40);
            $table->string('type',20);
            $table->string('name_with_type',50);

            $table->string('region',10);

            $table->index(['region']);
            $table->index(['name']);
            $table->index(['type']);
            $table->index(['slug']);
            $table->index(['name_with_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provinces');
    }
}
