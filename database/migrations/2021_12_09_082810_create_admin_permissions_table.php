<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_permissions', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name');
            $table->string('group_name');
            $table->text('route_name')->comment('DÙng để check quyền');
            $table->string('key_authority')->comment('là key dùng ở route fe.dùng để xác kiểm tra quyền và ẩn hiện ở fe');
            $table->json('menus')->nullable()->comment('để gán quyền vs menu cho nhanh');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['route_name']);
            $table->index(['key_authority']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_permissions');
    }
}
