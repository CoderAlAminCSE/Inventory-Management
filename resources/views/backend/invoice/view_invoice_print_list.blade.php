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
                <h3 class="box-title">Invoice Data</h3>
                {{--  <a href="{{route('invoice.add')}}" style="float:right" class="btn btn-rounded btn-success mb-5">Add Invoice</a>  --}}
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th width="">SL</th>
                              <th>Customer Name</th>
                              <th>Invoice No</th>
                              <th>Date</th>
                              <th>Description</th>
                              <th>Amount</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($alldata as $key => $invoice)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$invoice['payment']['customer']['name']}}</td>
                                <td>#{{$invoice->invoice_no}}</td>
                                <td>{{date('d-m-Y',strtotime($invoice->date))}}</td>
                                <td>{{$invoice->description}}</td>
                                <td>{{$invoice['payment']['total_amount']}}</td>
                                <td>
                                <a href="{{route('invoice.print',$invoice->id)}}" target="_blank" class="btn btn-info">Print</a>
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

