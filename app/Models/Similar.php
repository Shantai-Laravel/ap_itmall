<?php

namespace App\Models;

use App\Base as Model;

class Similar extends Model
{
    protected $table = 'similars';

    protected $fillable = ['product_id', 'similar_id'];
}
