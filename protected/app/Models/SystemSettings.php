<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemSettings extends Model
{
    protected $table = 'system_settings';
    protected $fillable = [
    	'store_name',
    	'store_owner',
    	'store_url',
    	'address',
    	'email',
    	'phone',
    	'fax',
    	'logo',
    	'meta_title',
    	'meta_description',
    	'meta_keyword',
    	'invoice_prefix',
    	'order_status',
    	'processing_order_status',
    	'complete_order_status',
    ];

    public $timestamps = false;
}
