@extends('cms.parent')
@section('page-tittle','Dashboard')

@section('lg-tittle','large')
@section('main-tittle','Main' )
@section('sm-tittle','Small')

@section('styles')

  <!-- Toastr -->
  <link rel="stylesheet" href="{{asset('cms/plugins/toastr/toastr.min.css')}}">
@endsection
@section('content')

 
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Create User </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form  id="page-form">
              <div class="card-body">

              
                @csrf
                <div class="form-group">
                  <label for="full_name">Full Name</label>
                  <input type="text" class="form-control" id="full_name"   placeholder="Enter Full Name">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email"  placeholder="Enter Email">
                </div>
                
                <div class="form-group">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="active" name="active">
                      <label class="custom-control-label" for="customSwitch1">Active</label>
                    </div>
                  </div>
             
            
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" onclick="performSave()" class="btn btn-primary">Save</button>
              </div>
            </form>
          </div>
          <!-- /.card -->


        </div>
        <!--/.col (left) -->
       
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
@endsection

 
@section('scripts')

<script> 
function performSave(){
  // Make a request for a user with a given ID
  axios.post('/cms/admin/users',{
  // to send data 
      
      full_name: document.getElementById('full_name').value,
      email: document.getElementById('email').value,


  })
    .then(function (response) {
      // handle success
      console.log(response);
      toastr.success(response.data.message);
      document.getElementById('page-form').reset();
      
    }) 
    .catch(function (error) {
      // handle error 
      console.log(error);
      toastr.error(error.response.data.message);

    })
    .then(function () {
      // always executed
    });

}
</script>
@endsection