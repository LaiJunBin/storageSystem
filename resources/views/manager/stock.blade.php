@extends('layout') 
@section('title','更改材料') 

@section('content')
    @include('components.validatorErrorMessage')
    <div class="card text-center">
        <div class="card-body">
            <h2>穀保家商餐飲管理科</h2>
            <h2>公共材料申請/領用單 修改</h2>
            <form action="{{URL('manager/stock/update/'.$stock['id'])}}" method="post">
                {{csrf_field()}}
                {{method_field('PUT')}}
                <table class="rwd-table">
                    <tr>
                        <th>申請日期</th>
                        <td data-th="申請時間">
                            {{ $stock['created_at'] }}
                        </td>
                        <th>領用日期</th>
                        <td data-th="領用日期"><input class="form-control" value="{{$stock['date']}}" required type="date" name="date"></td>
                    </tr>
                    <tr>
                        <th>專業教室</th>
                        <td data-th="專業教室">
                            <select class="form-control" name="class_name">
                                @forelse ($classNames as $cls)
                                    <option value="{{$cls}}" @if ($cls==$stock['class_name'])
                                        selected
                                    @endif>{{$cls}}</option>
                                @empty
                                    <option value="no" disabled>沒有教室</option>
                                @endforelse
                            </select>
                        </td>
                        <th>管理教師</th>
                        <td data-th="管理教師">{{$stock['name']}}</td>
                    </tr>
                    <tr>
                        <th>材料種類</th>
                        <td data-th="材料種類" colspan="3">
                            <select name="category" class="form-control">
                                @foreach ($materialType as $type)
                                    <option value="{{$type}}" @if ($type==$stock['category'])
                                        selected
                                    @endif>{{$type}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                </table>
                <table class="rwd-table" id="materialTable">
                    <thead>
                        <th width="10%">材料名稱</th>
                        <th width="10%">數量</th>
                        <th width="30%">單位</th>
                        <th width="10%">材料名稱</th>
                        <th width="10%">數量</th>
                        <th width="30%">單位</th>
                    </thead>
                    <tbody>
                        @foreach ($material as $item)
                            <td data-th="材料名稱" class="hide" type="{{$item['type']}}">{{$item['item']}}</td>
                            <td data-th="數量" class="hide" type="{{$item['type']}}">
                                {{-- {{'item[amount]['.$item['id'].']'}} --}}
                                {{-- {{dd($item,$currentMaterial,$stock)}} --}}
                                <input type="number" name="item[amount][{{$item['id']}}]" class="form-control" @if ($item['type']==$stock['category'])
                                    value = "{{$stock['item']['amount'][$item['id']]??0}}"
                                @endif>
                            </td>
                            <td data-th="單位" width="30%" class="hide" type="{{$item['type']}}">
                                <select name="item[unit][{{$item['id']}}]" class="form-control">
                                    @forelse ($item['unit'] as $unit)
                                        <option value="{{$unit}}" @if (array_key_exists($item['id'],$currentMaterial))
                                            selected
                                        @endif>{{$unit}}</option>
                                    @empty
                                        <option value="nothing" disabled>沒有單位</option>
                                    @endforelse
                                </select>
                            </td> 
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-success">修改</button>
            </form>
        </div>
    </div>
    <script>
        $(function(){
            $('select[name=category]').on('change',init);
            function init(){
                var value = $('select[name=category]').find(':selected').text();
                layoutReset();
                $("#materialTable tbody tr td").addClass('hide').find('[name]').prop('disabled',true);
                $("#materialTable tbody tr td[type="+value+']').removeClass('hide').find('[name]').prop('disabled',false);
                layout();
            }

            function layoutReset(){
                $("#materialTable tbody").prepend('<tr></tr>');
                $("#materialTable tbody tr td").appendTo($("#materialTable tbody tr").first());
                $("#materialTable tbody tr:gt(0)").remove();
            }

            function layout(){
                while($("#materialTable tbody tr").first().find('td:not(.hide)').length>=3){
                    $("#materialTable tbody").append("<tr></tr>");
                    while($("#materialTable tbody tr").first().find('td:not(.hide)').length>=3 && $("#materialTable tbody tr").last().find('td').length<6){
                        $("#materialTable tbody tr").first().find("td:not(.hide):lt(3)").appendTo($("#materialTable tbody tr").last());
                    }
                }
            }
            init();
        });
    </script>
    <style>
        .hide{
            display:none !important;
        }
    </style>
@endsection