@extends('layout') 
@section('title','管理材料') 

 
@section('content')
    @include('components.validatorErrorMessage')
    <div class="card w-100">
        <div class="card-body">
            <h5 class="card-title">新增材料</h5>
            <form action="{{ url('/material/manager') }}" method="post">
                {{csrf_field()}}
                <label for="type">材料種類</label>
                <input type="checkbox" class="materialTypeCheckbox" checked>從現有類別選取
                <input type="checkbox" class="materialTypeCheckbox">新增種類
                <div class="materialTypeInput">
                    <select name="type" class="form-control" required>
                        @forelse ($material_type as $type)
                            <option value="{{$type}}">{{$type}}</option>
                        @empty
                            <option value="nothing" disabled>沒有任何類別</option>                    
                        @endforelse
                    </select>
                    <input placeholder="輸入種類" disabled type="text" name="type" style="display:none;" class="form-control">
                </div>
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
            <h5 class="card-title">管理材料
                <button class="btn btn-warning" id="searchMaterialBtn">篩選</button>
            </h5>
            <div id="cardGroup">
            @forelse ($material as $item)
                <div class="card" type="{{$item['type']}}">
                    <div class="card-body">
                        <h5 class="card-title">{{$item['item']}}</h5>
                        <a href="{{URL('material/update/'.$item['id'])}}" class="btn btn-info">修改</a>
                        <form class="delete_form" action="{{URL('material/delete/'.$item['id'])}}" method="post" style="display: inline;vertical-align: super;">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <input type="hidden" name="prototype_type" value="{{$item['type']}}">
                            <button class="btn btn-danger" type="submit" style="width:auto;">刪除</button>
                        </form><br>
                        <span style="font-size:10px;">所屬類別：{{$item['type']}}</span>
                    </div>
                </div>
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
            $(".delete_form").on('submit',function(){
                if(!confirm('確定刪除嗎?'))
                    return false;
            });

            $(".materialTypeCheckbox").click(function(){
                var index = $(".materialTypeCheckbox").index(this);
                $(".materialTypeCheckbox").prop('checked',false);
                $(this).prop('checked',true);
                $('.materialTypeInput .form-control').prop('disabled',true).hide();
                $('.materialTypeInput .form-control').eq(index).prop('disabled',false).fadeIn();
            });

            $("#searchMaterialBtn").click(function(){
                if($("#searchType").length ==0 ){
                    $(this).parent().after(
                        $('.materialTypeInput select').first().clone().attr('id','searchType').css('margin-bottom','10px'));
                        $("#searchType").prepend('<option value="nothing" selected>無條件</option>');
                        $('#searchType').on('change',function(){
                            var value = $(this).find(':checked').text();
                            cardLayoutReset();
                            $("#cardGroup .card").addClass('hide');
                            if(value == '無條件'){
                                $("#cardGroup .card").removeClass('hide');
                            }else{
                                $("#cardGroup .card[type="+value+']').removeClass('hide');
                            }
                            layout();
                        });
                    $(this).prop('disabled',true);
                }
            });
            function cardLayoutReset(){
                $("#cardGroup .card").appendTo($("#cardGroup"));
                $("#cardGroup>.card-deck").remove();
            }
            function layout(){
                while($("#cardGroup>.card:not(.hide)").length>0){
                    $("#cardGroup").append('<div class="card-deck"></div>');
                    while($("#cardGroup>.card:not(.hide)").length>0 && $("#cardGroup .card-deck").last().find('.card:not(.hide)').length<4){
                        $("#cardGroup>.card:not(.hide)").first().appendTo($("#cardGroup .card-deck").last());
                    }
                }
            }
            layout();
        });
    </script>
    <style>
        .hide{
            display:none;
        }
    </style>
@endsection