<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Cache;
use Closure;

class ApiHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //    *等价于所有
        // 制定允许其他域名访问
        header('Access-Control-Allow-Origin:*');
        // 响应类型
        header('Access-Control-Allow-Methods:*');
        //请求头
        header('Access-Control-Allow-Headers:*');
        // 响应头设置
        header('Access-Control-Allow-Credentials:false');
        //数据类型
        header('content-type:application:json;charset=utf8');
        //  header("content-type:text/html;charset=utf-8");  //设置编码


        //获取客户端ip
        $url='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
        $ip = $_SERVER["REMOTE_ADDR"];
        //$ip=$_SERVER['HTTP_USER_AGENT'];
        $cache_key='pass_time_ip'.$url.$ip;
        //Cache::forget($cache_key);die;
        $num =Cache::get($cache_key);
        if(!$num){
            $num=0;
        }
        $limit=5; //限制的次数
        if($num>$limit){
            //次数如果大于限制数 给出提示
            echo json_encode(['msg'=>"60秒内只能刷新5次"]);die;
        }else{
            //不大于限制次数 累加 正常访问
            $num+=1;
            Cache::put($cache_key,$num,60);
        }
        //echo $num;
        return $next($request);
    }
}
