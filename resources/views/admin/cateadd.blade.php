    @extends('layouts.admin')
    @section('content')
<div class="wrapper wrapper-content animated fadeInRight">
            <div class="col-sm-6">
                                <h1>分类添加</h1>
                                <form action="/admin/cateadd_do">
                                    <div class="form-group">
                                        <label>分类名字</label>
                                        <input type="type" class="form-control" name="cate_name" id="cate_name">
                                    </div>
                                    <div class="form-group">
                                        <label>上级分类</label>
                                        <select name="cate_pid" id="">
                                            <option value="0">顶级分类</option>
                                            @foreach($cate as $v)
                                                <option value="{{$v['cate_id']}}" >@php echo str_repeat("&nbsp;&nbsp;&nbsp;",$v['level'])@endphp {{$v['cate_name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div id="attr">
                                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" id="btn" ><strong>添 加</strong>
                                        </button>
                                    </div>
                                </form>
            </div>
        </div>
<script>
        $('#cate_name').blur(function() {
            // alert(111);
            var cate_name = $('#cate_name').val();
            // console.log(cate_name);
            var _this = $(this);
            $.ajax({
                url:"/admin/nameOnly",
                data:{cate_name:cate_name},
                type:'get',
                dataType:'json',
                success:function(res){
                    // console.log(res);
                    if (res.font==2){
                        alert('该分类名可以使用');
                        $("#btn").prop('disabled',true);
                    }else{
                        alert('该分类名已被占用');
                        $("#btn").prop('disabled',false);
                    }
                }
            })
        })
    </script>
@endsection
