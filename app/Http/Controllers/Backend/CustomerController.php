<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function CustomerView(){
        $alldata = Customer::all();
        return view('backend.customer.view_customer',compact('alldata'));
    }


    
    public function CustomerAdd(){
        return view('backend.customer.add_customer');
    }


    public function CustomerStore(Request $request){
        $validateData = $request->validate([
            'email' => 'required|unique:customers',
            'name' => 'required',
            'mobile' => 'required',
            'address' => 'required'
        ]);

        $data= new Customer();
        $data->name=$request->name;
        $data->email=$request->email;
        $data->mobile=$request->mobile;
        $data->address=$request->address;
        $data->created_by=Auth::user()->id;
        $data->save();
        $notification  = array(
            'message'=> 'Customer Added Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('customer.view')->with($notification);
    }


    public function CustomerEdit($id){
        $editData=Customer::find($id);
        return view('backend.customer.edit_customer',compact('editData'));
    }


    public function CustomerUpdate(Request $request,$id){
        $data=Customer::find($id);
        $data->name=$request->name;
        $data->email=$request->email;
        $data->mobile=$request->mobile;
        $data->address=$request->address;
        $data->updated_by=Auth::user()->id;
        $data->save();

        $notification  = array(
            'message'=> 'Customer Update Successfully',
            'alert-type'=>'info'
        );
        return redirect()->route('customer.view')->with($notification);
    }


    public function CustomerDelete($id){
        $data=Customer::find($id);
        $data->delete();

        $notification  = array(
            'message'=> 'Customer Delete Successfully',
            'alert-type'=>'info'
        );
        return redirect()->route('customer.view')->with($notification);
    }
}
