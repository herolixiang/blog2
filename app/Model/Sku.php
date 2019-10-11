<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
	protected $table="sku";
    protected $primarykey = 'id';
    public $timestamps=false;
    protected $guarded = [];
}
