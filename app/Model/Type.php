<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
   	protected $table="type";
    protected $pk = 'id';
    public $timestamps=false;
}
