<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BindingService;
use App\ClassName;
use App\User;

class UserFunctionController extends Controller
{
    public function material(){
        $binding = BindingService::binding();
        $binding['classNames'] = ClassName::get()->pluck('class_name')->toarray();
        return view('userFunction.material',$binding);
    }
}
