<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CultureVesselsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('culture_vessels')->insert([
            ['plate_format' => '6-well plate', 'surface_area_cm2' => 9.6, 'media_volume_per_well_ml' => 2.5],
            ['plate_format' => '12-well plate', 'surface_area_cm2' => 3.5, 'media_volume_per_well_ml' => 1],
            ['plate_format' => '24-well plate', 'surface_area_cm2' => 1.9, 'media_volume_per_well_ml' => 0.5],
            ['plate_format' => '48-well plate', 'surface_area_cm2' => 1.1, 'media_volume_per_well_ml' => 0.25],
            ['plate_format' => '96-well plate', 'surface_area_cm2' => 0.32, 'media_volume_per_well_ml' => 0.1],
            ['plate_format' => '384-well plate', 'surface_area_cm2' => 0.056, 'media_volume_per_well_ml' => 0.03],
            ['plate_format' => 'Other', 'surface_area_cm2' => null, 'media_volume_per_well_ml' => null],
            ['plate_format' => 'imaging ibidi 96-well plate', 'surface_area_cm2' => null, 'media_volume_per_well_ml' => null],
        ]);
    }
}
