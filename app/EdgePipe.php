<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EdgePipe extends Model
{
        protected $table = 'edge_pipes';
    public $fillable =['name','price','image','availability'];
}
