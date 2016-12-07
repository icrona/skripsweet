<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cake extends Model
{
    protected $table = 'cakes';
    public $fillable =['name','description','category','size','price','image'];
}
