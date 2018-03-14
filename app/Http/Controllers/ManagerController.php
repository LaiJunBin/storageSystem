<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BindingService;
use App\ClassName;
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
}
