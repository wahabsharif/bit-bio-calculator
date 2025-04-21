<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCultureVesselsTable extends Migration
{
    public function up()
    {
        Schema::create('culture_vessels', function (Blueprint $table) {
            $table->id();
            $table->string('plate_format');
            $table->float('surface_area_cm2')->nullable();
            $table->float('media_volume_per_well_ml')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('culture_vessels');
    }
}
