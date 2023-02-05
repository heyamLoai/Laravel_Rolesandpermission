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
                  
                  <label>Categories</label>
                  <select class="form-control"  id="category_id">
                    <option value="-1">Select Category</option>
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                  </select> 
                </div>

                <div class="form-group">
                  <label>ٍSub-Categories</label>
                  <select class="form-control"  id="category_id">
                    <option value="-1">Select Category</option>
                    {{-- <option value="{{$category->id}}">{{$category->name}}</option> --}}
                  </select> 
                </div>
            
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name"   placeholder="Enter Name">
                </div>
                <div class="form-group">
                  <label for="info">Info</label>
                  <input type="text" class="form-control" id="info"   placeholder="Enter info">
                </div>
              </div>

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

{{-- Jquery --}}
<script>
      // $('#name').attr('disabled',true);
      // $('#sub_category_id').attr('disabled',true);
      // $('#info').attr('disabled',true);
      controlFromInputs(true);
      $('#category_id').on('change',function (){
        controlFromInputs(this.value == -1);
        $('#sub_categories_id').empty();
        if(this.value != -1){
          // alert(this.value); 
          getSubCategories(this.value);
        }else{
          $('#name').val('');
          $('#info').val('');

        }
  });
  
  function controlFromInputs(disabled){
      $('#name').attr('disabled',disabled);
      $('#sub_category_id').attr('disabled',disabled); 
      $('#info').attr('disabled',disabled); 
      
}

  function getSubCategories(categoryId){
  // Make a request for a user with a given ID
  axios.get('/cms/admin/categories/'+categoryId)

    .then(function (response) {
      // handle success
      $('#sub_categories_id').empty();
     if(response.data.subCategories.length != 0 ){
      $.each(response.data.subCategories,function(i,item){
        $('#sub_categories_id').append(new Option(item['name'], item['id']));
      });
     }else{
      // $('#sub_categories_id').attr('disabled',true);
      controlFromInputs(true);
     }
      
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
<script> 
function performSave(){
  // Make a request for a user with a given ID
  axios.post('/cms/admin/categories',{
  // to send data 
      guard: document.getElementById('guard').value,
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