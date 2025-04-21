<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CellType extends Model
{
    use HasFactory;

    protected $table = 'cell_types';

    protected $fillable = [
        'product_name_sku',
        'recommended_seeding_density',
    ];
}
