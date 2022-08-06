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
            <h4 class="box-title">Update Category Data</h4>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col">
                  <form method="post" action="{{route('category.update',$editData->id)}}">
                    @csrf
                    <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                            <h5>Caetgory Name <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="name" value="{{$editData->name}}" class="form-control" required data-validation-required-message="This field is required"> </div>
                            </div>
                      </div>
                    </div>
                      <div class="text-xs-right">
                          <input type="submit" class="btn btn-rounded btn-info" value="Update">
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
