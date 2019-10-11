<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Tools\Wechat;
use App\Http\Controllers\Controller;
use App\Model\Goods;
use App\Model\Cate;
use App\Model\GoodsAttr;
use App\Model\User;
use App\Model\Cart;
use App\Model\Attribute;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
	public $request;
    public $wechat;
    public function __construct(Request $request,Wechat $wechat)
    {
        $this->request = $request;
        $this->wechat = $wechat;
    }

	//登录
	public function login(Request $request)
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
			//生成一个令牌
			$token=md5($userData['id'].time());  //MD5(用户id+时间戳)
			//存储到数据库中
			$userData->token= $token;
			$userData->expire_time =time()+7200;
			$userData->save();
			return json_encode(['code'=>200,'msg'=>'登陆成功','data'=>$token]);
		}
		
	}

	//登陆查询用户信息
	public function login_do(Request $request)
	{
		$token = $request->input("token"); //接受token令牌
		if (empty($token)) {
			return json_encode(['code'=>201,'msg'=>"请先登录"]);
		}
		//检测token是否正确
		$userData = User::where(['token'=>$token])->first();
		if (!$userData) {
			return json_encode(['code'=>201,'msg'=>"请先登录"]);
		}
		//判断有效期
		if(time()>$userData['expire_time']){
			return json_encode(['code'=>202,'msg'=>"请从新登陆"]);
		}
		//更新token有效期(业物)
		$userData->expire_time=time()+7200;
		$userData->save();

		//查询用户信息
		echo "admin";die;
	}

	//商品分类
	public function index()
	{
		$indexData=Cate::limit(8)->get();
		return json_encode($indexData);
	}

	//最新添加商品4条消息
 	public function news()
 	{
 		//缓存处理
 		//先去缓存里读数据
 		// $cache_name="goods_news";
 		// $goodsData=Cache::get($cache_name);
 		// // //缓存有数据 =》用缓存
 		// if (empty($goodsData)) {
 			//缓存里如果没有数据=》 查询数据库 =》储存到缓存里
 			$goodsData = Goods::orderBy("goods_id","DESC")->limit(4)->get();
 			foreach ($goodsData as $key => $value) {
 				$goodsData[$key]['img']="http://www.blog2.com/".$value['img'];
 			}
 		// 	//存到缓存里
 		// 	Cache::put($cache_name,$goodsData,24*60*60);
 		// }
 		return json_encode($goodsData);
 	}

 	//商品详情页
 	public function proinfo(Request $request)
 	{
 		$res=$request->all();
 		// dd($res);
		$goods_id=$res["goods_id"];
		// dd($goods_id);
		//通过goods_id查询商品表 （基础信息）
 		$goodsData=Goods::where('goods_id',$goods_id)->first();
 		//通过goods_id 查询商品属性值表（商品-属性关系表）(数据处理 不同属性分组)
 		$attrData = GoodsAttr::join("attribute","goodsattr.a_id","=","attribute.a_id")->where(['goods_id'=>$goods_id])->get()->toArray();
 		// dd($attrData);
 		$specData=[];  //规格数据
 		$argsData=[]; //参数数据
 		foreach ($attrData as $key => $value) {
 			if ($value['atbe']==2) {
 				$specData[$value['a_id']][]=$value;
 			}else{
 				$argsData[]=$value;
 			}
 			
 		}	
 		return json_encode([
 			'goodsData'=>$goodsData,
 			'specData'=>$specData,
 			'argsData'=>$argsData
 		]);
 	}

 	//加入购物车
 	public function addcart(Request $request)
 	{
 		$userData =$request->get('userData');
 		// dd($userData,1);
 		$data = $request -> all();
 		// dd($data,1,$userData);die;
 		$info = implode("’",$data['attr_list']);
 		$cartData = [
 			'goods_id'=>$data['goods_id'],
 			'attr_list_id' => $info,
 			'user_id' => $userData['id'],
 			'buy_number'=>$data['goods_num'],
 		];
 		$cart = Cart::create($cartData);
 		echo json_encode(['code'=>200,'msg'=>"添加购物车成功",'goods_id'=>$data['goods_id']]);
 	}

 	//购物车展示页面
 	public function listcart(Request $request)
 	{
 		$userData =$request->get('userData');
 		//dd($userData);
 		$user_id=1;
 		//查询购物车表数据 返回json
 		$cartData = Cart::join("goods","cart.goods_id","=","goods.goods_id")->where(['user_id'=>$user_id])->get()->ToArray();
 		// dd($cartData);
 		foreach ($cartData as $key => $value) {
 			//属性值
 			$attr_list_id =explode(",",$value['attr_list_id']);
 			$cartData[$key]['img'] ='http://www.blog2.com/'.$value['img'];
 			$goodsAttrData=GoodsAttr::join("attribute","goodsattr.a_id","=","attribute.a_id")->whereIn('c_id',$attr_list_id)->get()->ToArray();
 			// var_dump($goodsAttrData);die;

 			$goods_attr_list = "";
 			foreach ($goodsAttrData as $k => $v) {
 				$goods_attr_list .= $v['a_name'].":".$v['attr_value'].",";
 			}
 			$goods_attr_list =rtrim($goods_attr_list,",");
 			// var_dump($goods_attr_list);die;
 			$cartData[$key]['goods_attr_list']=$goods_attr_list;
 		}
 		// dd($cartData);die;
 		return json_encode(['cartData'=>$cartData]);
 	}
}
