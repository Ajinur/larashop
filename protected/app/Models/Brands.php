<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    protected $table = 'brands';
    protected $fillable = ['brand_name', 'status'];

    public function product()
    {
    	return $this->hasMany('App\Models\Product', 'brand_id');
    }
}
