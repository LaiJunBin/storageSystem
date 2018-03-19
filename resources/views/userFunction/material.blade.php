@extends('layout') 
@section('title','材料申請') 

@section('content')
    @include('components.validatorErrorMessage')
    <div class="card text-center">
        <div class="card-body">
            <h2>穀保家商餐飲管理科</h2>
            <h2>公共材料申請/領用單</h2>
            <form action="material" method="post">
                {{csrf_field()}}
                <table class="rwd-table">
                    <tr>
                        <th>申請日期</th>
                        <td data-th="申請日期">
                            {{ date('Y/m/d') }}
                        </td>
                        <th>領用日期</th>
                        <td data-th="領用日期"><input class="form-control" value="{{old('date')}}" required type="date" name="date"></td>
                    </tr>
                    <tr>
                        <th>專業教室</th>
                        <td data-th="專業教室">
                            <select class="form-control" name="class_name">
                                @forelse ($classNames as $cls)
                                    <option value="{{$cls}}" @if ($cls==old('className'))
                                        selected
                                    @endif>{{$cls}}</option>
                                @empty
                                    <option value="no" disabled>沒有教室</option>
                                @endforelse
                            </select>
                        </td>
                        <th>管理教師</th>
                        <td data-th="管理教師">{{session('user_name')}}</td>
                    </tr>
                    <tr>
                        <th>材料種類</th>
                        <td data-th="材料種類" colspan="3">
                            <select name="category" class="form-control">
                                @foreach ($materialType as $type)
                                    <option value="{{$type}}" @if ($type==old('category'))
                                        selected
                                    @endif>{{$type}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                </table>
                <table class="rwd-table">
                    <tr>
                        <th>材料名稱</th>
                        <th>數量</th>
                        <th>單位</th>
                        <th>材料名稱</th>
                        <th>數量</th>
                        <th>單位</th>
                    </tr>
                    @for ($i = 0; $i < count($material); $i+=2)
                        <tr>
                            @for ($j = 0; $j <= 1; $j++)
                                @if ($i+$j<count($material))
                                    <td data-th="材料名稱">{{$material[$i+$j]['item']}}</td>
                                    <td data-th="數量">
                                        {{-- {{'item[amount]['.$material[$i+$j]['id'].']'}} --}}
                                        <input type="number" name="item[amount][{{$material[$i+$j]['id']}}]" class="form-control" @if (count(old())>0)
                                            value = {{old()['item']['amount'][$material[$i+$j]['id']]}}
                                        @endif>
                                    </td>
                                    <td data-th="單位" width="25%">
                                        <select name="item[unit][{{$material[$i+$j]['id']}}]" class="form-control">
                                            @forelse ($material[$i+$j]['unit'] as $unit)
                                                <option value="{{$unit}}" @if (count(old())>0 && $unit == old()['item']['unit'][$material[$i+$j]['id']])
                                                    selected
                                                @endif>{{$unit}}</option>
                                            @empty
                                                <option value="nothing" disabled>沒有單位</option>
                                            @endforelse
                                        </select>
                                    </td>   
                                @endif
                            @endfor
                        </tr>
                    @endfor
                </table>
                <button type="submit" class="btn btn-success">送出申請</button>
            </form>
        </div>
    </div>
@endsection