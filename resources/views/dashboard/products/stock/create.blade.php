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
            action="{{route('admin.products.stock.store')}}"
            method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

{{-- ########################################################### Stock Options ########################################################### --}}
<h5 class="card-header">Stock Options</h5>
<div class="row">
  <input   type="number" name="producy_id" value="{{$product -> id}}" style="display: none;">
</div>
<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label for="projectinput1"> Product Code
      </label>
      <input type="text" id="sku"
      class="form-control"
      placeholder="  "
      value="{{$product -> sku}}"
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
            value="{{$product -> qty}}"
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

      <div class="form-group mb-3">
        <button type="reset" class="btn btn-warning">Reset</button>
        <button class="btn btn-success" type="submit">Save</button>
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




@endpush






        

        