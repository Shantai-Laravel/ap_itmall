<?php

namespace App\Models;

use App\Base as Model;

class AdjacentProduct extends Model
{
    protected $table = 'adjacent_products';

    protected $fillable = ['product_id', 'adjacent_id'];
}
