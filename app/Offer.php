<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    public $incrementing = false;
    public $fillable = [
        'id',
        'product_id',
        'price',
        'amount',
        'sales',
        'article',
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
