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
                <h3 class="box-title">Category Data</h3>
                <a href="{{route('category.add')}}" style="float:right" class="btn btn-rounded btn-success mb-5">Add Category</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th width="5%">SL</th>
                              <th>Name</th>
                              <th width="25%">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($alldata as $key=>$category)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$category->name}}</td>
                                @php
                                    $count_category = App\Models\Product::where('category_id',$category->id)->count();
                                  @endphp
                                <td>
                                    <a href="{{route('category.edit',$category->id)}}" class="btn btn-info">Edit</a>
                                    @if ($count_category<1)
                                        <a href="{{route('category.delete',$category->id)}}" class=" btn btn-danger" id="delete">Delete</a>
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

