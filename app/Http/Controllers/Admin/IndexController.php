<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Cate;
use App\Model\Goods;
use App\Model\GoodsAttr;
use App\Model\Type;
use App\Model\Sku;
use App\Model\Attribute;

use DB;

class IndexController extends Controller
{
    //登陆添加
    public function login()
    {
        return view('admin.login');
    }
    public function login_do(Request $request)
    {
        $username=request()->username;
        $password=request()->password;
        // dd($info);
        $res=DB::table('user')->where('username','=',$username)->where('password','=',$password)->first();
        if(!empty($res)) {
            session(['name'=>$username]);
            echo "<script>alert('登录成功');location.href='/admin/index';</script>";
        }else{
            echo "<script>alert('登录失败,用户名或密码不正确');location.href='/admin/login';</script>";
        }
    }
     //注册添加
    public function reg()
    {
        return view('admin.reg');
    }
	//后台展示页
 	public function index()
 	{
 		return view('admin.index');
 	}

 	//分类添加
 	public function cateadd()
 	{
 		// echo  111;exit;
        $res = Cate::get()->toArray();
        //  dd($res);
        $cate = Cate::createTree($res);
        // dd($cate);
        return view('admin.cateadd',compact('cate'));
 	}

    //分类添加执行
 	public function cateadd_do(Request $request)
 	{
 		// echo 111;exit;
        $data = $request->all();
        // dd($data);
        $cate_name=request('cate_name');
        $onlyRes=Cate::where('cate_name',$cate_name)->first();
        if ($onlyRes) {
            echo "<script>alert('该分类名已占用');location.href='/admin/cateadd';</script>";die;
        }
         $res = DB::table('cate')->insert($data);
        // dd($res);
        if ($res){
            echo "<script>alert('添加成功');location.href='/admin/catelist';</script>";
        }else{
            echo "<script>alert('添加失败');location.href='/admin/cateadd';</script>";
        }
 	}

    //唯一性验证
    public function nameOnly(Request $request)
    {
      $info=$request->all();
      $cate_name=request('cate_name');
      $onlyRes=Cate::where('cate_name',$cate_name)->first();
      //dd($onlyRes);
      if($onlyRes){
        echo json_encode(['font'=>1]);
      }else{
        echo json_encode(['font'=>2]);
      }
    }

    //分类展示
 	public function catelist()
 	{
 		$res = Cate::get()->toArray();
        //  dd($res);
        $cate = Cate::createTree($res);
        foreach ($res as $k=>$v){
//           $aa = Goods::where('cate_id',$v['cate_id'])->count();
//            dd($aa);
           $cate[$k]['cate_count'] = Goods::where('cate_id',$v['cate_id'])->count();
       }
 		return view('admin.catelist',compact('cate'));
 	}

 	//类型添加
 	public function typeadd()
 	{
 		return view('admin.typeadd');
 	}

 	//类型添加执行
 	public function typeadd_do(Request $request)
 	{
 		$data = $request->all();
        // dd($data);
        $res = DB::table('type')->insert($data);
        // dd($res);
        if ($res){
            echo "<script>alert('添加成功');location.href='/admin/typelist';</script>";
        }else{
            echo "<script>alert('添加失败');location.href='/admin/typeadd';</script>";
        }
 	}

 	//类型展示
 	public function typelist()
 	{

 		$data = Type::get()->toArray();
        foreach ($data as $k=>$v){
            $data[$k]['attr_num'] = Attribute::where('type_id',$v['type_id'])->count();
        }
        return view('admin.typelist',compact('data'));
 	}

 	//类型模块属性展示
 	public function attrlist(Request $request)
 	{
 		$type_id=$request->all();
 		$type_id=$type_id["type_id"];
 		// dd($type_id);

 		$res= Type::join('attribute','attribute.type_id','=','type.type_id')->where('attribute.type_id',$type_id)->get();
 		// dd($res);
 		return view('admin.attrlist',compact('res'));
 	}

    //类型模块属性展示删除
    public function attrdel(Request $request)
    {
        $id = $request->id;
       // dd($id);
        //利用循环将需要删除的id 一个一个进行执行sql；
        foreach($id as $v){
            $res = DB::table('attribute')->where('a_id',"=","$v")->delete();
        }
        // dd($res);
        if($res){
            return json_encode(['code'=>200,'img'=>'删除成功']);
        }else{
            return json_encode(['code'=>201,'img'=>'删除失败']);
        }
    }

    // 商品添加
 	public function goodsadd()
 	{
        //查询分类数据
        $cateData = cate::get()->toArray();
        //查询类型数据
        $typeData = Type::get()->toArray();
        // var_dump($typeData);die;
 		return view('admin.goodsadd',[
                'cateData'=>$cateData,
                'typeData'=>$typeData
        ]);
 	}

