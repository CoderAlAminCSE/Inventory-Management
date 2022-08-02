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
            <h4 class="box-title">Update Profile</h4>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col">
                <form method="post" action="{{route('profile.update')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                            <h5>User Name <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="name" value="{{$editData->name}}" class="form-control" required data-validation-required-message="This field is required"> </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <h5>User Email <span class="text-danger">*</span></h5>
                          <div class="controls">
                              <input type="email" name="email" value="{{$editData->email}}" class="form-control" required data-validation-required-message="This field is required"> </div>
                      </div>
                    </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <h5>User Mobile <span class="text-danger">*</span></h5>
                              <div class="controls">
                                  <input type="text" name="mobile" value="{{$editData->mobile}}" class="form-control" required data-validation-required-message="This field is required"> </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <h5>User Address <span class="text-danger">*</span></h5>
                              <div class="controls">
                                  <input type="text" name="address" value="{{$editData->address}}" class="form-control" required data-validation-required-message="This field is required"> </div>
                          </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">	
                            <div class="form-group">
                              <h5>User Gender <span class="text-danger">*</span></h5>
                              <div class="controls">
                                <select name="gender" id="select" required class="form-control">
                                  <option value="" selected disabled>Select Gender</option>
                                  <option value="Male" {{$editData->gender=="Male"? "selected":""}}>Male</option>
                                  <option value="Female" {{$editData->gender=="Female"? "selected":""}}>Female</option>
                                </select>
                              </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <h5>Profile Photo <span class="text-danger">*</span></h5>
                              <div class="controls">
                                  <input type="file" name="image" id="image" class="form-control"> </div>
                            </div>
                            <div class="form-group">
                                <div class="controls">
                                   <img id="showImage" src="{{(!empty($editData->image)) ? url('upload/student_image/'.$editData->image):url('upload/no_image.jpg')}}" alt="" style="height: 100px;height:100px">
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



<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

@endsection
