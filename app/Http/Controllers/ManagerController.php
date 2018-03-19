<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BindingService;
use App\ClassName;
use App\User;
use App\Material;

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
        return view('manager.material',$binding);
    }

    public function materialAddProcess(){
        $input = Request()->all();
        $input['unit'] = serialize($input['unit']);
        Material::create($input);
        return redirect('material/manager');
    }


    public function materialUpdate($id){
        $binding = BindingService::binding();
        $binding['material'] = Material::where('id',$id)->first()->toarray();
        $binding['material']['unit'] = unserialize($binding['material']['unit']);
        return view('manager.updateMaterial',$binding);
    }

    public function materialUpdateProcess($id){
        $input = Request()->all();
        Material::where('id',$id)->update([
            'item' => $input['item'],
            'unit' => serialize($input['unit'])
        ]);
        return redirect('/material/manager');
    }

    public function materialDeleteProcess($id){
        Material::where('id',$id)->delete();
        return redirect('/material/manager');
    }
}
