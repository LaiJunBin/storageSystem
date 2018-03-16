<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BindingService;
use App\ClassName;
use App\User;

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
}
