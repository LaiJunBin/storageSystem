@extends('layout') 
@section('title','驗證帳戶') 

 
@section('content')
    <style>
        .operationBoard{
            display:none;
        }
    </style>
    選擇操作類型：
    <select id="selectType" class="form-control" style="margin-bottom:10px;">
        <option value="驗證帳戶" @if (session('selected')==0)
            selected
        @endif>驗證帳戶</option>
        <option value="管理帳戶" @if (session('selected')=='1')
            selected
        @endif>管理帳戶</option>
    </select>
    <div class="operationBoard">
        @forelse ($verificationUsers as $user)
            <div class="card w-100">
                <div class="card-body">
                    <h5 class="card-title">申請於{{$user['created_at']}}</h5>
                    <p class="card-text">使用者:{{$user['name']}}</p>
                    <p class="card-text">信箱:{{$user['email']}}</p>
                    <form action="{{url('verificationUser/'.$user['email'])}}" method="post">
                        {{csrf_field()}}
                        {{method_field('PUT')}}
                        <button type="submit" class="btn btn-primary">加入會員</button>
                    </form>
                    <form class="deleteForm" action="{{url('verificationUser/delete/'.$user['email'])}}" method="post">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button type="submit" class="btn btn-danger">刪除會員</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="alert alert-warning" role="alert">
                沒有任何帳戶需要審核。
            </div>
        @endforelse
    </div>
    <div class="operationBoard">
        @if (count($users)>0)
            A = Admin(管理員)，G = General(普通帳號)
        @endif
        @forelse ($users as $user)
            <table class="rwd-table">
                <tr>
                    <th>權限</th>
                    <th>名字</th>
                    <th>信箱</th>
                    <th>操作</th>
                </tr>
                <tr>
                    <td data-th="權限">{{$user['type']}}</td>
                    <td data-th="名字">{{$user['name']}}</td>
                    <td data-th="信箱">{{$user['email']}}</td>
                    <td data-th="操作">
                        <form action="{{url('verificationUser/toggleType/'.$user['id'])}}" method="post">
                            {{csrf_field()}}
                            {{method_field('PUT')}}
                            <button type="submit" class="btn btn-info">
                                {{($user['type']=='G')?"變更為管理員":"變更為普通帳號"}}
                            </button>
                        </form>
                        <form class="deleteForm" action="{{url('verificationUser/user/delete/'.$user['id'])}}" method="post">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button type="submit" class="btn btn-danger">
                                刪除帳號
                            </button>
                        </form>
                    </td>
                </tr>
            </table>
        @empty
            <div class="alert alert-warning" role="alert">
                沒有任何帳戶。
            </div>
        @endforelse
    </div>
    <script>
        $(function(){
            function changeContent(){
                var index = $('#selectType').find(':selected').index();
                $(".operationBoard").hide();
                $(".operationBoard").eq(index).fadeIn();
            }
            $("#selectType").on('change',changeContent);
            $('.deleteForm').on('submit',function(){
                return confirm('確定刪除這個帳號嗎?');
            });
            changeContent();
        });
    </script>
@endsection