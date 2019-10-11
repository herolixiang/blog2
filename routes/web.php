<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/', function () {
//     return view('welcome');
// });


//前台
Route::get('/','Index\IndexController@index');

Route::middleware(['apiheader'])->group(function(){
		Route::any('/api/index/login','Api\IndexController@login'); //登录添加
		Route::any('/api/index/index','Api\IndexController@index'); //分类接口
		Route::any('/api/index/news','Api\IndexController@news'); //最新商品消息
		Route::any('/api/index/proinfo','Api\IndexController@proinfo'); //商品详情页
		


		//已登录接口 使用验证token中间件
		Route::middleware(['mytoken'])->group(function(){
			Route::any('/api/index/login_do','Api\IndexController@login_do'); //登录添加执行
			Route::any('/api/index/addcart','Api\IndexController@addcart'); //加入购物车
			Route::any('/api/index/listcart','Api\IndexController@listcart'); //购物车展示页面
		});
});
//后台
	//登陆
	Route::any('admin/login','Admin\IndexController@login');
	Route::any('admin/login_do','Admin\IndexController@login_do');

Route::group(['middleware' => ['login'],'prefix'=>'/admin/'], function () {
	Route::get('index','Admin\IndexController@index');
	//注册
	Route::any('reg','Admin\IndexController@reg');
	//分类模块
	Route::any('cateadd','Admin\IndexController@cateadd');  //分类添加
	Route::any('cateadd_do','Admin\IndexController@cateadd_do');  //分类添加执行
	Route::any('nameOnly','Admin\IndexController@nameOnly');  //唯一性验证
	Route::any('catelist','Admin\IndexController@catelist');  //分类展示
	//类型模块
	Route::any('typeadd','Admin\IndexController@typeadd');  //类型添加
	Route::any('typeadd_do','Admin\IndexController@typeadd_do');  //类型添加执行
	Route::any('typelist','Admin\IndexController@typelist');  //类型展示
	Route::any('attrlist','Admin\IndexController@attrlist');  //类型模块属性展示
	Route::any('attrdel','Admin\IndexController@attrdel'); // //类型模块属性展示删除
	//商品模块
	Route::any('goodsadd','Admin\IndexController@goodsadd');  //商品添加
	Route::any('goodsadd_do','Admin\IndexController@goodsadd_do');  //商品添加执行
	Route::any('goodslist','Admin\IndexController@goodslist');  //商品展示
	Route::any('isshow','Admin\IndexController@isshow');  //商品上下架及点及改
	Route::any('goodsAttr','Admin\IndexController@goodsAttr');  //渲染商品属性中的值 加减号
	Route::any('skuadd/{goods_id}','Admin\IndexController@skuadd'); //商品属性库存添加
	Route::any('skuadd_do','Admin\IndexController@skuadd_do'); //商品属性库存添加执行
});

Route::get('kao/login','KaoController@login');
Route::any('kao/login_do','KaoController@login_do');
Route::group(['middleware' => ['login'],'prefix'=>'/kao/'], function () {
	Route::any('index','KaoController@index');
	Route::any('index_do','KaoController@index_do');
});
