	@extends('layouts.admin')
	@section('content')
<html>
	<h3>类型模块-类型展示</h3>
	<body>
		<table class="table table-bordered table-striped form-horizontal">
			<tr>
				<td class="mail-subject"><input type="checkbox" class="i-checks"  id="all">全选</td>
                <td class="mail-ontact">属性</td>
                <td class="mail-subject">类型</td>
			</tr>
			@foreach($res as $k=>$v)
              <tr class="read">
                        <td class="check-mail">
                            <input type="checkbox" class="i-checks" a_id="{{$v['a_id']}}" name="interest">{{$v['a_id']}}
                        </td>
                        <td class="mail-ontact">
                        	{{$v['a_name']}}
                        </td>
                        <td class="mail-subject">
                        	{{$v['type_name']}}
                        </td>
              </tr>              
            @endforeach
		</table>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="button" value="删除" id="del">
	</body>
</html>
<script>
    $(function () {
// alert(111);
        $('#all').click(function() {
            // console.log($(this).prop('checked'));
            var bAll = $(this).prop('checked');
            if (bAll) {
                //全选
                $('tbody tr').addClass('selected');
                $('tbody :checkbox').prop('checked', true);
            } else {
                //全不选
                $('tbody tr').removeClass('selected');
                $('tbody :checkbox').prop('checked', false);
            }
        })
        $('#del').click(function () {
            // alert(111);
            var id =[];//定义一个数组
            $('input[name="interest"]:checked').each(function(){//遍历每一个名字为interest的复选框，其中选中的执行函数
                id.push($(this).attr('a_id'));//将选中的值添加到数组chk_value中
            });
            // console.log(id);
            $.ajax({
                url:"/admin/attrdel",
                data:{id:id},
                type:'get',
                dataType:'json',
                success:function(res){
                    if(res.code==200){
                    	alert(res.img);
                    	location.href="/admin/typelist";
                    }else{
                    	alete(res.img);
                    }
                }
            })

        })
    })
</script>

@endsection