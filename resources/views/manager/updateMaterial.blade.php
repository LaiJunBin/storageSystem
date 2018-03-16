@extends('layout') 
@section('title','修改材料') 

 
@section('content')
    @include('components.validatorErrorMessage')
    <div class="card w-100">
        <div class="card-body">
            <h5 class="card-title">修改材料</h5>
            <form action="{{URL('managerClass/update/'.$material['id'])}}" method="post">
                {{csrf_field()}}
                {{method_field('PUT')}}
                <label for="item">請輸入新材料名稱：</label>
                <input class="form-control" type="text" name="item" placeholder="請輸入材料名稱" value="{{$material['item']}}">
                單位：
                <br>
                @foreach ($material['unit'] as $unit)
                    <div id="secondUnit{{$loop->index}}" style="margin:10px 0;">
                        <input required class="form-control" type="text" name="unit[]" value="{{$unit}}" placeholder="請輸入材料單位">
                        <button type="button" id="removeSecondDiv{{$loop->index}}" class="btn btn-danger">刪除單位</button>
                    </div>
                @endforeach
                <div id="unitDiv">
                    
                </div>
                <button type="button" class="btn btn-info" id="addUnitBtn">新增單位</button>
                <button type="submit" class="btn btn-warning">修改</button>
            </form>
        </div>
    </div>
    <script>
        $(function(){
            var n = {{count($material['unit'])}};
            $('[id^=removeSecondDiv]').click(function(){
                $(this).parent().remove();
            });
            $("#addUnitBtn").click(function(){
                n++;
                var div = '<div id="secondUnit'+n+'" style="margin:10px 0;"></div>';
                var input = '<input required class="form-control" type="text" name="unit[]" placeholder="請輸入材料單位">';
                var btn = '<button type="button" id="removeSecondDiv' + n +'" class="btn btn-danger">刪除次單位</button>';
                $('#unitDiv').append(div);
                $('#secondUnit'+n).append(input);
                $('#secondUnit'+n).append(btn);
                $('#removeSecondDiv'+n).click(function(){
                    $(this).parent().remove();
                });
            });
            $('footer').css('position','static');
        })
    </script>
@endsection