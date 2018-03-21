@extends('layout') 
@section('title','管理申請') 

 
@section('content')
    @include('components.validatorErrorMessage')
    <div class="card w-100">
        <div class="card-body">
            <h5 class="card-title">管理申請</h5>
            <table class="rwd-table">
                <tr>
                    <th>專業教室</th>
                    <th>材料類別</th>
                    <th>申請老師</th>
                    <th>老師信箱</th>
                    <th>領用日期</th>
                    <th>詳細資訊</th>
                </tr>
                @foreach ($stock as $item)
                    <tr>
                        <td data-th="專業教室">{{$item['class_name']}}</td>
                        <td data-th="材料類別">{{$item['category']}}</td>
                        <td data-th="申請老師">{{$item['name']}}</td>
                        <td data-th="老師信箱">{{$item['email']}}</td>
                        <td data-th="領用日期">{{$item['date']}}</td>
                        <td data-th="詳細資訊">
                            <a href="{{URL('/manager/stock/update/'.$item['id'])}}" class="btn btn-success">查看/修改</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection