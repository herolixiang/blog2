@extends('layouts.admin')

@section('content')
<h3>货品添加</h3>
<form action='{{url("/admin/skuadd_do")}}' method="post">
  @csrf
  <table width="100%" id="table_list" class='table table-bordered'>
    <tbody>
    <tr>
      <th colspan="20" scope="col">商品名称：{{$arr['goods_name']}}<input type="hidden" name="goods_id" value="{{$arr['goods_id']}}"> &nbsp;&nbsp;&nbsp;&nbsp;货号:</th>
    </tr>

    <tr>
      <!-- start for specifications -->
     @foreach ($spec as $k => $v)
        <td scope="col"><div align="center"><strong>{{$v[0]['a_name']}}</strong></div></td>
         <input type="hidden" name="a_name[]" value="{{$v[0]['a_name']}}">
     @endforeach
     <!--  <td scope="col"><div align="center"><strong>颜色</strong></div></td> -->
            <!-- end for specifications -->
      <td class="label_2">货号</td>
      <td class="label_2">库存</td>
      <td class="label_2">&nbsp;</td>
    </tr>
    
    <tr id="attr_row">
      <!-- start for specifications_value -->
    @foreach ($spec as $k => $v)
    <td align="center" style="background-color: rgb(255, 255, 255);">
      <select name="attr[]">
        <option value="" selected="">请选择...</option>
        @foreach ($v as $kk => $vv)
        <option value="{{$vv['attr_value']}}">{{$vv['attr_value']}}</option>
        @endforeach
      </select>
    </td>
   @endforeach
  <!--  <td align="center" style="background-color: rgb(255, 255, 255);">
      <select name="attr[214][]">
        <option value="" selected="">请选择...</option>
          <option value="土豪金">土豪金</option>
          <option value="太空灰">太空灰</option>
      </select>
    </td> -->
      <!-- end for specifications_value -->
    <td class="label_2" style="background-color: rgb(255, 255, 255);"><input type="text" name="product_sn[]" value="" size="20"></td>
    <td class="label_2" style="background-color: rgb(255, 255, 255);"><input type="text" name="product_number[]" value="1" size="10"></td>
    <td style="background-color: rgb(255, 255, 255);"><input type="button" class="button" value="+"></td>
    </tr>
        <script>
            // $(document).on('change',"[name=t_id]",function () {
            $(document).on('click','.button',function () {
                // alert(11);
                var plus= $(this).val();
                console.log(plus);
                if (plus=="+") {
                    // alert(111);
                    $(this).val('-');
                    var tr = $(this).parents('#attr_row');
                    var tr_clone = tr.clone();
                    // console.log(tr_clone);
                    $(this).val('+');
                    //
                    tr.after(tr_clone);
                }else{
                    // alert(11);
                    var tr = $(this).parents('#attr_row');
                    tr.remove();
                }
            })
        </script>
    <tr>
      <td align="center" colspan="5" style="background-color: rgb(255, 255, 255);">
        <input type="submit" class="button" value=" 保存 ">
      </td>
    </tr>
  </tbody>
</table>
</form>
@endsection