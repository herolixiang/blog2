	@extends('layouts.admin')
	@section('content')
<html>
	<h3>类型模块-类型展示</h3>
	<body>
		<table class="table table-bordered table-striped form-horizontal">
			<tr>
				<td>ID</td>
				<td>商品类型名称</td>
				<td>属性值</td>
				<td>操作</td>
			</tr>
			@foreach($data as $k=>$v)
                            <tr >
                                <td>{{$v['type_id']}}</td>
                               	<td>{{$v['type_name']}}</td>
                               	<td>{{$v['attr_num']}}</td>
                               	<td>
                               		<a href="/admin/attrlist?type_id={{$v['type_id']}}">属性列表</a>
                               	</td>
                            </tr>
             @endforeach
		</table>
	</body>
</html>
@endsection