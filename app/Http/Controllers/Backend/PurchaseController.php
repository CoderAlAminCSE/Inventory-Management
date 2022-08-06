<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    
    public function View(){
        $alldata = Purchase::orderBy('date','desc')->orderBy('id','desc')->get();
        return view('backend.purchase.view_purchase',compact('alldata'));
    }


    
    public function Add(){
        $data['supplier'] = Supplier::all();
        $data['category'] = Category::all();
        $data['unit'] = Unit::all();
        return view('backend.purchase.add_purchase',$data);
    }


    public function Store(Request $request){
        if($request->category_id==null){
            $notification  = array(
                'message'=> 'Sorry! you do not select any data',
                'alert-type'=>'info'
            );
            return redirect()->back()->with($notification);
        }else{
            $count_category = count($request->category_id);
            for($i=0;$i<$count_category;$i++){
                $purchase = new Purchase();
                $purchase->date  = date('Y-m-d',strtotime($request->date[$i]));
                $purchase->purchase_no = $request->purchase_no[$i];
                $purchase->supplier_id = $request->supplier_id[$i];
                $purchase->category_id = $request->category_id[$i];
                $purchase->product_id = $request->product_id[$i];
                $purchase->buying_qty = $request->buying_qty[$i];
                $purchase->unit_price = $request->unit_price[$i];
                $purchase->buying_price = $request->buying_price[$i];
                $purchase->description = $request->description[$i];
                $purchase->created_by = Auth::user()->id;
                $purchase->status = '0';
                $purchase->save();

                $notification  = array(
                    'message'=> 'Data Save Successfully',
                    'alert-type'=>'info'
                );
            }
        }
        
        return redirect()->route('purchase.view')->with($notification);
    }


    public function Delete($id){
        $data=Purchase::find($id);
        $data->delete();

        $notification  = array(
            'message'=> 'Data Delete Successfully',
            'alert-type'=>'info'
        );
        return redirect()->route('purchase.view')->with($notification);
    }


    public function pendingList(){
        $alldata = Purchase::orderBy('date','desc')->orderBy('id','desc')->where('status','0')->get();
        return view('backend.purchase.view_pending_list',compact('alldata'));
    }


    public function Approve($id){
        $purchase = Purchase::find($id);
        $product = Product::where('id',$purchase->product_id)->first();
        $purchase_qty = ((float)($purchase->buying_qty))+((float)($product->quantity));
        $product->quantity = $purchase_qty;
        if($product->save()){
            DB::table('purchases')
            ->where('id', $id)
            ->update(['status' => 1]);
        }
    
        return redirect()->route('purchase.pending.list')->with('success', 'Data approved successfully');
    }


}
