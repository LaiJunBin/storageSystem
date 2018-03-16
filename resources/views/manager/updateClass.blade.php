@extends('layout') 
@section('title','新增教室') 

 
@section('content')
    @include('components.validatorErrorMessage')
    <div class="card w-100">
        <div class="card-body">
            <h5 class="card-title">修改教室名稱</h5>
            原名稱:{{$classSet->class_name}}
            <form action="{{URL('managerClass/update/'.$classSet->id)}}" method="post">
                {{csrf_field()}}
                {{method_field('PUT')}}
                <label for="username">請輸入新教室名稱：</label>
                <input class="form-control" type="text" name="class_name" placeholder="請輸入教室名稱" value="{{old('className')}}">
                <button type="submit" class="btn btn-warning">修改</button>
            </form>
        </div>
    </div>
@endsection