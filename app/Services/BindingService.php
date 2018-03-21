<?php

namespace App\Services;
use Illuminate\Support\Facades\Route;
use App\User;

class BindingService
{
    static function binding(){
        $binding = [];
        if(session()->has('user_email')){
            $user_result = User::where(['email'=>session('user_email')])->firstOrFail();
            $binding['dropItems']['material'] = ['url'=>url('material'),'title'=>'材料申請'];
            if($user_result->type == 'A' || $user_result->type == 'R'){
                $binding['dropItems']['manager'] = ['url'=>url('managerClass'),'title'=>'管理教室'];
                $binding['dropItems']['verificationUser'] = ['url'=>url('verificationUser'),'title'=>'管理帳戶'];
                $binding['dropItems']['addMaterial'] = ['url'=>url('material/manager'),'title'=>'管理材料'];
            }
            if($user_result->type == 'R'){
                $binding['dropItems']['materialRecord'] = ['url'=>url('manager/material/record'),'title'=>'管理申請'];
                $binding['dropItems']['purchase'] = ['url'=>'manager/purchase','title'=>'管理倉庫'];
            }
        }
        return $binding;
    }
}