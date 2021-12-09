<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_groups', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('key');
            $table->string('name');

            $table->string('status',20)->default(STATUS_ACTIVE);

            $table->string('description')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->index(['key']);
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
        Schema::dropIfExists('admin_groups');
    }
}
