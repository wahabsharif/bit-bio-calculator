<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameCellTypesToProductsAndModifyColumns extends Migration
{
    public function up()
    {
        Schema::rename('cell_types', 'products');

        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('product_name_sku', 'product_name');
            $table->renameColumn('recommended_seeding_density', 'seeding_density');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->string('sku')->after('product_name');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('sku');
            $table->renameColumn('product_name', 'product_name_sku');
            $table->renameColumn('seeding_density', 'recommended_seeding_density');
        });

        Schema::rename('products', 'cell_types');
    }
}
