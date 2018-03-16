@extends('layout') 
@section('title','材料申請') 

@section('content')
    @include('components.validatorErrorMessage')
    <div class="card text-center">
        <div class="card-body">
            <h2>穀保家商餐飲管理科</h2>
            <h2>公共材料申請/領用單</h2>
            <form action="material" method="post">
                <table width="100%">
                    <tr>
                        <td>申請日期：</td>
                        <td>
                            {{ date('Y/m/d') }}
                        </td>
                        <td>領用日期：</td>
                        <td><input class="form-control" type="date" name="date" value="{{old('date')}}"></td>
                    </tr>
                    <tr>
                        <td>專業教室：</td>
                        <td>
                            <select class="form-control" name="className">
                                @forelse ($classNames as $cls)
                                    <option value="{{$cls}}">{{$cls}}</option>
                                @empty
                                    <option value="no" disabled>沒有教室</option>
                                @endforelse
                            </select>
                        </td>
                        <td>管理教師：</td>
                        <td>{{session('user_name')}}</td>
                    </tr>
                    <tr>
                        <td>材料種類：</td>
                        <td colspan="3">
                            <input type="checkbox" name="category" value="烘焙" checked>烘焙
                            <input type="checkbox" name="category" value="西餐">西餐
                            <input type="checkbox" name="category" value="中餐">中餐
                            <input type="checkbox" name="category" value="清潔用品">清潔用品
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <script>
        $(function(){
            $("td:odd").addClass('text-left');
            $("td[colspan!=4]:even").addClass('text-right');
            $("input[type=checkbox]").click(function(){
                $("input[type=checkbox]").prop('checked',false);
                $(this).prop('checked',true);
            });
            
        });
    </script>
@endsection