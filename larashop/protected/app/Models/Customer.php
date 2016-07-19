<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';
    protected $fillable = ['nama', 'alamat', 'telepon', 'provinsi', 'kodepos', 'invoice', 'email', 'ip', 'customer_group', 'kota', 'type'];

    public static function boot() {

        parent::boot();
        static::saving(function($cus) {
            $cus->ip = $_SERVER['REMOTE_ADDR'];
        });
    
    }
}
