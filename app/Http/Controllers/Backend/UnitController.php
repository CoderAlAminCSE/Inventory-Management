<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnitController extends Controller
{
    public function UnitView(){
        $alldata = Unit::all();
        return view('backend.unit.view_unit',compact('alldata'));
    }


    
    public function UnitAdd(){
        return view('backend.unit.add_unit');
    }


    public function UnitStore(Request $request){

        $data= new Unit();
        $data->name=$request->name;
        $data->created_by=Auth::user()->id;
        $data->save();
        $notification  = array(
            'message'=> 'Unit Added Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('unit.view')->with($notification);
    }


    public function UnitEdit($id){
        $editData=Unit::find($id);
        return view('backend.unit.edit_unit',compact('editData'));
    }


    public function UnitUpdate(Request $request,$id){
        $data=Unit::find($id);
        $data->name=$request->name;
        $data->updated_by=Auth::user()->id;
        $data->save();

        $notification  = array(
            'message'=> 'Unit Update Successfully',
            'alert-type'=>'info'
        );
        return redirect()->route('unit.view')->with($notification);
    }


    public function UnitDelete($id){
        $data=Unit::find($id);
        $data->delete();

        $notification  = array(
            'message'=> 'Unit Delete Successfully',
            'alert-type'=>'info'
        );
        return redirect()->route('unit.view')->with($notification);
    }
}
