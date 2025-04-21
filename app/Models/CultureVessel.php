<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CultureVessel extends Model
{
    use HasFactory;

    protected $fillable = [
        'plate_format',
        'surface_area_cm2',
        'media_volume_per_well_ml',
    ];
}
