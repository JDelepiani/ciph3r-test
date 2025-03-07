<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function prices()
    {
        return $this->hasMany(Price::class);
    }
}
