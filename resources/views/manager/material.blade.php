@extends('layout') 
@section('title','管理材料') 

 
@section('content')
    @include('components.validatorErrorMessage')
    <div class="card w-100">
        <div class="card-body">
            <h5 class="card-title">新增材料</h5>
            <form action="{{ url('/material/manager') }}" method="post">
                {{csrf_field()}}
                <label for="item">請輸入材料名稱：</label>
                <input required class="form-control" type="text" name="item" placeholder="請輸入材料名稱">
                <label for="unit">請輸入材料單位：</label>
                <input required class="form-control" type="text" name="unit[]" placeholder="請輸入材料單位">
                次單位：
                <div id="unitDiv">
                    
                </div>
                <button type="button" class="btn btn-info" id="addUnitBtn">新增次單位</button>
                <button type="submit" class="btn btn-success">新增材料</button>
            </form>
        </div>
    </div><br>
    <div class="card w-100">
        <div class="card-body">
            <h5 class="card-title">管理材料</h5>
            <div class="card-deck">
            @forelse ($material as $item)
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{$item['item']}}</h5>
                        <a href="{{URL('material/update/'.$item['id'])}}" class="btn btn-info">修改</a>
                        <form id="delete_form" action="{{URL('material/delete/'.$item['id'])}}" method="post" style="display: inline;vertical-align: super;">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button class="btn btn-danger" type="submit" style="width:auto;">刪除</button>
                        </form>
                    </div>
                </div>
                @if ($loop->index %4 == 3)
                    </div>
                    <div class="card-deck">
                @endif
            @empty
                <div class="alert alert-warning" role="alert">
                    沒有任何材料。
                </div>
            @endforelse
            </div>
        </div>
    </div>
    <script>
        $(function(){
            var n = 0;
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
            $("#delete_form").on('submit',function(){
                if(!confirm('確定刪除嗎?'))
                    return false;
            });
        });
    </script>
@endsection