<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function prices()
    {
        return $this->hasMany(Price::class);
    }
}
