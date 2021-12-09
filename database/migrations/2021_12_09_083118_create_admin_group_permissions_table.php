<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminGroupPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_group_permissions', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('admin_group_id');
            $table->foreign('admin_group_id')->references('id')->on('admin_groups')->onDelete('cascade')->onUpdate('cascade');

            $table->uuid('admin_permission_id');
            $table->foreign('admin_permission_id')->references('id')->on('admin_permissions')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_group_permissions');
    }
}
