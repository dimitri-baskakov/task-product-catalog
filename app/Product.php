<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $incrementing = false;
    
    public function offers()
    {
        return $this->hasMany('App\Offer');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }
}
