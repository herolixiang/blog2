<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GoodsAttr extends Model
{
    protected $table="goodsattr";
    protected $primarykey = 'id';
    public $timestamps=false;
    protected $guarded = [];
}
