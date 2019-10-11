    @extends('layouts.admin')
    @section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="col-sm-6">
        <h1>类型添加</h1>
            <form action="/admin/typeadd_do">
                    <div class="form-group">
                        <label>类型名字</label>
                        <input type="type" class="form-control" name="type_name" id="type_name">
                    </div>
                   
                    <div id="attr">
                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" id="btn" >     <strong>添 加</strong>
                        </button>
                    </div>
            </form>
    </div>
</div>
<script src="{{asset('/admin/js/jquery.min.js')}}"></script>
<script>
    $('#cate_name').blur(function() {
            // alert(111);die;
            var type_name = $('#type_name').val();
            // console.log(cate_name);
            var _this = $(this);
            $.ajax({
                url:"/typeadd_do",
                data:{type_name:type_name},
                dataType:'json',
                success:function(res){
                    console.log(res);
                }
            })
        })
</script>
@endsection