<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sprinkle extends Model
{
    protected $table = 'sprinkles';
    public $fillable =['name','price','image','availability'];
}
