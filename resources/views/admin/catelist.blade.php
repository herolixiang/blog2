	@extends('layouts.admin')
	@section('content')
<html>
	<h3>分类模块-分类展示</h3>
	<body>
		<table class="table table-bordered table-striped form-horizontal">
			<tr>
				<td>ID</td>
				<td>商品类型名称</td>
				<td>商品数量</td>
			</tr>
			@foreach($cate as $k=>$v)
                            <tr >
                                <td>
                                    {{$v['cate_id']}}
                                </td>
                                <td>@php echo str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$v['level'])@endphp {{$v['cate_name']}}</td>
                                <td>{{$v['cate_count']}}</td>
                            </tr>
             @endforeach
		</table>
	</body>
</html>
@endsection