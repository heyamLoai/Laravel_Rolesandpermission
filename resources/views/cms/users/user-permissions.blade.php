@extends('cms.parent')
@section('page-tittle','Dashboard')

@section('lg-tittle','large')
@section('main-tittle','Main' )
@section('sm-tittle','Small')

@section('styles')
<link rel="stylesheet" href="{{asset('cms/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
@endsection
@section('content')
     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Role({{$role->name}}) -Permissions</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th style="width: 5px">#</th>
                      <th>Name </th>
                      <th style="width: 20%">Permissions </th>
                      <th>Type</th>
                      <th style="width: 40px">Settings</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($permissions as $permission)
                    <tr id="permission_{{$permission->id}}_row">
                      <td>{{$loop->index + 1}}</td>
                      <td>{{$permission->name}}</td>
{{-- 
                      <td>
                        <a href="#" type="button" class="btn btn-block btn-outline-primary btn-sm">({{$permission->permissions_count}})  Permission/s </a>
                    </td> --}}
                      {{-- <td>{{$permission->guard_name}}</td> --}}
                      
                      {{-- <td><span class="badge @if($permission->active) bg-success @else bg-danger @endif">@if($permission->active) Active @else IN-Active @endif</span></td> --}}
                      <td>
                        <span class="badge  bg-success ">{{$permission->guard_name}}</span>
                      </td>
                      <td>
                        <div class="form-group clearfix">
                            <div class="icheck-primary d-inline">
                              <input onclick="performUpdate" type="checkbox" id="permission{{$permission->id}}_check_box" @checked($permission->assigned)>
                              <label for="permission{{$permission->id}}_check_box">
                              </label>
                            </div>
                        </div>                          
                        {{-- <a href="{{route('permissions.edit',$permission->id)}}" class="btn btn-warning ">
                          <i class="fas fa-edit"></i>

                        </a>
                        <a href="#"  onclick="performDelete('{{$permission->id}}')" class="btn btn-danger">
                          <i class="fas fa-trash"></i>
                        </a> --}}
                      
                       {{-- <form method="POST" action="{{route('permissions.destroy',$permission->id)}}">
                      @method('DELETE')
                      @csrf
                      <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i>
                      </button>
                                          </form> --}}
                    </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                </ul>
              </div>
            </div>
            <!-- /.card -->

            <!-- /.card -->
          </div>
          <!-- /.col -->
        
        </div>
         <!-- /.row -->
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

 
@section('scripts')
  <script>
 
  function performUpdate(permissionId) {
    axios.put('/cms/admin/users/{{$user->id}}/permissions',
    {
      permission_id : permissionId
    })
    .then(function (response) {
      // handle success
      console.log(response);
      toastr.success(response.data.message);
      
      
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