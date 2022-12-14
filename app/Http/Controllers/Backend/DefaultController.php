<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class DefaultController extends Controller
{
    public function getCategory(Request $request){
        $supplier_id = $request->supplier_id;
        $allCategory = Product::with(['category'])->select('category_id')->where('supplier_id',$supplier_id)->groupBy('category_id')->get();
        // dd($allCategory);
        return response()->json($allCategory);
    }

    public function getProduct(Request $request){
        $category_id = $request->category_id;
        // dd($category_id);
        $allProduct = Product::where('category_id',$category_id)->get();
        //  dd($allProduct);
         return response()->json($allProduct);
    }


    public function getStoke(Request $request){
        $product_id = $request->product_id;
        $stoke = Product::where('id',$product_id)->first()->quantity;
        // dd($stoke);
        return response()->json($stoke);
    }
}
