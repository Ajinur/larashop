<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'name', 
        'description', 
        'price', 
        'brand_id', 
        'category_id',
        'model', 
        'meta_title', 
        'meta_description',
        'meta_keyword', 
        'tags', 
        'quantity',
        'length_type', 
        'weight', 
        'weight_type'
    ];

    public function transaction()
    {
    	return $this->hasMany('App\Models\Transaction', 'product_id');
    }

    public function brand()
    {
    	return $this->belongsTo('App\Models\Brands', 'brand_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function product_tags()
    {
        return $this->belongsToMany('\App\Models\Tags','product_tags', 'product_id', 'tags_id')->withTimestamps();
    }

    public function testimoni()
    {
        return $this->hasMany('App\Models\Testimoni', 'product_id');
    }

    public static function boot() {

        parent::boot();
        static::saving(function($product) {
            $product->slug = str_slug(\Input::get('name'), '-');
        });
    
    }
}
