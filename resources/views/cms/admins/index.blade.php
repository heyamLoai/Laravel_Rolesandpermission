@extends('cms.parent')
@section('page-tittle','Dashboard')

@section('lg-tittle','large')
@section('main-tittle','Main' )
@section('sm-tittle','Small')

@section('styles')
  
@endsection
@section('content')
     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Bordered Table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th style="width: 5px">#</th>
                      <th>Name </th>
                      <th>Email</th>
                      <th>Gender</th>
                      <th>Active </th>
                      <th style="width: 40px">Settings</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($admins as $admin)
                    <tr id="admin_{{$admin->id}}_row">
                      <td>{{$loop->index + 1}}</td>
                      <td>{{$admin->name}}</td>
                      <td>{{$admin->email}}</td>
                      <td>{{$admin->gender_key}}</td>
                      
                      {{-- <td><span class="badge @if($admin->active) bg-success @else bg-danger @endif">@if($admin->active) Active @else IN-Active @endif</span></td> --}}
                      <td>
                        <span class="badge @if($admin->active) bg-success @else bg-danger @endif">{{$admin->active_key}}</span></td>
                      <td>
                        <div class="btn-group">
                        <a href="{{route('admins.edit',$admin->id)}}" class="btn btn-warning ">
                          <i class="fas fa-edit"></i>

                        </a>
                        <a href="#"  onclick="performDelete('{{$admin->id}}')" class="btn btn-danger">
                          <i class="fas fa-trash"></i>
                        </a>
                      
                       {{-- <form method="POST" action="{{route('admins.destroy',$admin->id)}}">
                      @method('DELETE')
                      @csrf
                      <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i>
                      </button>
                                          </form> --}}
                      </div> 
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
  function confirmDelete(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
          if (result.isConfirmed) {
            performDelete(id);
           
          }
      })
    }
  function performDelete(id) {
    axios.delete('/cms/admin/admins/'+id) 
    .then(function (response) {
      // handle success
      console.log(response);
      // toastr.success(response.data.message);
      showSwalMessage(response.data);
      document.getElementById('admin_'+id+'_row').remove();
      
      
      
    })
    .catch(function (error) {
      // handle error 
      console.log(error);
      // toastr.error(error.data.response.message);
      showSwalMessage(error.response.data)
    })
    .then(function () {
      // always executed

    });
  }
  function showSwalMessage(data){
     Swal.fire(
      data.tittle,
      data.message
      data.icon,
              
              
            )
  }
  </script>
@endsection