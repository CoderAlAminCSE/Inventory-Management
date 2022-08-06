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
                <h3 class="box-title">Supplier Data</h3>
                <a href="{{route('supplier.add')}}" style="float:right" class="btn btn-rounded btn-success mb-5">Add Supplier</a>
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
                          @foreach ($alldata as $key=>$supplier)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$supplier->name}}</td>
                                <td>{{$supplier->mobile}}</td>
                                <td>{{$supplier->email}}</td>
                                <td>{{$supplier->address}}</td>
                                  @php
                                    $count_supplier = App\Models\Product::where('supplier_id',$supplier->id)->count();
                                  @endphp
                                  {{--  @dd($count_supplier);  --}}
                                <td>
                                    <a href="{{route('supplier.edit',$supplier->id)}}" class="btn btn-info">Edit</a>
                                    @if($count_supplier<1)
                                      <a href="{{route('supplier.delete',$supplier->id)}}" class=" btn btn-danger" id="delete">Delete</a>
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

