<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use DB;
class KaoController extends Controller
{
	public function login()
	{
		return view('kao.login');
	}
	public function login_do(Request $request)
	{
		//接收用户名 密码
		$username=$request->input('username');
		$password=$request->input('password');
		//验证用户名和密码是否正确
		$userData = User::where(['username'=>$username,'password'=>$password])->first();
		if (!$userData) {
			//报错
			echo '用户名密码错误';die;
		}else{
			//登陆成功
			session(['username'=>$username]);
			//生成一个令牌
			$token=md5($userData['id'].time());  //MD5(用户id+时间戳)
			//存储到数据库中
			$userData->token= $token;
			$userData->expire_time =time()+7200;
			$userData->save();
			return json_encode(['code'=>200,'msg'=>'登陆成功','data'=>$token]);
		}
	}

	public function index()
	{
		return view('kao.index');
	}

	public function index_do()
  	{
	   $city = request('city');
        $cache_name = 'weatherData_'.$city;
        $data = \Cache::get($cache_name);
        //如果是ajax请求，调用天气接口
        if (request()->ajax()) {
            //调用天气接口
            $url = 'http://api.k780.com/?app=weather.future&weaid='.$city.'&&appkey=43592&sign=4682382bde3dd6573c126f63d9e77611';
            // dd($url);
            $data =  file_get_contents($url);
            $time24 = strtotime(date("Y-m-d"))+86400;
            // dd($time24);
            $second = $time24 - time();
            // dd($second);
            \Cache::put($cache_name,$data,$second);
            echo $data;die;
        }
 	}
}
