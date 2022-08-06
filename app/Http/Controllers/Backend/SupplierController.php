<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    public function SupplierView(){
        $alldata = Supplier::all();
        return view('backend.supplier.view_supplier',compact('alldata'));
    }


    public function SupplierAdd(){
        return view('backend.supplier.add_supplier');
    }


    public function SupplierStore(Request $request){
        $validateData = $request->validate([
            'email' => 'required|unique:suppliers',
            'name' => 'required',
            'mobile' => 'required',
            'address' => 'required'
        ]);

        $data= new Supplier();
        $data->name=$request->name;
        $data->email=$request->email;
        $data->mobile=$request->mobile;
        $data->address=$request->address;
        $data->created_by=Auth::user()->id;
        $data->save();
        $notification  = array(
            'message'=> 'Supplier Added Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('supplier.view')->with($notification);
    }


    public function SupplierEdit($id){
        $editData=Supplier::find($id);
        return view('backend.supplier.edit_supplier',compact('editData'));
    }


    public function SupplierUpdate(Request $request,$id){
        $data=Supplier::find($id);
        $data->name=$request->name;
        $data->email=$request->email;
        $data->mobile=$request->mobile;
        $data->address=$request->address;
        $data->updated_by=Auth::user()->id;
        $data->save();

        $notification  = array(
            'message'=> 'User Update Successfully',
            'alert-type'=>'info'
        );
        return redirect()->route('supplier.view')->with($notification);
    }


    public function SupplierDelete($id){
        $data=Supplier::find($id);
        $data->delete();

        $notification  = array(
            'message'=> 'Supplier Delete Successfully',
            'alert-type'=>'info'
        );
        return redirect()->route('supplier.view')->with($notification);
    }





}
