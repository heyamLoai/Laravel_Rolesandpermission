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
              <h3 class="card-title">Edit Admin </h3>
            </div>
            <!-- /.card-header -->
            <!--  // edit using javascript method form start -->
            
            <form  id="page-form">
              <div class="card-body">

              
                @csrf
                <div class="form-group">
                  <label>Role</label>
                  <select class="form-control"  id="role_id">
                    @foreach ($roles as $role)
                    <option value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                  </select>  
                </div>
                <div class="form-group">
                  <label>Cities</label>
                  <select class="form-control"  id="city_id">
                    @foreach ($cities as $city)
                    <option value="{{$city->id}}"  @selected($currentRole->id == $role->id)>{{$city->name_en}}</option>
                    @endforeach
                  </select>
                </div>
                
                <div class="form-group">
                  <label for="name_en">Name</label>
                  <input type="text" class="form-control" id="name" placeholder="Enter Name"
                   value="{{$admin->name}}">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email"  placeholder="Enter Email"
                  value="{{$admin->email}}">
                </div>
                
                <div class="form-group">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="active" name="active"
                      @if ($admin->active) checked @endif >
                      <label class="custom-control-label" for="active">Active</label>
                    </div>
                  </div>
             
            
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" onclick="performUpdate()" class="btn btn-primary">Save</button>
              </div>
            </form>

            
            {{-- // edit using normal method <form >
              <div class="card-body">

                @csrf
                <div class="form-group">
                  <label for="name_en">English Name</label>
                  <input type="text" class="form-control" id="name_en" name ="name_en"
                   placeholder="Enter English Name" value="{{old('name_en') ?? $city->name_en}}">
                </div>
                <div class="form-group">
                  <label for="name_ar">Arabic Name</label>
                  <input type="text" class="form-control" id="name_ar"name ="name_ar" 
                   placeholder="Enter Arabic Name" value="{{old('name_ar') ?? $city->name_ar}}">
                </div>
                
                <div class="form-group">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="customSwitch1" @if ($city->active) @checked(true)
                      @endif  name="active">
                      <label class="custom-control-label" for="customSwitch1">Active</label>
                    </div>
                  </div>
             
            
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </form> --}}
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
  function performUpdate(){
    // Make a request for a user with a given ID
    axios.put('/cms/admin/admins/{{$admin->id}}',{
    // to send data 
        role_id:document.docgetElementById('role_id').value,
        city_id: document.docgetElementById('city_id').value,
        name: document.getElementById('name').value,
        email: document.getElementById('email').value,
        active: document.getElementById('active').chacked,
  
  
    }) 
      .then(function (response) {
        // handle success
        console.log(response);
        toastr.success(response.data.message);
       // document.getElementById('page-form').reset();
       window.location.href = '/cms/admin/admins';
        
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