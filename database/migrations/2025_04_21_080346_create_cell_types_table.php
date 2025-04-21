<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCellTypesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('cell_types')) {
            Schema::create('cell_types', function (Blueprint $table) {
                $table->id();
                $table->string('product_name_sku');
                $table->integer('recommended_seeding_density')->nullable();
                $table->timestamps();
            });
        } else {
            // Optional: Log or handle the case where the table already exists
            // Log::info('Table cell_types already exists.');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('cell_types')) {
            Schema::dropIfExists('cell_types');
        }
    }
}
