@extends('layouts.admin')
@section('content')
@section('title')
Create Tags
@endsection
@section('content')

<div class="card">
    <h5 class="card-header">Add Tags</h5>
    <div class="card-body">
        <form class="form"
            action="{{route('admin.tags.store')}}"
            method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Name</label>
          <input id="inputTitle" type="text" name="name" placeholder="Enter title"  value="{{old('title')}}" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Slug</label>
          <input id="inputTitle" type="text" name="slug" placeholder="Enter title"  value="{{old('title')}}" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="status" class="col-form-label">Status</label>
          <select name="status" class="form-control">
            <option value="1">Available</option>
            <option value="0">Not Available</option>
          </select>
          @error('status')
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


