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
            if($user_result->type == 'A'){
                $binding['dropItems']['manager'] = ['url'=>url('managerClass'),'title'=>'管理教室'];
                $binding['dropItems']['verificationUser'] = ['url'=>url('verificationUser'),'title'=>'驗用帳戶'];
                $binding['dropItems']['addMaterial'] = ['url'=>url('material/manager'),'title'=>'管理材料'];
            }else{
                $binding['dropItems']['material'] = ['url'=>url('material'),'title'=>'材料申請'];
            }
        }
        return $binding;
    }
}