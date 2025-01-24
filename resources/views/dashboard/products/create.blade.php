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
            action="{{route('admin.products.store')}}"
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
          <input id="inputSlug" type="text" name="Slug" placeholder="enter slug"  value="" class="form-control">
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
{{-- ########################################################### Special Options ########################################################### --}}
<h5 class="card-header">Special Options</h5>
<div class="form-group">
  <label for="size">Size</label>
            <select name="size[]" class="form-control selectpicker"  multiple data-live-search="true">
              <option value="S">Small (S)</option>
              <option value="M">Medium (M)</option>
              <option value="L">Large (L)</option>
              <option value="XL">Extra Large (XL)</option>
              <option value="2XL">Double Extra Large (2XL)</option>
            </select>
          </div>

          <div class="form-group">
            <label for="color">color</label>
            <select name="color[]" class="form-control selectpicker"  multiple data-live-search="true">
              <option value="Red">Red</option>
              <option value="Black">Black</option>
              <option value="Green">Green</option>
              <option value="Yellow">Yellow</option>
              <option value="White">White</option>
            </select>
          </div>
          
{{-- ########################################################### Special Options ########################################################### --}}
{{-- ########################################################### Price Options ########################################################### --}}
<h5 class="card-header">Price Options</h5>
<div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="projectinput1"> Product Price
                    </label>
                    <input type="number" id="price"
                           class="form-control"
                           placeholder="  "
                           value="{{old('price')}}"
                           name="price">
                           @error("price")
                           <span class="text-danger">{{$message}}</span>
                           @enderror
                          </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                    <label for="projectinput1"> Special Price
                    </label>
                    <input type="number"
                    class="form-control"
                    placeholder="  "
                    value="{{old('special_price')}}"
                    name="special_price">
                    @error("special_price")
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                  </div>
            </div>
        </div>
          
          <div class="row" >
            <div class="col-md-6">
              <div class="form-group">
                <label for="projectinput1"> Start Date
                </label>
                
                <input type="date" id="price"
                class="form-control"
                placeholder="  "
                value="{{old('special_price_start')}}"
                name="special_price_start">
                
                @error('special_price_start')
                <span class="text-danger"> {{$message}}</span>
                @enderror
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-group">
                <label for="projectinput1"> End Date
                </label>
                <input type="date" id="price"
                class="form-control"
                placeholder="  "
                value="{{old('special_price_end')}}"
                name="special_price_end">
                
                @error('special_price_end')
                <span class="text-danger"> {{$message}}</span>
                @enderror
              </div>
            </div>
        </div>
        
        
{{-- ########################################################### Price Options ########################################################### --}}
{{-- ########################################################### Stock Options ########################################################### --}}
<h5 class="card-header">Stock Options</h5>
<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label for="projectinput1"> Product Code
      </label>
      <input type="text" id="sku"
      class="form-control"
      placeholder="  "
      value="{{old('sku')}}"
      name="sku">
      @error("sku")
      <span class="text-danger">{{$message}}</span>
      @enderror
    </div>
  </div>
  
  <div class="col-md-6">
    <div class="form-group" id="managestock">
      <label for="manage_stock" class="col-form-label">Status <span class="text-danger">*</span></label>
      <select name="manage_stock" class="form-control" >
        <option value="0" selected>Out of stock</option>
              <option value="1">In Stock</option>
            </select>
            @error('manage_stock')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
        </div>
      </div>
      
    <div class="row">
      <!-- QTY  -->
      <div class="col-md-6">
        <div class="form-group">
              <label for="projectinput1">Product Status
              </label>
              <select name="in_stock" class="select2 form-control" >
                <optgroup label="Choose please">
                  <option value="1">Available</option>
                  <option value="0">UnAvailable  </option>
                </optgroup>
              </select>
              @error('in_stock')
              <span class="text-danger"> {{$message}}</span>
              @enderror
            </div>
      </div>
      <div class="col-md-6"   id="qtyDiv">
          <div class="form-group">
            <label for="projectinput1">Quantity
            </label>
            <input type="text" id="sku"
            class="form-control"
            placeholder="  "
            value="{{old('qty')}}"
            name="qty">
            @error("qty")
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
        </div>
      </div>

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
              <label for="projectinput1">is_active
              </label>
              <select name="is_active" class="select2 form-control" >
                <optgroup label="Choose please">
                  <option value="1">Active</option>
                  <option value="0">UnActive  </option>
                </optgroup>
              </select>
              @error('is_active')
              <span class="text-danger"> {{$message}}</span>
              @enderror
            </div>
      </div>
    </div>
      
      
{{-- ########################################################### Stock Options ########################################################### --}}
{{-- ########################################################### Photo ########################################################### --}}
<h5 class="card-header">Photos</h5>
<div class="form-group">
  <label for="inputPhoto" class="col-form-label">Photo</label>
        <div class="input-group">
          <span class="input-group-btn">
            <a id="lfm" class="btn btn-primary" style="color: white;">
              <i class="fa fa-picture-o"></i> Choose Photo
            </a>
            </span>
            <input id="thumbnail" class="form-control" type="file" name="photo" style="display: none;">
          </div>
          <div id="holder" style="margin-top:15px;max-height:100px;"></div>
          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
{{-- ########################################################### Photo ########################################################### --}}
        
        


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






        

        