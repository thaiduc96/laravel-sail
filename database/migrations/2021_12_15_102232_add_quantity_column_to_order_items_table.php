<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuantityColumnToOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->unsignedInteger('quantity_provider_confirm')->comment('số lượng nhà cung cấp xác nhận đáp ứng được')->default(0);
            $table->unsignedInteger('quantity_sales_confirm')->comment('số lượng sale xác nhận đặt hàng')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn(['quantity_provider_confirm']);
            $table->dropColumn(['quantity_sales_confirm']);
        });
    }
}
