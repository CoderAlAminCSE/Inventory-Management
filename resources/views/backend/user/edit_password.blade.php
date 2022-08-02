@extends('admin.admin_master')

@section('main_content')

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="list-unstyled">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
    
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="container-full">	  

      <!-- Main content -->
      <section class="content">

       <!-- Basic Forms -->
        <div class="box">
          <div class="box-header with-border">
            <h4 class="box-title">Change Password</h4>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col">
                  <form method="post" action="{{route('password.update')}}">
                    @csrf

                            <div class="form-group">
                              <h5>Current Password <span class="text-danger">*</span></h5>
                              <div class="controls">
                                  <input id="current_password" type="password" name="oldPassword" class="form-control"> </div>
                                  @error('oldPassword')
                                    <span class="text-danger">{{$message}}</span>
                                   @enderror
                            </div> 

                        
                            <div class="form-group">
                              <h5>New Password <span class="text-danger">*</span></h5>
                              <div class="controls">
                                  <input id="password" type="password" name="password" class="form-control"> </div>
                                  @error('password')
                                      <span class="text-danger">{{$message}}</span>
                                  @enderror
                            </div>

                            <div class="form-group">
                                <h5>Confirm Password <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input id="password_confirmation" type="password" name="password_confirmation" class="form-control"> </div>
                                    @error('password_confirmation')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
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
