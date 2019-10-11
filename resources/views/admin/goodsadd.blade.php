	@extends('layouts.admin')
	@section('content')
	<h3>商品添加</h3>
	<ul class="nav nav-tabs">
	  <li role="presentation" class="active"><a href="javascript:;" name='basic'>基本信息</a></li>
	  <li role="presentation" ><a href="javascript:;" name='attr'>商品属性</a></li>
	  <li role="presentation" ><a href="javascript:;" name='detail'>商品详情</a></li>
	</ul>
	<br>
	<form action='{{url("/admin/goodsadd_do")}}' method="POST" enctype="multipart/form-data" id='form'>
		@csrf
		<div class='div_basic div_form'>
			<div class="form-group">
				<label for="exampleInputEmail1">商品名称</label>
				<input type="text" class="form-control" name='goods_name'>
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">商品分类</label>
				<select class="form-control" name='cate_id'>
					<option value='0'>请选择</option>
					@foreach($cateData as $v)
						<option value='{{$v["cate_id"]}}'>{{$v["cate_name"]}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">商品货号</label>
				<input type="text" class="form-control" name='goods_nb'>
			</div>

			<div class="form-group">
				<label for="exampleInputEmail1">商品价钱</label>
				<input type="text" class="form-control" name='goods_price'>
			</div>

			<div class="form-group">
				<label for="exampleInputFile">商品图片</label>
				<input type="file" name='img'>
			</div>
		</div>	
		<div class='div_detail div_form' style='display:none'>
			<div class="form-group">
				<label for="exampleInputFile">商品详情</label>
				<textarea class="form-control" rows="3" name="content"></textarea>
			</div>
		</div>
		<div class='div_attr div_form' style='display:none'>
			<div class="form-group">
				<label for="exampleInputEmail1">商品类型</label>
				<select class="form-control" name='type_id' >
					<option>请选择</option>
					@foreach($typeData as $v)
						<option value='{{$v["type_id"]}}'>{{$v["type_name"]}}</option>
					@endforeach
				</select>
			</div>	
			<br>

			<table width="100%" id="attrTable" class='table table-bordered'>
				<!-- <tr>
					<td>前置摄像头</td>
					<td>
						<input type="hidden" name="attr_id_list[]" value="211">
						<input name="attr_value_list[]" type="text" value="" size="20">  
						<input type="hidden" name="attr_price_list[]" value="0">
					</td>
				</tr>
				<tr>
					<td><a href="javascript:;">[+]</a>颜色</td>
					<td>
						<input type="hidden" name="attr_id_list[]" value="214">
						<input name="attr_value_list[]" type="text" value="" size="20"> 
						属性价格 <input type="text" name="attr_price_list[]" value="" size="5" maxlength="10">
					</td>
				</tr> -->
			</table>
			<!-- <div class="form-group">
					颜色:
					<input type="text" name='attr_value_list[]'>
			</div> -->
			<!-- <div class="form-group" style='padding-left:26px'>
				<a href="javascript:;">[+]</a>内存:
				<input type="text" name='attr_value_list[]'>
				属性价格:<input type="text" name='attr_price_list[][]'>
			</div> -->
			
		</div>

	  <button type="submit" class="btn btn-default" id='btn'>添加</button>
	</form>

	<script type="text/javascript">
		//标签页 页面渲染
		$(".nav-tabs a").on("click",function(){
			$(this).parent().siblings('li').removeClass('active');
			$(this).parent().addClass('active');
			var name = $(this).attr('name');  // attr basic
			$(".div_form").hide();
			$(".div_"+name).show();  // $(".div_"+name)
		})	

		$("[name='type_id']").on('change',function(){
			//获取被选中的value值
			var type_id=$(this).val();
			// alert(type_id);die;
			$.ajax({
				url:"{{url('admin/goodsAttr')}}",
				data:{type_id:type_id},
				dataType:"json",
				success:function(res){
					// console.log(res);
					$("#attrTable").empty();
					//res有个数据 在table添加几个tr
					$.each(res,function(i,v){
						if (v.atbe == '1'){
							//普通属性 参数
							var tr= $("<tr></tr>");  //构建一个空对象
							var tr ="<tr>\n" +
                                "                    <td>"+v.a_name+"</td>\n" +
                                "                    <td>\n" +
                                "                        <input type=\"hidden\" name=\"attr_id_list[]\" value="+v.a_id+">\n" +
                                "                        <input name=\"attr_value_list[]\" type=\"text\" value=\"\" size=\"20\">\n" +
                                "                        <input type=\"hidden\" name=\"attr_price_list[]\" value=\"0\">\n" +
                                "                    </td>\n" +
                                "                </tr>\n" +
                                "                <tr>";
								$("#attrTable").append(tr);

						}else{
							var tr= $("<tr></tr>");  //构建一个空对象
							//可选属性 规格
							var tr ="<tr>\n" +
                                "                    <td><a href=\"javascript:;\" class=\"addRow\">[+]</a>"+v.a_name+"</td>\n" +
                                "                    <td>\n" +
                                "                        <input type=\"hidden\" name=\"attr_id_list[]\" value="+v.a_id+">\n" +
                                "                        <input name=\"attr_value_list[]\" type=\"text\" value=\"\" size=\"20\">\n" +
                                "                        属性价格 <input type=\"text\" name=\"attr_price_list[]\" value=\"\" size=\"5\" maxlength=\"10\">\n" +
                                "                    </td>\n" +
                                "                </tr>";
								$("#attrTable").append(tr);
						}
					});
				}
			})
		})


		//点击+ - 号
		$(document).on('click','.addRow',function(){
			// alert(1);
			//如果点击+号
			var val=$(this).html();
			if (val == "[+]"){
				//复制之前 先把+ = > -
				$(this).html("[-]");
				//jquery clone 复制当前
				var tr_clone =$(this).parent().parent().clone();
				$(this).parent().parent().after(tr_clone);
				//复制之后 - = > +
				$(this).html("[+]");
			}else{
				$(this).parent().parent().remove();
			};
		});
	</script>
@endsection