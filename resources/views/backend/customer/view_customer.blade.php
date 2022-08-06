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
                <h3 class="box-title">Customer Data</h3>
                <a href="{{route('customer.add')}}" style="float:right" class="btn btn-rounded btn-success mb-5">Add Customer</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th width="5%">SL</th>
                              <th>Name</th>
                              <th>Mobile</th>
                              <th>Email</th>
                              <th>Address</th>
                              <th width="25%">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($alldata as $key=>$customer)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$customer->name}}</td>
                                <td>{{$customer->mobile}}</td>
                                <td>{{$customer->email}}</td>
                                <td>{{$customer->address}}</td>
                                <td>
                                    <a href="{{route('customer.edit',$customer->id)}}" class="btn btn-info">Edit</a>
                                    <a href="{{route('customer.delete',$customer->id)}}" class=" btn btn-danger" id="delete">Delete</a>
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

