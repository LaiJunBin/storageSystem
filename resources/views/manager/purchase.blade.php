@extends('layout') 
@section('title','進貨') 

@section('content')
    @include('components.validatorErrorMessage')
    <div class="card text-center">
        <div class="card-body">
            <h2>進貨</h2>
            <a href="{{URL('manager/purchase/record/list')}}">查看庫存</a>
            <form action="{{url('manager/purchase/')}}" method="post">
                {{csrf_field()}}
                <table class="rwd-table">
                    <tr>
                        <th width="10%">進貨日期</th>
                        <td data-th="進貨日期">
                            {{ date('Y/m/d') }}
                        </td>
                        {{-- <th>領用日期</th>
                        <td data-th="領用日期"><input class="form-control" value="{{old('date')}}" required type="date" name="date"></td> --}}
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
                            <td data-th="材料名稱">{{$item['item']}}</td>
                            <td data-th="數量">
                                {{-- {{'item[amount]['.$item['item'].']'}} --}}
                                <input type="hidden" name="item[{{$item['item']}}][name]" value="{{$item['item']}}">
                                <input type="number" name="item[{{$item['item']}}][amount]" class="form-control" @if (array_key_exists('item',old()))
                                    value = {{old()['item'][$item['item']]['amount']??''}}
                                @endif>
                            </td>
                            <td data-th="單位" width="30%">
                                <select name="item[{{$item['item']}}][unit]" class="form-control">
                                    @forelse ($item['unit'] as $unit)
                                        <option value="{{$unit}}" @if (array_key_exists('item',old()) && array_key_exists($item['item'],old()['item'][$item['item']]) && $unit == old()['item'][$item['item']]['unit'])
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
                <button type="submit" class="btn btn-success">送出申請</button>
            </form>
        </div>
    </div>
    <script>
        $(function(){
            function init(){
                layoutReset();
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
@endsection