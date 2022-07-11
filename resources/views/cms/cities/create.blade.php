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
              <h3 class="card-title">Create City </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{route('cities.store' )}}">
              <div class="card-body">

                @if ($errors->any())
             
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                    <ul>
                        @foreach ($errors->all() as $error )
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                  </div>
                  @endif
                  @if (session()->has('message'))
                  <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                 {{session()->get('message')}}

                  </div>
                  @endif

                @csrf
                <div class="form-group">
                  <label for="name_en">English Name</label>
                  <input type="text" class="form-control" id="name_en" name ="name_en"
                   placeholder="Enter English Name" value="{{old('name_en')}}">
                </div>
                <div class="form-group">
                  <label for="name_ar">Arabic Name</label>
                  <input type="text" class="form-control" id="name_ar"name ="name_ar" 
                  value="{{old('name_ar
                  ')}}" placeholder="Enter Arabic Name">
                </div>
                
                <div class="form-group">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="customSwitch1" name="active">
                      <label class="custom-control-label" for="customSwitch1">Active</label>
                    </div>
                  </div>
             
            
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save</button>
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
  
@endsection