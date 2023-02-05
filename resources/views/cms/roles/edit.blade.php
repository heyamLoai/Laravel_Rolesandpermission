@extends('cms.parent')
@section('page-tittle','Dashboard')

@section('lg-tittle','large')
@section('main-tittle','Main' )
@section('sm-tittle','Small')

@section('styles')
  
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
              <h3 class="card-title">Edit Role </h3>
            </div>
            <!-- /.card-header -->
            <!--  // edit using javascript method form start -->
            
            <form  id="page-form">
              <div class="card-body">

              
                @csrf
                <div class="form-group">
                  <label>User Type</label>
                  <select class="form-control"  id="guard">
                    {{-- <option value="admin"  @if ($role->guard_name == 'admin') selected @endif >Admin</option> --}}
                    <option value="admin" @selected($role->guard_name == 'admin') >Admin</option>
                    <option value="user" @selected($role->guard_name == 'user')>User</option>

                  </select>
                </div>
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" placeholder="Enter Name"
                   value="{{$role->name}}">
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" onclick="performUpdate()" class="btn btn-primary">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
@endsection

 
@section('scripts')
<script> 
  function performUpdate(){
    // Make a request for a user with a given ID
    axios.put('/cms/admin/roles/{{$role->id}}',{
    // to send data 
        guard: document.docgetElementById('guard').value,
        name: document.getElementById('name').value,
  
  
    }) 
      .then(function (response) {
        // handle success
        console.log(response);
        toastr.success(response.data.message);
       // document.getElementById('page-form').reset();
       window.location.href = '/cms/admin/roles';
        
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