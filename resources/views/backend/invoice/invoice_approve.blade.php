@extends('admin.admin_master')

@section('main_content')
    
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="container-full">

      <!-- Main content -->
      <section class="content">
        <div class="row"> 

          <div class="col-12">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">invoice No: #{{$invoice->invoice_no}}({{date('d-m-Y',strtotime($invoice->date))}})</h3>
                <a href="{{route('invoice.pending.list')}}" style="float:right" class="btn btn-rounded btn-success mb-5">Pending List</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="table-responsive">
                    @php
                        $payment = App\Models\Payment::where('invoice_id',$invoice->id)->first(); 
                    @endphp 
                    <table width="100%"> 
                        <tbody> 
                            <tr>
                                <td width="15%"><p><strong>Customer Info</strong></p></td> 
                                <td width="25%"><p><strong>Name : </strong> {{$payment['customer']['name']}}</p> </td> 
                                <td width="25%"><p><strong>Mobile No :</strong> {{$payment['customer']['mobile']}}</p></td> 
                                <td width="35%"><p><strong>Address : </strong> {{$payment['customer']['address']}}</p></td>
                                <tr>
                                <td width="15%"></td> <td width="85%" colspan="3"><p><strong>Description : </strong>
                                {{$invoice->description}}</p></td> 
                            </tr> 
                        </tbody> 
                    </table>
                </div>
                <br><br>
                <form method="post" action="{{route('invoice.approve.store',$invoice->id)}}">
                @csrf
                    <div class="table-responsive">
                    <table border="1" width="100%">
                        <thead>
                            <tr class="text-center">
                                <th>SL</th>
                                <th>Category</th>
                                <th>Product Name</th>
                                <th class="text-center" style="background:#ddd;">Current Stock</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total_sum = '0';
                            @endphp
                            @foreach ($invoice['invoice_details'] as $key => $details)
                                <tr class="text-center">
                                    <input type="hidden" name="category_id[]" value"{{$details->category_id}}"> 
                                    <input type="hidden" name="product_id[]" value="{{$details->product_id}}"> 
                                    <input type="hidden" name="selling_qty[{{$details->id}}]" value=" {{$details->selling_qty}}">
                                    <td>{{$key+1}}</td>
                                    <td>{{$details['category']['name']}}</td>
                                    <td>{{$details['product']['name']}}</td>
                                    <td class="text-center" style="background:#ddd;">{{$details['product']['quantity']}}</td>
                                    <td>{{$details->selling_qty}}</td>
                                    <td>{{$details->unit_price}}</td>
                                    <td>{{$details->selling_price}}</td>
                                </tr>
                                @php
                                    $total_sum += $details->selling_price;
                                @endphp
                            @endforeach
                            <tr>
                                <td colspan="6" class="text-right"><strong>Sum Total</strong> </td>
                                <td class="text-center"><strong>{{$total_sum}}</strong></td>
                            </tr>
                            <tr>
                                <td colspan="6" class="text-right"><strong>Discount</strong> </td>
                                <td class="text-center"><strong>{{$payment->discount_amount}}</strong></td>
                            </tr>
                            <tr>
                                <td colspan="6" class="text-right"><strong>Grand Total</strong> </td>
                                <td class="text-center"><strong>{{$payment->total_amount}}</strong></td>
                            </tr>
                            <tr>
                                <td colspan="6" class="text-right"><strong>Paid Amount</strong> </td>
                                <td class="text-center"><strong>{{$payment->paid_amount}}</strong></td>
                            </tr>
                            <tr>
                                <td colspan="6" class="text-right"><strong>Due Amount</strong> </td>
                                <td class="text-center"><strong>{{$payment->due_amount}}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                    <br>
                    <input type="submit" class="btn btn-rounded btn-info" style="float:right" value="Invoice Approve">
                </form>
                
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
                     
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    
    </div>
</div>
<!-- /.content-wrapper -->

@endsection

