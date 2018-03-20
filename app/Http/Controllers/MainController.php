<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BindingService;
use App\ClassName;
Use App\Stock;
Use App\Material;

class MainController extends Controller
{
    public function index(){
        $binding = BindingService::binding();
        $className_result = ClassName::get();
        $binding['classNames'] = $className_result->pluck('class_name')->toarray();
        if(count($binding['classNames'])>0){
            foreach ($binding['classNames'] as $className) {
                $binding['classStock'][$className] = Stock::where('class_name',$className)->get()->toarray();
                $binding['classStock'][$className] = array_map(function($x){
                    $x['item'] = unserialize($x['item']);
                    return $x;
                },$binding['classStock'][$className]);
            }
            $binding['classStock'] = json_encode($binding['classStock']);
        }else{
            $binding['classStock'] = json_encode([]);
        }
        $binding['material'] = json_encode(Material::get()->pluck('item','id')->toarray());
        return view('index',$binding);
    }
}
