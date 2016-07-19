<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $table = 'informations';
    protected $fillable = ['title', 'description', 'slug', 'status', 'order', 'meta_title', 'meta_description', 'meta_keyword'];

    public static function boot() {

        parent::boot();
        static::saving(function($info) {
            $info->slug = str_slug(\Input::get('title'), '-');
        });
    
    }
}
