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
                <h3 class="box-title">Purchase Data</h3>
                <a href="{{route('purchase.add')}}" style="float:right" class="btn btn-rounded btn-success mb-5">Add Purchase</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th width="2%">SL</th>
                              <th>Purchase No</th>
                              <th>Date</th>
                              <th>Supplier Name</th>
                              <th>Category</th>
                              <th>Product Name</th>
                              <th>Description</th>
                              <th>Quantity</th>
                              <th>Unit Price</th>
                              <th>Buying Price</th>
                              <th>Status</th>
                              <th width="10%">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($alldata as $key=>$purchase)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$purchase->purchase_no}}</td>
                                <td>{{date('d-m-Y',strtotime($purchase->date))}}</td>
                                <td>{{$purchase['supplier']['name']}}</td>
                                <td>{{$purchase['category']['name']}}</td>
                                <td>{{$purchase['product']['name']}}</td>
                                <td>{{$purchase->description}}</td>
                                <td>
                                {{$purchase->buying_qty}}
                                {{$purchase['product']['unit']['name']}}
                                </td>
                                <td>{{$purchase->unit_price}}</td>
                                <td>{{$purchase->buying_price}}</td>
                                <td>
                                      @if($purchase->status == '0')
                                        <span style="color: red" > Pending </span>
                                      
                                      @elseif($purchase->status == '1')
                                        <span style="color: #5EAB00" > Approved </span>
                                      
                                      @endif 
                                </td>
                                <td>
                                  @if($purchase->status == '0')
                                    <a href="{{route('purchase.delete',$purchase->id)}}" class=" btn btn-danger" id="delete">Delete</a>
                                  @endif  
                                </td>
                            </tr>
                          @endforeach
                         
                      </tbody>
                    </table>
                  </div>
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

