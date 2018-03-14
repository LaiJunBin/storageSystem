<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BindingService;
use App\ClassName;

class MainController extends Controller
{
    public function index(){
        $binding = BindingService::binding();
        $className_result = ClassName::get();
        $binding['classNames'] = $className_result->pluck('class_name')->toarray();
        $binding['classNumbers'] = $className_result->pluck('id')->toarray();
        return view('index',$binding);
    }
}
