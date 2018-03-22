<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BindingService;
use App\ClassName;
use App\User;
use App\Material;
use App\MaterialType;
use App\Stock;
use App\StockAll;

class ManagerController extends Controller
{
    public function managerClass(){
        $binding = BindingService::binding();
        $binding['classItems'] = ClassName::get()->toarray();
        return view('manager.managerClass',$binding);
    }

    public function addClassProcess(){
        $input = Request()->all();
        ClassName::create($input);
        return redirect('/managerClass');
    }

    public function updateClass($id){
        $classSet = ClassName::where('id',$id)->first();
        return view('manager.updateClass',['classSet'=>$classSet]);
    }

    public function updateClassProcess($id){
        $input=Request()->all();
        ClassName::where(['id'=>$id])->update([
            'class_name'=>$input['class_name']
        ]);
        return redirect('/managerClass');
    }

    public function deleteClass($id){
        ClassName::where('id',$id)->delete();
        return redirect('/managerClass');
    }

    public function verificationUser(){
        $user_query = User::where(['type'=>'F'])->get();
        $binding = BindingService::binding();
        $binding['verificationUsers'] = $user_query->toarray();
        $binding['users'] = User::where([
            ['type','!=','R'],
            ['type','!=','F'],
        ])->get()->toarray();
        return view('manager/verificationUser',$binding);
    }

    public function verificationUserOK($email){
        User::where(['email'=>$email])->update([
            'type' => 'G'
        ]);
        return redirect('verificationUser');
    }

    public function verificationUserDelete($email){
        User::where(['email'=>$email])->delete();
        return redirect('verificationUser');
    }

    public function material(){
        $binding = BindingService::binding();
        $material = Material::get();
        $binding['material'] = $material;
        $binding['material_type'] = MaterialType::get()->pluck('type')->toarray();
        return view('manager.material',$binding);
    }

    public function materialAddProcess(){
        $input = Request()->all();
        // dd($input);
        if(MaterialType::where('type',$input['type'])->first() == null){
            MaterialType::create([
                'type' => $input['type']
            ]);
        }
        foreach($input['unit'] as $unit){
            if(StockAll::where([
                ['item',$input['item']],
                ['unit',$unit]
            ])->first() == null){
                StockAll::create([
                    'item' => $input['item'],
                    'unit' => $unit
                ]);
            }
        }
        $input['unit'] = serialize($input['unit']);
        Material::create($input);
        
        return redirect('material/manager');
    }


    public function materialUpdate($id){
        $binding = BindingService::binding();
        $binding['material'] = Material::where('id',$id)->first()->toarray();
        $binding['material']['unit'] = unserialize($binding['material']['unit']);
        $binding['material_type'] = MaterialType::get()->pluck('type')->toarray();
        return view('manager.updateMaterial',$binding);
    }

    public function materialUpdateProcess($id){
        $input = Request()->all();
        foreach($input['unit'] as $unit){
            // dd(StockAll::where([
            //     ['item',$input['item']],
            //     ['unit',$unit]
            // ])->first() == null);
            if(StockAll::where([
                ['item',$input['item']],
                ['unit',$unit]
            ])->first() == null){
                StockAll::create([
                    'item' => $input['item'],
                    'unit' => $unit
                ]);
            }
        }
        
        if(MaterialType::where('type',$input['type'])->first() == null){
            MaterialType::create([
                'type' => $input['type']
            ]);
        }
        Material::where('id',$id)->update([
            'item' => $input['item'],
            'unit' => serialize($input['unit']),
            'type' => $input['type']
        ]);
        if(Material::where('type',$input['prototype_type'])->first()==null)
            MaterialType::where('type',$input['prototype_type'])->delete();
        
        return redirect('/material/manager');
    }

