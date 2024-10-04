@extends('layouts.admin')
@section('title')
Edit Brands
@endsection

@section('content')
@include('dashboard.includes.alerts.success')
@include('dashboard.includes.alerts.errors')

<div class="card">
    <h5 class="card-header">Edit Brand</h5>
    <div class="card-body">
        <form class="form"
            action="{{route('admin.brands.update',$brands ->  id)}}"
            method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
        <div class="form-group">
            <div class="text-center">
                <label for="inputTitle" class="col-form-label">Picture <span class="text-danger">*</span></label>
                <img
                    style="width: 30%;"
                    src="{{ $brands->photo }}"
                    class="rounded-circle  height-250" alt="صورة الماركة  ">
            </div>
        </div>
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Name <span class="text-danger">*</span></label>
        <input id="inputTitle" type="text" name="name" placeholder="Enter brand name" value="{{$brands->name}}"   class="form-control">
        @error('name')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
            <option value="1" {{(($brands->is_active=='1')? 'selected' : '')}}>Available</option>
            <option value="0" {{(($brands->is_active=='0')? 'selected' : '')}}>NotAvailable</option>
          </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
            <label> photo </label>
            <label id="projectinput7" class="file center-block">
                <input type="file" id="file" name="photo">
                <span class="file-custom"></span>
            </label>
            @error('photo')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
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
@endpush
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script>
    $('#lfm').filemanager('image');

    $(document).ready(function() {
    $('#description').summernote({
      placeholder: "Write short description.....",
        tabsize: 2,
        height: 150
    });
    });
</script>
@endpush