 	//渲染商品属性中的值 加减号
 	public function goodsAttr(Request $request)
    {
        $type_id =$request->input('type_id');
        // dd($type_id);
        $attrData=Attribute::where(['type_id'=>$type_id])->get()->toArray();
        // var_dump($attrData);die;
        return json_encode($attrData);
    }

    //商品添加执行
 	public function goodsadd_do(Request $request)
 	{
 		$goodsData=$request->input();
 		//接收图片值
 		$img = request('img');
 		//生成图片
 		
 		$filename = md5(time().rand(1000,9999)).".".$img->getClientOriginalExtension();
 		$path = $img->storeAs('img',$filename);
 		$goods_nb = '6789'.rand(00000,99999);

 		// dd($goodsData);die;
 		//商品基础信息-》录用商品表
 		$goodsModel= Goods::create([
 			'goods_name'=>$goodsData['goods_name'],
 			'cate_id'=>$goodsData['cate_id'],
 			'goods_price'=>$goodsData['goods_price'],
 			'goods_nb'=>$goods_nb,
 			'img'=>$path,
 			'content'=>$goodsData['content']
 		]);
 		// die;
 		//获取只增id
 		$goods_id=$goodsModel['id'];
 		// dd($goods_id);
 		foreach ($goodsData['attr_id_list'] as $key => $value) {
 			$res=GoodsAttr::create([
 					'goods_id'=>$goods_id,
 					'a_id'=>$value,
 					'attr_value'=>$goodsData['attr_value_list'][$key],
                	'attr_price'=>$goodsData['attr_price_list'][$key],
 			]);
 		}
 		if ($res){
            echo "<script>alert('添加成功');location.href='/admin/skuadd/".$goods_id."';</script>";
        }else{
            echo "<script>alert('添加失败');location.href='/admin/goodsadd';</script>";
        }


 	}

 	//商品展示
 	public function goodslist()
 	{
 		$query=request()->all();
        $where = [];
        if ($query['goods_name']??'') {
            $where[]=['goods_name','like',"%$query[goods_name]%"];
        }
        if ($query['goods_price']??'') {
            $where['goods_price']= $query['goods_price'];
        }
        $pagesize=config('app.pageSize');
 		$data = Goods::join('cate','cate.cate_id','=','goods.cate_id')->where($where)->paginate($pagesize);
 		return view('admin.goodslist',compact('data','query'));
 	}


 	//商品上下架及点及改
    public function isshow(Request $request)
    {
        $is_show = $request->is_show;
        //dd($is_show);
        $goods_id = $request->id;
        //dd($goods_id);
        $res = Goods::where('goods_id', $goods_id)->update(['is_show' => $is_show]);
    }


 	//商品属性库存添加
 	public function skuadd($goods_id)
 	{
 		//通过goods_id查询商品表 （基础信息）
 		$goodsData=Goods::where(['goods_id'=>$goods_id])->get()->toArray();
 		// dd($goodsData);
 		//通过goods_id 查询商品属性值表（商品-属性关系表）
 		$attrData = GoodsAttr::join("attribute","goodsattr.a_id","=","attribute.a_id")->where(['goods_id'=>$goods_id,"attribute.atbe"=>2])->get()->toArray();
 		// dd($attrData);
 		$spec=[];  //规格数据
 		foreach ($attrData as $key => $value) {
 			$spec[$value['a_id']][]=$value;
 			// dd($spec);
 		}

 		$arr = '';
        foreach ($goodsData as $k=>$v){
//            dd($v);
            $arr = $v;
        }
 		return view('admin.skuadd',[
 			'arr'=>$arr,
 			'spec'=>$spec
 		]);
 	}

 	//商品属性库存添加执行
 	public function skuadd_do(Request $request)
 	{
 		$postData =$request->input();
 		// dd($postData);
 		//几个属性值为1组数据
 		$size =count($postData['attr']) / count($postData['product_number']);
 		// dd($size);
 		//分个数组
 		$attr = array_chunk($postData['attr'],$size);
 		// var_dump($attr);
 		foreach ($attr as $key => $value) {
 			//每次循环 入库一条数据
 			$insertData[] = [
 				'goods_id'=>$postData['goods_id'],
 				'value_list'=>implode(",",$value),
 				'product_number'=>$postData['product_number'][$key]
 			];
 		}
 		$res = Sku::insert($insertData);
 		// var_dump($res);die;
 		if ($res){
            echo "<script>alert('添加成功');location.href='/admin/goodslist/';</script>";
        }else{
            echo "<script>alert('添加失败');location.href='/admin/skuadd';</script>";
        }
 	}

}
