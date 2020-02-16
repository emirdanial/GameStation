<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /*protected $fillable = [
        'title', 'price', 'platform','genre', 'publisher', 'image',
    ];*/

     protected $guarded = [];

    public function orders()
    {
    	return $this->belongsToMany(Order::class);
    }
}
