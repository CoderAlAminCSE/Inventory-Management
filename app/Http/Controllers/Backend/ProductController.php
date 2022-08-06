<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function View(){
        $alldata = Product::all();
        return view('backend.product.view_product',compact('alldata'));
    }


    
    public function Add(){
        $data['supplier'] = Supplier::all();
        $data['category'] = Category::all();
        $data['unit'] = Unit::all();
        return view('backend.product.add_product',$data);
    }


    public function Store(Request $request){

        $data= new Product();
        $data->supplier_id=$request->supplier_id;
        $data->unit_id=$request->unit_id;
        $data->category_id=$request->category_id;
        $data->name=$request->name;
        $data->created_by=Auth::user()->id;
        $data->save();
        $notification  = array(
            'message'=> 'Data Added Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('product.view')->with($notification);
    }


    public function Edit($id){
        $data['editdata']=Product::find($id);
        $data['supplier'] = Supplier::all();
        $data['category'] = Category::all();
        $data['unit'] = Unit::all();
        return view('backend.product.edit_product',$data);
    }


    public function Update(Request $request,$id){
        $data=Product::find($id);
        $data->supplier_id=$request->supplier_id;
        $data->unit_id=$request->unit_id;
        $data->category_id=$request->category_id;
        $data->name=$request->name;
        $data->updated_by=Auth::user()->id;
        $data->save();

        $notification  = array(
            'message'=> 'Data Update Successfully',
            'alert-type'=>'info'
        );
        return redirect()->route('product.view')->with($notification);
    }


    public function Delete($id){
        $data=Product::find($id);
        $data->delete();

        $notification  = array(
            'message'=> 'Data Delete Successfully',
            'alert-type'=>'info'
        );
        return redirect()->route('product.view')->with($notification);
    }

    
}
