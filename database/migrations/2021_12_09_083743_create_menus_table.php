<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name');
            $table->string('key_authority')->comment('dùng để kiểm tra và ẩn hiện ở menu fe');
            $table->string('parent_key_authority')->nullable();
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('menus');
    }
}
