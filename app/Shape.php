<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shape extends Model
{
    protected $table = 'shapes';
    public $fillable =['name','availability'];
}
