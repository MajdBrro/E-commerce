@extends('layouts.admin')
@section('content')
<div class="card">
    <h5 class="card-header">{{__('admin/sidebar.shipping_methods_Edit')}}</h5>
    <div class="card-body">
      <form method="post" action="{{ route('update.shippings.methods', $shippingMethod->id) }}">
        {{csrf_field()}}
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">{{__('admin/sidebar.shipping_method_name')}} <span class="text-danger">*</span></label>
        <input id="inputTitle" type="text" name="value" placeholder="{{ $shippingMethod -> value }}"  value="{{ $shippingMethod -> value }}" class="form-control">
        @error('value')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="form-group">
          <label for="price" class="col-form-label">{{__('admin/sidebar.shipping_Cost')}} <span class="text-danger">*</span></label>
        <input id="price" type="number" name="plain_value" placeholder="{{ $shippingMethod -> plain_value }}"  value="{{ $shippingMethod -> plain_value }}" class="form-control">
        @error('plain_value')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        {{-- <div class="form-group">
          <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-control">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
          </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div> --}}
        <div class="form-group mb-3">
          <button type="reset" class="btn btn-warning">{{__('admin/sidebar.Undo')}}</button>
           <button class="btn btn-success" type="submit">{{__('admin/sidebar.Save')}}</button>
        </div>
      </form>
    </div>
</div>

@endsection
