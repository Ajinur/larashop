<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon, Input;

class Testimoni extends Model
{
    protected $table = 'testimoni';
    protected $fillable = ['product_id', 'testimoni_date', 'name', 'email', 'testimoni', 'status', 'rating'];

    public function product()
    {
    	return $this->belongsTo('App\Models\Product', 'product_id');
    }

    public static function boot() {

        parent::boot();
        static::saving(function($review) {
            $review->product_id = Input::get('product_id');
            $review->testimoni_date = Carbon::now()->toDateTimeString();
            $review->status = 0;
        });
    
    }
}
