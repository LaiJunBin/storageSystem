@extends('layout') 
@section('title','新增教室') 

 
@section('content')
    @include('components.validatorErrorMessage')
    <form action="{{ url('/addClass') }}" method="post">
        {{csrf_field()}}
        <label for="username">請輸入教室名稱：</label>
        <input class="form-control" type="text" name="class_name" placeholder="請輸入教室名稱" value="{{old('className')}}">
        <button type="submit" class="btn btn-success">新增</button>
    </form>
@endsection