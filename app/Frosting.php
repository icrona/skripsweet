<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frosting extends Model
{
    protected $table = 'frostings';
    public $fillable =['name','one','two','three','four','availability'];
}
