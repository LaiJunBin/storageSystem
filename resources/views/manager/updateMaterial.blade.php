@extends('layout') 
@section('title','修改材料') 

 
@section('content')
    @include('components.validatorErrorMessage')
    <div class="card w-100">
        <div class="card-body">
            <h5 class="card-title">修改材料</h5>
            <form action="{{URL('material/update/'.$material['id'])}}" method="post">
                {{csrf_field()}}
                {{method_field('PUT')}}
                <label for="type">材料種類</label>
                <input type="checkbox" class="materialTypeCheckbox" checked>從現有類別選取
                <input type="checkbox" class="materialTypeCheckbox">新增種類
                <div class="materialTypeInput">
                    <select name="type" class="form-control" required>
                        @forelse ($material_type as $type)
                            <option value="{{$type}}" @if ($type == $material['type'])
                                selected
                            @endif>{{$type}}</option>
                        @empty
                            <option value="nothing" disabled>沒有任何類別</option>                    
                        @endforelse
                    </select>
                    <input value="{{$material['type']}}" type="hidden" name="prototype_type">
                    <input placeholder="輸入種類" value="{{$material['type']}}" disabled type="text" name="type" style="display:none;" class="form-control">
                </div>
                <label for="item">請輸入新材料名稱：</label>
                <input class="form-control" type="text" name="item" placeholder="請輸入材料名稱" value="{{$material['item']}}">
                單位：
                <br>
                @foreach ($material['unit'] as $unit)
                    <div id="secondUnit{{$loop->index}}" style="margin:10px 0;">
                        <input required class="form-control" type="text" name="unit[]" value="{{$unit}}" placeholder="請輸入材料單位">
                        @if (!$loop->first)
                            <button type="button" id="removeSecondDiv{{$loop->index}}" class="btn btn-danger">刪除單位</button>
                        @endif
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


            $(".materialTypeCheckbox").click(function(){
                var index = $(".materialTypeCheckbox").index(this);
                $(".materialTypeCheckbox").prop('checked',false);
                $(this).prop('checked',true);
                $('.materialTypeInput .form-control').prop('disabled',true).hide();
                $('.materialTypeInput .form-control').eq(index).prop('disabled',false).fadeIn();
            });
        })
    </script>
@endsection