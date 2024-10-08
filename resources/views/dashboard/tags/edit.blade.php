
@extends('layouts.admin')
@section('title')
Tags Edit
@section('content')

<div class="card">
    <h5 class="card-header">Edit Post Tag</h5>
    <div class="card-body">
        <form class="form"
            action="{{route('admin.tags.update',$tags ->  id)}}"
            method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Name</label>
          <input id="inputTitle" type="text" name="name" placeholder="Enter title"  value="{{$tags->name}}" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="status" class="col-form-label">Status</label>
          <select name="is_active" class="form-control">
            <option value="1" {{(($tags->is_active=='1')? 'selected' : '')}}>Available</option>
            <option value="0" {{(($tags->is_active=='0')? 'selected' : '')}}>NotAvailable</option>
          </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group mb-3">
           <button class="btn btn-success" type="submit">Update</button>
        </div>
      </form>
    </div>
</div>

@endsection
