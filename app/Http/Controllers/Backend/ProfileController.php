<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function ProfileView(){
        $id=Auth::user()->id;
        $data=User::find($id);
        return view('backend.user.view_profile',compact('data'));
    }

    public function ProfileEdit(){
        $id=Auth::user()->id;
        $editData=User::find($id);
        return view('backend.user.edit_profile',compact('editData'));
    }


    public function ProfileUpdate(Request $request){
        $data=User::find(Auth::user()->id);
        $data->name=$request->name;
        $data->email=$request->email;
        $data->mobile=$request->mobile;
        $data->address=$request->address;
        $data->gender=$request->gender;

        if($request->file('image')){
            $file=$request->file('image');
            @unlink(public_path('upload/user_image/'.$data->image));
            $filename=date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_image'),$filename);
            $data['image']=$filename;
        }
        $data->save();
        $notification  = array(
            'message'=> 'User Update Successfully',
            'alert-type'=>'info'
        );
        return redirect()->route('profile.view')->with($notification);
    }


    public function PasswordView(){
        return view('backend.user.edit_password');
    }


    public function PasswordUpdate(Request $request){
        $validateData = $request->validate([
            'oldPassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword=Auth::user()->password;
        if(Hash::check($request->oldPassword,$hashedPassword)){
            $user=User::find(Auth::id());
            $user->password=Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login');
        }
        else{
            return redirect()->back();
        }
    }
    
}
