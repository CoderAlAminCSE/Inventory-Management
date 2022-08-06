@extends('admin.admin_master')

@section('main_content')
    
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="container-full">	  

      <!-- Main content -->
      <section class="content">

       <!-- Basic Forms -->
        <div class="box">
          <div class="box-header with-border">
            <h4 class="box-title">Add Product</h4>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col">
                  <form method="post" action="{{route('product.store')}}">
                    @csrf
                    <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                            <h5>Supplier Name <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select class="form-control select2" data-placeholder="Choose Supplier" name="supplier_id">
                                    <option label="Choose Supplier"></option>
                                    @foreach($supplier as $sp)
                                        <option value="{{ $sp->id }}">{{ $sp->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                          </div>
                      </div>

                        <div class="col-md-6">
                            <div class="form-group">
                              <h5>Category <span class="text-danger">*</span></h5>
                              <div class="controls">
                                <select class="form-control select2" data-placeholder="Choose Category" name="category_id">
                                    <option label="Choose Category"></option>
                                    @foreach($category as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                          </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                              <h5>Unit <span class="text-danger">*</span></h5>
                              <div class="controls">
                                <select class="form-control select2" data-placeholder="Choose Utnit" name="unit_id">
                                    <option label="Choose Unit"></option>
                                    @foreach($unit as $unt)
                                        <option value="{{ $unt->id }}">{{ $unt->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                              <h5>Product Name <span class="text-danger">*</span></h5>
                              <div class="controls">
                                  <input type="text" name="name" class="form-control" required data-validation-required-message="This field is required"> </div>
                          </div>
                        </div>

                      </div>
                      <div class="text-xs-right">
                          <input type="submit" class="btn btn-rounded btn-info" value="Submit">
                      </div>
                  </form>

              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

      </section>
      <!-- /.content -->
    </div>
</div>
<!-- /.content-wrapper -->

@endsection
