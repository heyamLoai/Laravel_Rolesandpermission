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
                      <th style="width: 40px">Settings</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($categories as $category)
                    <tr id="category_{{$category->id}}_row">
                      <td>{{$loop->index + 1}}</td>
                      <td>{{$category->name}}</td>
{{-- 
                      <td>
                        <a href="{{route('category.edit-permissions',$category->id)}}" type="button" class="btn btn-block btn-outline-primary btn-sm">({{$category->permissions_count}})  Permission/s 
                        </a>
                    </td> --}}
                    
                   
                        <div class="btn-group">
                        <a href="{{route('categories.edit',$category->id)}}" class="btn btn-warning ">
                          <i class="fas fa-edit"></i>

                        </a>
                        <a href="#"  onclick="performDelete('{{$category->id}}')" class="btn btn-danger">
                          <i class="fas fa-trash"></i>
                        </a>
                      
                       {{-- <form method="POST" action="{{route('categories.destroy',$category->id)}}">
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
    axios.delete('/cms/admin/categories/'+id) 
    .then(function (response) {
      // handle success
      console.log(response);
      // toastr.success(response.data.message);
      showSwalMessage(response.data);
      document.getElementById('category_'+id+'_row').remove();
      
      
    })
    .catch(function (error) {
      // handle error 
      console.log(error);
      // toastr.error(error.data.response.message);
      showSwalMessage(error.response.data.message)
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