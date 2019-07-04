<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = ['id'];

    /**
     * Get category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