    public function materialDeleteProcess($id){
        // $unitSet = unserialize(Material::where('id',$id)->first()->unit);
        // $item = Material::where('id',$id)->first()->item;
        // foreach($unitSet as $unit){
        //     StockAll::where([
        //         ['item' , $item],
        //         ['unit' , $unit]
        //     ])->delete();
        // }
        Material::where('id',$id)->delete();
        $input = Request()->all();
        if(Material::where('type',$input['prototype_type'])->first()==null)
            MaterialType::where('type',$input['prototype_type'])->delete();
        return redirect('/material/manager');
    }

    public function materialRecord(){
        $binding = BindingService::binding();
        $binding['stock'] = Stock::where('date','>=',date('Y-m-d'))->orderBy('date')->get()->toarray();
        $binding['stock'] = array_map(function($x){
            $x['item'] = unserialize($x['item']);
            return $x;
        },$binding['stock']);
        
        return view('manager.materialRecord',$binding);
    }

    public function stockUpdate($id){
        $binding = BindingService::binding();
        $binding['stock'] = Stock::where('id',$id)->first()->toarray();
        $binding['stock']['item'] = unserialize($binding['stock']['item']);
        
        $binding['material'] = Material::get()->toarray();
        $binding['material'] = array_map(function($x){
            $x['unit'] = unserialize($x['unit']);
            return $x;
        },$binding['material']);
        $binding['classNames'] = ClassName::get()->pluck('class_name')->toarray();
        $binding['materialType'] = MaterialType::get()->pluck('type')->toarray();
        
        $binding['temp'] = array_map(function($x) use ($binding){
            if(array_key_exists($x['id'],array_keys($binding['stock']['item']['amount'])))
            {
                $x['unit'] = unserialize($x['unit']);
                return $x;
            }
        },Material::where('type',$binding['stock']['category'])->get()->toarray());
        $binding['temp'] = array_filter($binding['temp']);
        foreach($binding['temp'] as $temp){
            $binding['currentMaterial'][$temp['id']] = $temp;
        }
        unset($binding['temp']);
        if(!isset($binding['currentMaterial']))
            $binding['currentMaterial']=[];
        return view('manager.stock',$binding);
    }

    public function stockUpdateProcess($id){
        $input = Request()->all();
        $input['item'] = serialize($input['item']);
        unset($input['_token']);
        unset($input['_method']);
        Stock::where('id',$id)->update($input);
        return redirect('/manager/material/record');
    }

    public function UserToggleType($id){
        $user = User::where('id',$id)->first();
        User::where('id',$id)->update([
            'type' => ($user->type=='A')?'G':'A'
        ]);
        return redirect('verificationUser')->with('selected','1');
    }

    public function UserDelete($id){
        User::where('id',$id)->delete();
        return redirect('verificationUser')->with('selected','1');
    }


    public function purchase(){
        $binding = BindingService::binding();
        $items = Material::get()->pluck('item')->unique()->toarray();
        $binding['material'] = [];
        foreach($items as $item){
            $current = Material::where('item',$item)->get();
            $unitSet = $current->pluck('unit')->toarray();
            $current = $current->first()->toarray();
            $current['unit'] = [];
            foreach($unitSet as $unitString){
                $unitArray = unserialize($unitString);
                foreach($unitArray as $unit){
                    if(array_search($unit,$current['unit'])===false)
                        array_push($current['unit'],$unit);
                }
            }
            unset($current['type']);
            array_push($binding['material'],$current);
        }
        // dd($binding);
        return view('manager.purchase',$binding);
    }

    public function purchaseProcess(){
        $input = Request()->all();
        foreach($input['item'] as $item){
            if($item['amount'] != null){
                $current = StockAll::where([
                    ['item',$item['name']],
                    ['unit',$item['unit']]
                ]);
                $amount = $current->first()->amount;
                $current->update([
                    'amount' => $amount += $item['amount']
                ]);
            }
        }
        return redirect('/');
    }

    public function purchaseRecordList(){
        $binding = BindingService::binding();
        $binding['records'] = StockAll::where('amount','>',0)->get()->toarray();
        return view('manager.purchaseRecord',$binding);
    }


}