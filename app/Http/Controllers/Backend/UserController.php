<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function UserView(){
        $data['alldata'] = User::all();
        return view('backend.user.view_user',$data);
    }

    public function AddUser(){
        return view('backend.user.add_user');
    }

    public function UserStore(Request $request){
        $validateData = $request->validate([
            'email' => 'required|unique:users',
            'name' => 'required'
        ]);

        $data= new User();
        $data->usertype=$request->usertype;
        $data->name=$request->name;
        $data->email=$request->email;
        $data->password=bcrypt($request->password);
        $data->save();
        $notification  = array(
            'message'=> 'User Inserted Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('user.view')->with($notification);
    }

    public function UserEdit($id){
        $editData=User::find($id);
        return view('backend.user.edit_user',compact('editData'));
    }

    public function UpdateStore(Request $request,$id){
        $data=User::find($id);
        $data->usertype=$request->usertype;
        $data->name=$request->name;
        $data->email=$request->email;
        $data->save();

        $notification  = array(
            'message'=> 'User Update Successfully',
            'alert-type'=>'info'
        );
        return redirect()->route('user.view')->with($notification);
    }

    public function DeleteUser($id){
        $data=User::find($id);
        $data->delete();

        $notification  = array(
            'message'=> 'User Delete Successfully',
            'alert-type'=>'info'
        );
        return redirect()->route('user.view')->with($notification);
    }
}
