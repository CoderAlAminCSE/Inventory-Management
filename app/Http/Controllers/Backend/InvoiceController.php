<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceDetails;
use App\Models\Payment;
use App\Models\PaymentDetails;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class InvoiceController extends Controller
{
    public function View(){
        $alldata = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','1')->get();
        return view('backend.invoice.view_invoice',compact('alldata'));
    }


    
    public function Add(){
        $data['category'] = Category::all();
        $data['customers'] = Customer::all();
        $invoice_data = Invoice:: orderBy('id', 'desc')->first(); 
        if($invoice_data == null){
            $firstReg = '0';
            $data['invoice_no'] = $firstReg+1; 
        }else{
            $invoice_data = Invoice:: orderBy('id', 'desc')->first()->invoice_no;
            $data['invoice_no'] = $invoice_data+1;
            }
        return view('backend.invoice.add_invoice',$data);
    }


    public function Store(Request $request){
        if($request->category_id==null){
            $notification  = array(
                'message'=> 'Sorry! you do not select any data',
                'alert-type'=>'info'
            );
            return redirect()->back()->with($notification);
        }else{
            if($request->paid_amount>$request->estimated_amount){
                $notification  = array(
                    'message'=> 'Sorry! paid amount is maximum than total amount',
                    'alert-type'=>'info'
                );
                return redirect()->back()->with($notification);
            }else{
                $invoice = new Invoice();
                 $invoice->invoice_no = $request->invoice_no; 
                 $invoice->date = date('Y-m-d', strtotime($request->date));
                 $invoice->description = $request->description;
                 $invoice->status = '0'; 
                 $invoice->created_by=Auth::user()->id;

                 DB::transaction(function() use($request,$invoice) { 
                    if($invoice->save()){
                        $count_category = count($request->category_id);
                        for($i=0; $i <$count_category; $i++){
                            $invoice_details = new InvoiceDetails();
                            $invoice_details->date = date('Y-m-d', strtotime($request->date));
                            $invoice_details->invoice_id = $invoice->id;
                            $invoice_details->category_id = $request->category_id[$i]; 
                            $invoice_details ->product_id = $request->product_id[$i]; $invoice_details->selling_qty = $request->selling_qty[$i]; 
                            $invoice_details ->unit_price = $request->unit_price[$i];
                            $invoice_details->selling_price = $request->selling_price[$i]; $invoice_details->status = '1'; 
                            $invoice_details->save();
                        }

                        if($request->customer_id == '0') {
                            $customer = new Customer(); 
                            $customer->name = $request->name; 
                            $customer->mobile = $request->mobile; 
                            $customer->address = $request->address; 
                            $customer->save();
                            $customer_id = $customer->id; 
                        }else{
                            $customer_id = $request->customer_id;
                        }

                        $payment = new Payment(); 
                        $payment_details = new PaymentDetails(); 
                        $payment->invoice_id = $invoice->id; 
                        $payment->customer_id = $customer_id; 
                        $payment->paid_status = $request->paid_status; 
                        $payment->discount_amount = $request->discount_amount; 
                        $payment->total_amount = $request->estimated_amount; 
                        if($request->paid_status == 'full_paid'){
                            $payment->paid_amount = $request->estimated_amount; 
                            $payment->due_amount = '0';
                            $payment_details->current_paid_amount = $request->estimated_amount; 
                        }elseif($request->paid_status=='full_due'){
                            $payment->paid_amount = '0'; 
                            $payment->due_amount = $request->estimated_amount;
                            $payment_details->current_paid_amount = '0'; 
                        }elseif($request->paid_status=='partial_paid') {
                            $payment->paid_amount = $request->paid_amount; $payment->due_amount = $request->estimated_amount-$request->paid_amount; $payment_details->current_paid_amount = $request->paid_amount;
                        }

                        $payment->save(); 
                        $payment_details->invoice_id = $invoice->id; 
                        $payment_details->date = date('Y-m-d', strtotime($request->date)); 
                        $payment_details->save();

                    }
                 });   
            }
        }
        $notification  = array(
            'message'=> 'Data Update Successfully',
            'alert-type'=>'info'
        );
        return redirect()->route('invoice.pending.list')->with($notification);
    }


    public function Delete($id){
        $invoice = Invoice::find($id); 
        $invoice->delete(); 
        InvoiceDetails::where('invoice_id', $invoice->id) ->delete(); 
        Payment::where('invoice_id', $invoice->id) ->delete();
        PaymentDetails::where('invoice_id', $invoice->id) ->delete();

        $notification  = array(
            'message'=> 'Data Delete Successfully',
            'alert-type'=>'info'
        );
        return redirect()->route('invoice.view')->with($notification);
    }


    public function pendingList(){
        $alldata = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','0')->get();
        return view('backend.invoice.view_pending_list',compact('alldata'));
    }


    public function Approve($id){
        $invoice = Invoice::with('invoice_details')->find($id);
    
        return view('backend.invoice.invoice_approve',compact('invoice'));
    }


    public function ApproveStore(Request $request,$id){
        foreach($request->selling_qty as $key => $val){
            $invoice_details = InvoiceDetails::where('id',$key)->first(); 
            $product = Product::where('id',$invoice_details->product_id)->first(); 
            if($product->quantity < $request->selling_qty[$key]){
                $notification  = array(
                    'message'=> 'Sorry! You approve maximum value',
                    'alert-type'=>'error'
                );
                return redirect()->back()->with($notification);
            }
        }

        $invoice = Invoice::find($id); 
        $invoice->approved_by = Auth::user()->id; 
        $invoice->status = '1'; 

        DB::transaction(function() use($request, $invoice,$id){ 
            foreach($request->selling_qty as $key => $val){
                $invoice_details = InvoiceDetails::where('id',$key)->first();
                $product = Product::where('id',$invoice_details->product_id)->first();
                $product->quantity = ((float)$product->quantity)-((Float) $request->selling_qty[$key]);
                $product->save();
            }    
            $invoice->save(); 
        });

    $notification  = array(
        'message'=> 'Data inserted Succesfully',
        'alert-type'=>'success'
    );

    return redirect()->route('invoice.view')->with($notification);    
           
    }



    public function PrintInvoiceList(){
        $alldata = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status','1')->get();
        return view('backend.invoice.view_invoice_print_list',compact('alldata'));
    }


    public function PrintInvoice($id){
        $data['invoice'] = Invoice::with(['invoice_details'])->find($id);
        $pdf = PDF::loadView('backend.pdf.invoice_pdf',$data);
        $pdf->SetProtection(['copy','print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }





}
