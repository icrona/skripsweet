<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Decoration extends Model
{
    
    protected $table = 'decorations';
    public $fillable =['name','price','image','availability'];
}
