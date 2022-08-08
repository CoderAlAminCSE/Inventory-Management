<!DOCTYPE html>
<html>
    <head>
        <title>Invoice PDF</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table width="100%">
                        <tr>
                            <td><strong>Invoice No: # {{$invoice->invoice_no}}</strong></td>
                            <td>
                                <span>Company Name</span><br>
                                Location
                            </td>
                            <td>
                                <span>showroom no: 017562561</span><br>
                                <span>owner no: 017562561</span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="text-center" style="text-align:center;">
                    <h3>Customer Invoice</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    @php
                        $payment = App\Models\Payment::where('invoice_id',$invoice->id)->first(); 
                    @endphp 
                    <table width="100%">
                        <tr>
                            <td width="30%"> <strong>Name: </strong>{{$payment['customer']['name']}} </td>
                            <td width="30%"> <strong>Mobile: </strong>{{$payment['customer']['mobile']}} </td>
                            <td width="30%"> <strong>Address: </strong>{{$payment['customer']['address']}} </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <table width="100%" border="1">
                        <thead>
                            <tr class="text-center">
                                <th>SL</th>
                                <th>Category</th>
                                <th>Product Name</th>
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
                                    <td>{{$key+1}}</td>
                                    <td>{{$details['category']['name']}}</td>
                                    <td>{{$details['product']['name']}}</td>
                                    <td>{{$details->selling_qty}}</td>
                                    <td>{{$details->unit_price}}</td>
                                    <td>{{$details->selling_price}}</td>
                                </tr>
                                @php
                                    $total_sum += $details->selling_price;
                                @endphp
                            @endforeach
                            <tr>
                                <td colspan="5" class="text-right"><strong>Sum Total</strong> </td>
                                <td class="text-center"><strong>{{$total_sum}}</strong></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-right"><strong>Discount</strong> </td>
                                <td class="text-center"><strong>{{$payment->discount_amount}}</strong></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-right"><strong>Grand Total</strong> </td>
                                <td class="text-center"><strong>{{$payment->total_amount}}</strong></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-right"><strong>Paid Amount</strong> </td>
                                <td class="text-center"><strong>{{$payment->paid_amount}}</strong></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-right"><strong>Due Amount</strong> </td>
                                <td class="text-center"><strong>{{$payment->due_amount}}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    @php
                    $date = new DateTime('now', new DateTimezone('Asia/Dhaka')); 
                    @endphp 
                    <i>Printing time: {{$date->format('F ], Y, B:i a')}}</i>
                </div>
            </div>

            <div class="row"> 
                <div class="col-md-12">
                    <hr style="margin-bottom: @px;"> 
                    <table border="0" width="100%"> 
                        <tbody> 
                            <tr> 
                                <td style="width: 40%; ">
                                    <p style="text-align: center; margin-left: : 20px;">Customer Signature</p> </td> <td style="width: 20%"></td> <td style="width: 40%; text-align: center;">
                                    <p style="text-align: center;">Seller Signature</p> 
                                </td> 
                            </tr> 
                        </tbody>
                    </table>
                </div> 
            </div>
        </div>
    </body>
</html>