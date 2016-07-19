<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon, Input;

class Category extends Model
{
    protected $table = 'category';
    protected $fillable = [
        'category_name', 
        'slug', 
        'status', 
        'level', 
        'order', 
        'description', 
        'meta_title',
        'meta_description',
        'meta_keyword',
        'meta_image'
    ];

    public function sub_cat()
    {
    	return $this->hasMany('App\Models\Category', 'level')->orderBy('category_name');
    }

    public function product()
    {
        return $this->hasMany('App\Models\Product', 'category_id');
    }

    public static function boot()
    {
        parent::boot();
        static::saving(function($categories) {
            $categories->slug = str_slug(Input::get('category_name'), '-');
            $categories->created_at = Carbon::now()->toDateTimeString();
            $categories->updated_at = Carbon::now()->toDateTimeString();
        });
    }
}
