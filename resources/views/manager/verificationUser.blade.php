@extends('layout') 
@section('title','驗證帳戶') 

 
@section('content')
    @forelse ($verificationUsers as $user)
        <div class="card w-100">
            <div class="card-body">
                <h5 class="card-title">申請於{{$user['created_at']}}</h5>
                <p class="card-text">使用者:{{$user['name']}}</p>
                <p class="card-text">信箱:{{$user['email']}}</p>
                <form action="{{url('verificationUser')}}" method="post">
                    {{csrf_field()}}
                    {{method_field('PUT')}}
                    <button type="submit" class="btn btn-primary">加入會員</button>
                </form>
                <form action="{{url('verificationUser')}}" method="post">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <button type="submit" class="btn btn-primary">刪除會員</button>
                </form>
            </div>
        </div>
    @empty
        <div class="alert alert-warning" role="alert">
            沒有任何帳戶需要審核。
        </div>
    @endforelse
    
@endsection