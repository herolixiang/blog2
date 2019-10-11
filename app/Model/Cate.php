<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    protected $table = 'cate';
    protected $pk = 'id';
    public $timestamps = false;

    public  static function createTree($data,$pid=0,$level=0)
    {
		//echo  111;exit;
        if (!$data || !is_array($data)) {
            return;
        }
        static $arr=[];
        foreach ($data as $k=>$v){
            // dd($v);
            if ($v['cate_pid']==$pid){
                $v['level']=$level;
                $arr[]=$v;
                self::createTree($data,$v['cate_id'],$level+1);
            }
        }
        return $arr;
    }
}
