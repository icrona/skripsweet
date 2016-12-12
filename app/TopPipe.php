<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopPipe extends Model
{
    protected $table = 'top_pipes';
    public $fillable =['name','price','image','availability'];
}
