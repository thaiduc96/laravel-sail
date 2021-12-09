<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code');
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('phone',30)->unique()->nullable();

            $table->string('status')->default(STATUS_ACTIVE);

            $table->uuid('admin_group_id');
            $table->foreign('admin_group_id')->references('id')->on('admin_groups')->onDelete('cascade')->onUpdate('cascade');

            $table->uuid('warehouse_id');
            $table->foreign('warehouse_id')->references('id')->on('warehouse_id')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['phone']);
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
        Schema::dropIfExists('admins');
    }
}
