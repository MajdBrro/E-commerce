@extends('layouts.admin')
@section('content')
@section('title')
Create Products
@endsection

@section('content')
<div class="card">
  <h4 class="card-header">Add Product</h5>
  <div class="card-body">
    <form class="form"
            action="{{route('admin.products.general.store')}}"
            method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

{{-- ########################################################### General Options ########################################################### --}}
<h5 class="card-header">General Options</h5>
<div class="form-group">
  <div class="form-group">
          <label for="inputTitle" class="col-form-label">Name <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="name" placeholder="Enter Name"  value="{{old('name')}}" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        
        <div class="form-group">
          <label for="inputSlug" class="col-form-label">Slug <span class="text-danger">*</span></label>
          <input id="inputSlug" type="text" name="slug" placeholder="enter slug"  value="" class="form-control">
          @error('slug')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
  
        <div class="form-group">
          <label for="summary" class="col-form-label">Description <span class="text-danger">*</span></label>
          <textarea class="form-control" id="summary" name="description">{{old('description')}}</textarea>
          @error('description')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        
        <div class="form-group">
          <label for="description" class="col-form-label">Short Description</label>
          <textarea class="form-control" id="description" name="short_description">{{old('short_description')}}</textarea>
          @error('short_description')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
  
  
        <div class="form-group">
          <label for="cat_id">Category <span class="text-danger">*</span></label>
          <select name="categories[]" id="cat_id" class="form-control selectpicker" multiple data-live-search="true">
            <option value="">--Select Multiple category--</option>
            @foreach($categories as $category)
            <option value='{{$category->id}}'>{{$category->name}}</option>
            @endforeach
          </select>
          @error('categories')
          <span class="text-danger"> {{$message}}</span>
          @enderror
        </div>
        
        <div class="form-group">
          <label for="tag_id">Tags</label>
            <select name="tags[]" class="form-control selectpicker" multiple data-live-search="true">
              <option value="">--Select Multiple Tags--</option>
              @foreach($tags as $tag)
              <option value="{{$tag->id}}">{{$tag->name}}</option>
              @endforeach
            </select>
            @error('tags')
            <span class="text-danger"> {{$message}}</span>
            @enderror
        </div>
        
        <div class="form-group">
          <label for="brand_id">Brand</label>
          <select name="brand_id" class="form-control">
            <option value="">--Select one Brand--</option>
            @foreach($brands as $brand)
            <option value="{{$brand->id}}">{{$brand->name}}</option>
            @endforeach
          </select>
          @error('brand_id')
          <span class="text-danger"> {{$message}}</span>
          @enderror
        </div>
        
      
        

        
          
{{-- ########################################################### General Options ########################################################### --}}

        
        


      <div class="form-group mb-3">
        <button type="reset" class="btn btn-warning">Reset</button>
        <button class="btn btn-success" type="submit">Submit</button>
      </div>

    </form>
  </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endpush
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script>
  $('#lfm').filemanager('image');

  $(document).ready(function() {
    $('#summary').summernote({
      placeholder: "Write short description.....",
        tabsize: 2,
        height: 100
    });
  });

  $(document).ready(function() {
    $('#description').summernote({
      placeholder: "Write detail description.....",
        tabsize: 2,
        height: 150
    });
  });
  // $('select').selectpicker();

</script>

<script>
$('#cat_id').change(function(){
  var cat_id=$(this).val();
  // alert(cat_id);
  if(cat_id !=null){
    // Ajax call
    $.ajax({
      url:"/admin/category/"+cat_id+"/child",
      data:{
        _token:"{{csrf_token()}}",
        id:cat_id
      },
      type:"POST",
      success:function(response){
        if(typeof(response) !='object'){
          response=$.parseJSON(response)
        }
        // console.log(response);
        var html_option="<option value=''>----Select sub category----</option>"
        if(response.status){
          var data=response.data;
          // alert(data);
          if(response.data){
            $('#child_cat_div').removeClass('d-none');
            $.each(data,function(id,title){
              html_option +="<option value='"+id+"'>"+title+"</option>"
            });
          }
          else{
          }
        }
        else{
          $('#child_cat_div').addClass('d-none');
        }
        $('#child_cat_id').html(html_option);
      }
    });
  }
  else{
  }
})
</script> 


<script>
  document.getElementById('lfm').addEventListener('click', function() {
      document.getElementById('thumbnail').click();
  });

  document.getElementById('thumbnail').addEventListener('change', function() {
      const file = this.files[0];
      if (file) {
          const reader = new FileReader();
          reader.onload = function(e) {
              const holder = document.getElementById('holder');
              holder.innerHTML = '<img src="' + e.target.result + '" style="max-height: 100px;"/>';
          };
          reader.readAsDataURL(file);
      }
  });
</script>

@endpush






        

        