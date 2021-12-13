<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSapTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_saps', function (Blueprint $table) {
            $table->string("id");
            $table->string("address");
            $table->string("phone")->nullable();
            $table->string("province");
            $table->string("name");
            $table->string("email")->nullable();
            $table->string("sale_org");
            $table->string("company");
        });

        Schema::create('product_saps', function (Blueprint $table) {
            $table->string("id");
            $table->string("name");
            $table->integer("price");
            $table->string("product_type");
            $table->string("product_group");
            $table->string("subgroup_id");
            $table->string("origin");
        });

        Schema::create('provider_saps', function (Blueprint $table) {
            $table->string("id");
            $table->string("name");
        });

        Schema::create('warehouse_saps', function (Blueprint $table) {
            $table->string("id");
            $table->string("name");
            $table->string("company_code");
            $table->string("provider_name")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_saps');
        Schema::dropIfExists('product_saps');
        Schema::dropIfExists('provider_saps');
        Schema::dropIfExists('warehouse_saps');
    }
}
