@extends('layouts.admin')
@section('content')
<html>
	<h3>分类模块-分类展示</h3>
	<body>
		<form>
			<input type="text" name="goods_name" value="{{$query['goods_name']??''}}" placeholder="请输入商品名称关键字">
			<input type="text" name="goods_price" value="{{$query['goods_price']??''}}" placeholder="请输入商品价格关键字">
			<button>搜索</button>
		</form>
		<table class="table table-bordered table-striped form-horizontal">
			<tr>
				<td>编号</td>
				<td>商品名称</td>
				<td>分类名称</td>
				<td>货号</td>
				<td>价格</td>
				<td>图片</td>
				<td>上架</td>
			</tr>
			@foreach($data as $k=>$v)
                <tr >
                   	<td>
                       {{$v['goods_id']}}
                    </td>
                    <td>{{$v['goods_name']}}</td>
                    <td>{{$v['cate_name']}}</td>
                    <td>{{$v['goods_nb']}}</td>
                    <td>{{$v['goods_price']}}</td>
                    <td><img src="/{{$v['img']}}" alt="暂无图片" width="50" class="content"></td>
                    <td>
                        
                                    @if (($v['is_show'])== 1)
                                        <span class="se">已上架</span>
                                    @else
                                        <span class="se">以下架</span>
                                    @endif
                        
                    </td>
                </tr>
             @endforeach
		</table>
		{{$data->appends($query)->links()}}
	</body>
</html>
<script type="text/javascript">
        $(document).on("click",".se",function (){
              //alert(111);
             var _this = $(this);
             var id = _this.parent().prev().prev().prev().prev().prev().prev().text();
             //alert(id);
             var test =_this.html();
             // console.log(test);
             var is_show = '';
             if (test=='已上架') {
                 var test =_this.html('已下架');
                 var is_show = 2;
             }else{
                 var test =_this.html('已上架');
                 var is_show = 1;
             }
             //alert(is_show);
             $.ajax({
                 url:"{{url('admin/isshow')}}",
                 data:{is_show:is_show,id:id},
                 type:'get',
                 dataType:'json',
                 success:function(res){
                     console.log(res);
                 }
             })
         });
 </script>
@endsection