<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeSkuNullableInProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Change the sku column to nullable
            $table->string('sku')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Revert the sku column to NOT NULL
            $table->string('sku')->nullable(false)->change();
        });
    }
}
