<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function CategoryView(){
        $alldata = Category::all();
        return view('backend.category.view_category',compact('alldata'));
    }


    
    public function CategoryAdd(){
        return view('backend.category.add_category');
    }


    public function CategoryStore(Request $request){

        $data= new Category();
        $data->name=$request->name;
        $data->created_by=Auth::user()->id;
        $data->save();
        $notification  = array(
            'message'=> 'Category Added Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('category.view')->with($notification);
    }


    public function CategoryEdit($id){
        $editData=Category::find($id);
        return view('backend.category.edit_category',compact('editData'));
    }


    public function CategoryUpdate(Request $request,$id){
        $data=Category::find($id);
        $data->name=$request->name;
        $data->updated_by=Auth::user()->id;
        $data->save();

        $notification  = array(
            'message'=> 'Category Update Successfully',
            'alert-type'=>'info'
        );
        return redirect()->route('category.view')->with($notification);
    }


    public function CategoryDelete($id){
        $data=Category::find($id);
        $data->delete();

        $notification  = array(
            'message'=> 'Data Delete Successfully',
            'alert-type'=>'info'
        );
        return redirect()->route('category.view')->with($notification);
    }


}
