<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{

    protected $table = 'orders';

    public $fillable =['name','phone','email','date','address','notes','cake_name','cake_description','cake_size','cake_price','cake_image','status'];

    public function getCreatedAtAttribute($value){
    	return Carbon::parse($value)->format('M j, Y');
    }
    public function getDateAttribute($value){
    	return Carbon::parse($value)->format('M j, Y');
    }

}
