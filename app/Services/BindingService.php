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
                $binding['dropItems']['addClass'] = ['url'=>url('addClass'),'title'=>'新增教室'];
            }
        }
        return $binding;
    }
}