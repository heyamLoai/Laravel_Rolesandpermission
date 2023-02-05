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
              <h3 class="card-title">Create Roles </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form  id="page-form">
              <div class="card-body">
                @csrf
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name"   placeholder="Enter Name">
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
  axios.post('/cms/admin/categories',{
  // to send data 
      name: document.getElementById('name').value,


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