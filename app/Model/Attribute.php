<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
	protected $table="attribute";
    protected $pk = 'id';
    public $timestamps=false;
}
