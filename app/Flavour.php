<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flavour extends Model
{
    
    protected $table = 'flavours';
    public $fillable =['name','price'];
}
