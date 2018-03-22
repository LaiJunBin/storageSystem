@extends('layout') 
@section('title','庫存') 

@section('content')
    {{-- @include('components.validatorErrorMessage')
    <div class="card text-center">
        <div class="card-body">
            <h2>日期查詢</h2>
            <input type="checkbox" class="searchCheckbox" value="依照月份查詢" checked>依照月份查詢
            <input type="checkbox" class="searchCheckbox" value="自訂區間查詢" >自訂區間查詢
            <div id="searchPatternDiv">
                <form action="#" method="post" id="searchForm">
                    {{csrf_field()}}
                    <div class="inputDiv">
                        <input name="date[]" type="month" required class="form-control">
                    </div>
                    <div class="inputDiv" style="display:none;">
                        日期A：<input name="date[]" disabled required type="date" class="form-control">
                        日期B：<input name="date[]" disabled required type="date" class="form-control">
                    </div>
                    <button type="submit" id="searchBtn" class="btn btn-success" style="width:100%;margin:10px 0;">查詢</button>
                </form>
            </div>
        </div>
    </div> --}}
    <div class="card text-center">
        <div class="card-body">
            <h2>庫存量</h2>
            <a href="{{URL('manager/purchase/')}}">進貨</a>
            @if (count($records)==0)
                <div class="alert alert-warning">沒有庫存</div>
            @else
                <table class="rwd-table">
                    <th>材料</th>
                    <th>剩餘數量</th>
                    <th>單位</th>
                    @foreach ($records as $record)
                        <tr>
                            <td data-th="材料">{{$record['item']}}</td>
                            <td data-th="剩餘數量">{{$record['amount']}}</td>
                            <td data-th="單位">{{$record['unit']}}</td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
    </div>
    {{-- <script>
        $(function(){
            $(".searchCheckbox").click(function(){
                $('.searchCheckbox').prop('checked',false);
                $(this).prop('checked',true);
                var index = $('.searchCheckbox').index(this);
                $('#searchPatternDiv .inputDiv').hide();
                $('#searchPatternDiv .inputDiv input').prop('disabled',true);
                $('#searchPatternDiv .inputDiv').eq(index).fadeIn();
                $('#searchPatternDiv .inputDiv').eq(index).find('input').prop('disabled',false);
            });
        });
    </script> --}}
@endsection