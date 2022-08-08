@extends('admin.admin_master')

@section('main_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="container-full">

      <!-- Main content -->
      <section class="content">

       <!-- Basic Forms -->
        <div class="box">
          <div class="box-header with-border">
            <h4 class="box-title">Add Invoice</h4>
          </div>
          <!-- /.box-header -->
         <div class="card-body">
            <div class="row">
              <div class="col">
                  
                    <div class="row">

                        <div class="col-md-4">
                          <div class="form-group">
                            <h5>invoice No<span class="text-danger"></span></h5>
                                <input type="text" name="invoice_no" id="invoice_no"  value="{{$invoice_no}}" class="form-control form-control-sm text-left invoice_no" readonly style="background-color:#D8FDBA">
                          </div>
                        </div>

                      <div class="col-md-4">
                          <div class="form-group">
                            <h5>Date<span class="text-danger">*</span></h5>
                                <input type="date" name="date" id="date" class="form-control" required>
                          </div>
                      </div>

                       <div class="col-md-4">
                          <div class="form-group">
                            <h5>Stoke(Kg/Pcs)<span class="text-danger"></span></h5>
                                <input type="text" name="current_stoke_qty" id="current_stoke_qty" class="form-control form-control-sm text-left current_stoke_qty" readonly style="background-color:#D8FDBA">
                          </div>
                        </div>

                    </div>


                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                              <h5>Category <span class="text-danger">*</span></h5>
                              <div class="controls">
                                <select class="form-control select2" data-placeholder="Choose Category" name="category_id" id="category_id">
                                    <option label="Choose Category"></option>
                                    @foreach($category as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                              <h5>Product Name <span class="text-danger">*</span></h5>
                              <div class="controls">
                                <select class="form-control select2" data-placeholder="Choose Product" name="product_id" id="product_id">
                                    <option label="Choose Product"></option>
                                </select>
                            </div>
                          </div>
                        </div>

                        <div class="form-group col-md-2" style="padding-top:25px;">
                          <a class="btn btn-primary addeventmore"><i class="fa fa-plus-circle "></i> Add Item</a>
                        </div>

                      </div>
                      

              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div></br></br>

          <div class="card-body">
            <form method="post" action="{{route('invoice.store')}}" >
            @csrf
            <table class="table-sm table-bordered" width="100%">
              <thead>
                <tr>
                  <th>Category</th>
                  <th>Product Name</th>
                  <th>Pcs/Kg</th>
                  <th>Unit Price</th>
                  <th width="17%">Total Price</th>
                  <th width="10%">Action</th>
                </tr>
              </thead>    
              <tbody id="addRow" class="addRow">

              </tbody>
              <tbody>
                <tr>
                    <td colspan="4">Discount</td>
                    <td>
                    <input type="text" name="discount_amount"  id="discount_amount" class="form-control form-control-sm  discount_amount" placeholder="Discount Ammount" >
                  </td>
                </tr>
                <tr>
                  <td colspan="4"></td>
                  <td>
                    <input type="text" name="estimated_amount" value="0" id="estimated_amount" class="form-control form-control-sm text-right estimated_amount" readonly style="background-color:#D8FDBA">
                  </td>
                  <td></td> 
                </tr>
              </tbody>
            </table> 
            <br>  
            <div class="form-row">
                <div class="form-group col-md-12">
                <h5>Description<span class="text-danger"></span></h5>
                    <textarea name="description" class="form-control" id="description" placeholder="Description here">
                    </textarea>
                </div>
            </div>

            <div class="form-row"> 
                <div class="form-group col-md-3"> 
                    <label>Paid Status</label> 
                        <select name="paid_status" id="paid_status" class="form-control form-control-sm">
                        <option value="">Select Status</option> 
                        <option value="full_paid">Full Paid</option> <option value="full_due">Full Due</option>
                        <option value="partial_paid">Partical Paid</option> 
                        </select> 
                        <input type="text" name="paid_amount" class="form-control form-control-sm
                        paid_amount" placeholder="Enter Paid Amount" style="display: none;"> 
                </div>
                <div class="form-group col-md-9">
                    <label>Customer Name</label> 
                    <select name="customer_id" id="customer_id" class="form-control form-control-sm select2">
                    <option value="">Select Customer</option> 
                    @foreach($customers as $customer) 
                        <option value="{{$customer->id}}">{{$customer->name}} ({{$customer->mobile}} - {{$customer->address}})</option> 
                    @endforeach
                    <option value="0">New Customer</option> 
                    </select> 
                </div>
            </div>

            <div class="form-row new_customer" style="display:none;"> 
                <div class="form-group col-md-4">
                    <input type="text" name="name" id="name" class="form-control form-control-sm", placeholder="Write Customer Name"> 
                </div> 
                <div class="form-group col-md-4">
                    <input type="text" name="mobile" id="mobile" class="form-control form-control-sm" placeholder="Write Customer Mobile No"> 
                </div> 
                <div class="form-group col-md-4">
                    <input type="text" name="address" id="address" class="form-control form-control-sm" placeholder="Write Customer Address"> 
                </div> 
            </div>

            <div class="form-group">  
              <input type="submit" class="btn btn-rounded btn-info" value="Invoice Store">
            </div>
            </form>
          </div>

          <!-- /.card-body -->
        </div>
        <!-- /.box -->

      </section>
      <!-- /.content -->
    </div>
</div>
<!-- /.content-wrapper -->



<script id="document-template" type="text/x-handlebars-template">
  <tr class="delete_add_more_item" id="delete_add_more_item">
    <input type="hidden" name="date" value="@{{date}}">
    <input type="hidden" name="invoice_no" value="@{{invoice_no}}">
    <td>
      <input type="hidden" name="category_id[]" value="@{{category_id}}">@{{category_name}}
    </td>

    <td>
      <input type="hidden" name="product_id[]" value="@{{product_id}}">@{{product_name}}
    </td>

    <td>
      <input type="number" min="1" class="form-control form-control-sm text-right selling_qty" name="selling_qty[]" value="1">
    </td>

    <td>
      <input type="number"  class="form-control form-control-sm text-right unit_price" name="unit_price[]" value="">
    </td>
    <td>
      <input class="form-control form-control-sm text-right selling_price" name="selling_price[]" value="0" readonly>
    </td>
    <td><i class="btn btn-danger btn-sm fa fa-wondow-close removeeventmore"></i></td>
  </tr>
</script>    





{{--  add item script  --}}
<script type="text/javascript">
  $(document).ready(function (){
    $(document).on("click",".addeventmore",function(){
      var date = $('#date').val();
      var invoice_no = $('#invoice_no').val();
      var supplier_id = $('#supplier_id').val();
      var category_id = $('#category_id').val();
      var category_name = $('#category_id').find('option:selected').text();
      var product_id = $('#product_id').val();
      var product_name = $('#product_id').find('option:selected').text();

      if(date==''){
        $.notify("Date is required",{globalPosition: 'top-right',className: 'error'});
        return false;
      }
      if(category_id==''){
        $.notify("Category  is required",{globalPosition: 'top-right',className: 'error'});
        return false;
      }
      if(product_id==''){
        $.notify("Product  is required",{globalPosition: 'top-right',className: 'error'});
        return false;
      }

      var source = $("#document-template").html();
      var template =  Handlebars.compile(source);
      var data={
        date:date,
        invoice_no:invoice_no,
        category_id:category_id,
        category_name:category_name,
        product_id:product_id,
        product_name:product_name
      };

      var html = template(data);
      $("#addRow").append(html);
    });

    $(document).on("click", ".removeeventmore", function (event){
      $(this).closest(".delete_add_more_item").remove();
      totalAmountPrice();
    });

    $(document).on('keyup click', '.unit_price,.selling_qty', function (){
      var unit_price = $(this).closest("tr").find("input.unit_price").val();
      var qty = $(this).closest("tr").find("input.selling_qty").val();
      var total = unit_price*qty;
      $(this).closest("tr").find("input.selling_price").val(total);
      $('#discount_amount').trigger('keyup');
    });

    $(document).on('keyup','#discount_amount',function(){
        totalAmountPrice();
    });

    //calcualate total price
    function totalAmountPrice(){
      var sum = 0;
      $(".selling_price").each(function(){
        var value = $(this).val();
        if(!isNaN(value) && value.length !=0){
          sum +=parseFloat(value);
        }
      });

      var discount_amount = parseFloat($('#discount_amount').val());
       if(! isNaN(discount_amount) && discount_amount.length != 0) {
        sum -= parseFloat(discount_amount);
      }
      $('#estimated_amount').val(sum);
    }

  });
</script>




{{--  select product by selecting category_id  --}}
<script type="text/javascript">
    $(function(){
        $(document).on('change','#category_id',function(){
            var category_id = $(this).val();
            $.ajax({
                url:"{{route('get-product')}}",
                type:"GET",
                data:{category_id:category_id},
                success:function(data){
                    var html = '<option value="">Select Product</option>';
                    $.each(data,function(key,v){
                        html +='<option value="'+v.id+'">'+v.name+'</option>';
                    });
                    $('#product_id').html(html);
                }
            });
        });
    });
</script>

{{--  select product by getting stoke of product  --}}
<script type="text/javascript">
    $(function(){
        $(document).on('change','#product_id',function(){
            var product_id = $(this).val();
            $.ajax({
                url:"{{route('get-product-stoke')}}",
                type:"GET",
                data:{product_id:product_id},
                success:function(data){
                    $('#current_stoke_qty').val(data);
                }
            });
        });
    });
</script>

{{--  show/hide paid_amount field selecting by paid status  --}}
<script type="text/javascript">
    $(document).on('change','#paid_status',function(){
        
        var paid_status = $(this).val();
        if(paid_status =='partial_paid'){
            $('.paid_amount').show();
        }else{
            $('.paid_amount').hide();
        }
        
    });
</script>

{{--  show/hide new customer  field selecting by customer name option  --}}
<script type="text/javascript">
    $(document).on('change','#customer_id',function(){
        
        var customer_id = $(this).val();
        if(customer_id =='0'){
            $('.new_customer').show();
        }else{
            $('.new_customer').hide();
        }
        
    });
</script>


@endsection
