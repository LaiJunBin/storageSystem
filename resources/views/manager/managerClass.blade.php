@extends('layout') 
@section('title','新增教室') 

 
@section('content')
    @include('components.validatorErrorMessage')
    <div class="card w-100">
        <div class="card-body">
            <h5 class="card-title">新增教室</h5>
            <form action="{{ url('/addClass') }}" method="post">
                {{csrf_field()}}
                <label for="username">請輸入教室名稱：</label>
                <input required class="form-control" type="text" name="class_name" placeholder="請輸入教室名稱" value="{{old('className')}}">
                <button type="submit" class="btn btn-success">新增</button>
            </form>
        </div>
    </div><br>
    <div class="card w-100">
        <div class="card-body">
            <h5 class="card-title">管理教室</h5>
            @forelse ($classItems as $cls)
                <div class="card w-100">
                    <div class="card-body">
                        {{$cls['class_name']}}
                        <a href="{{URL('managerClass/update/'.$cls['id'])}}" class="btn btn-info">修改</a>
                        <form action="{{URL('managerClass/delete/'.$cls['id'])}}" class="deleteForm" method="post" style="display: inline;vertical-align: super;">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button class="btn btn-danger" type="submit" style="width:auto;">刪除</button>
                            <script>
                                $(".deleteForm").on('submit',function(){
                                    return confirm('確定刪除嗎?');
                                });
                            </script>
                        </form>
                    </div>
                </div>
            @empty
                <div class="alert alert-warning" role="alert">
                    沒有任何教室。
                </div>
            @endforelse
        </div>
    </div>
    <script>
        $(function(){
            $('input[name=class_name]').focus();
        });
    </script>
@endsection