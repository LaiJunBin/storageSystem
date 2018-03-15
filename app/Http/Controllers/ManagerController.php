<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BindingService;
use App\ClassName;
use App\User;

class ManagerController extends Controller
{
    public function addClass(){
        $binding = BindingService::binding();
        return view('manager.addClass',$binding);
    }

    public function addClassProcess(){
        $input = Request()->all();
        ClassName::create($input);
        return redirect('/');
    }

    public function verificationUser(){
        $user_query = User::where(['type'=>'F'])->get();
        $binding = BindingService::binding();
        $binding['verificationUsers'] = $user_query->toarray();
        return view('manager/verificationUser',$binding);
    }
}
