<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $incrementing = false;
    public $fillable = [
        'id',
        'title',
        'alias',
        'parent',
    ];
    
    public function products()
    {
        return $this->belongsToMany('App\Product');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent');
    }
}
