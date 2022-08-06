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
                <h3 class="box-title">Product Data</h3>
                <a href="{{route('product.add')}}" style="float:right" class="btn btn-rounded btn-success mb-5">Add Product</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th width="5%">SL</th>
                              <th>Supplier Name</th>
                              <th>Category</th>
                              <th>Name</th>
                              <th>Unit</th>
                              <th width="25%">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($alldata as $key=>$product)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$product['supplier']['name']}}</td>
                                <td>{{$product['category']['name']}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product['unit']['name']}}</td>
                                @php
                                    $count_product = App\Models\Purchase::where('product_id',$product->id)->count();
                                  @endphp
                                <td>
                                    <a href="{{route('product.edit',$product->id)}}" class="btn btn-info">Edit</a>
                                    @if ($count_product<1)
                                        <a href="{{route('product.delete',$product->id)}}" class=" btn btn-danger" id="delete">Delete</a>
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

