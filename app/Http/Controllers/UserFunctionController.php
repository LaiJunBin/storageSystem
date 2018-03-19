<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BindingService;
use App\ClassName;
use App\User;
use App\Material;
use Validator;
use App\MaterialType;
use App\Stock;


class UserFunctionController extends Controller
{
    public function material(){
        $binding = BindingService::binding();
        $binding['classNames'] = ClassName::get()->pluck('class_name')->toarray();
        $binding['materialType'] = MaterialType::get()->pluck('type')->toarray();
        $binding['material'] = Material::get()->toarray();
        $binding['material'] = array_map(function($x){
            $x['unit'] = unserialize($x['unit']);
            return $x;
        },$binding['material']);
        return view('userFunction.material',$binding);
    }

    public function materialProcess(){
        $input = Request()->all();
        $rules = [
            'date'=>[
                'required',
                'date',
                'after:'.date("Y/m/d", mktime(0, 0, 0, date('m'), date('d')-1, date('Y'))),
            ]
        ];
        $validator = Validator::make($input,$rules);
        if($validator->fails()){
            return redirect('/material')->withErrors($validator)->withInput();
        }
        $input['item']['amount'] = array_map(function($x){
            return $x==null?0:$x;
        },$input['item']['amount']);
        $input['item'] = serialize($input['item']);
        $input['email'] = session('user_email');
        $input['name'] = session('user_name');
        Stock::create($input);
        return redirect('/');
    }
}
