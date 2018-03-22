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
use App\StockAll;

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
        if(count(array_unique($input['item']['amount']))==1 && array_values($input['item']['amount'])[0]==0){
            return redirect('/material')->withErrors('至少要申請一種材料')->withInput();
        }
        $errorMsg = [];
        foreach(array_keys($input['item']['amount']) as $key){
            $item = Material::where('id',$key)->first()->item;
            $amount = StockAll::where([
                ['item',$item],
                ['unit',$input['item']['unit'][$key]]
            ])->first()->amount;
            if($input['item']['amount'][$key]>$amount){
                array_push($errorMsg,$item."超過庫存量!");
            }
        }
        if(count($errorMsg)>0){
            return redirect('/material')->withErrors($errorMsg)->withInput();
        }
        foreach(array_keys($input['item']['amount']) as $key){
            $item = Material::where('id',$key)->first()->item;
            StockAll::where([
                ['item',$item],
                ['unit',$input['item']['unit'][$key]]
            ])->update([
                'amount' => StockAll::where([
                    ['item',$item],
                    ['unit',$input['item']['unit'][$key]]
                ])->first()->amount-$input['item']['amount'][$key]
            ]);
        }
        $input['item'] = serialize($input['item']);
        $input['email'] = session('user_email');
        $input['name'] = session('user_name');
        Stock::create($input);
        return redirect('/');
    }
}
