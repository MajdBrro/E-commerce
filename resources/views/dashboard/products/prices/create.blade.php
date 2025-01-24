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
            action="{{route('admin.products.price.store')}}"
            method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')


{{-- ########################################################### Price Options ########################################################### --}}
<h5 class="card-header">Price Options</h5>
<div class="row">
  <input   type="number" name="producy_id" value="{{$product -> id}}" style="display: none;">
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="projectinput1"> Product Price
            </label>
            <input type="number" id="price"
                    class="form-control"
                    placeholder="  "
                    value="{{$product -> price}}"
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
            value="{{$product -> special_price}}"
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
                value="{{$product -> special_price_start}}"
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
                value="{{$product -> special_price_end}}"
                value="{{old('special_price_end')}}"
                name="special_price_end">
                
                @error('special_price_end')
                <span class="text-danger"> {{$message}}</span>
                @enderror
              </div>
            </div>
        </div>
        
        
{{-- ########################################################### Price Options ########################################################### --}}
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






        

        