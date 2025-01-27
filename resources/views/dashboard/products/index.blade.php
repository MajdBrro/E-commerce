@extends('layouts.admin')
@section('content')
@section('title')
Products
@endsection
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> All Products </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item active"> Products
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Products</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                @include('dashboard.includes.alerts.success')
                                @include('dashboard.includes.alerts.errors')

                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <table
                                            class="table display nowrap table-striped table-bordered scroll-horizontal">
                                            <thead class="">
                                            <tr>
                                                <th>#</th>
                                                    <th>Name</th>
                                                    <th>Price</th>
                                                    <th>special_price</th>
                                                    <th>sku</th>
                                                    <th>Quantity</th>
                                                    <th>in_stock</th>
                                                    <th>is_active</th>
                                                    <th>photo</th>
                                                    <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @isset($products)
                                                @foreach($products as $product)
                                                    <tr>
                                                        <td>{{$product -> name}}</td>
                                                        <td>{{$product -> price}}</td>
                                                        <td>{{$product -> special_price}}</td>
                                                        <td>{{$product -> sku}}</td>
                                                        <td>{{$product -> qty}}</td>
                                                        <td>{{$product -> in_stock}}</td>
                                                        <td>{{$product -> getActive()}}</td>
                                                        <td> <img style="width: 150px; height: 100px;" src="{{ $products->photo }}"></td>
                                                        <td>
                                                            <a href="{{route('admin.products.edit',$tag->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" tag-toggle="tooltip" title="edit" tag-placement="bottom"><i class="fas fa-edit"></i></a>
                                                        <form method="POST" action="{{route('admin.products.delete',[$tag->id])}}">
                                                          @csrf
                                                          @method('delete')
                                                              <button class="btn btn-danger btn-sm dltBtn" tag-id={{$tag->id}} style="height:30px; width:30px;border-radius:50%" tag-toggle="tooltip" tag-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                                            </form>
                                                        </td>                                                        
                                                    </tr>
                                                @endforeach
                                            @endisset


                                            </tbody>
                                        </table>
                                        <div class="justify-content-center d-flex">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! $products -> links() !!}
                </section>
            </div>
        </div>
    </div>

    @stop
    @endsection
