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
                                <li class="breadcrumb-item"><a href="{{route('admin.products.general.create')}}">Add Product</a>
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
                                                <th>Name</th>
                                                <th>Slug</th>
                                                <th>Price</th>
                                                <th>Action</th>
                                                    
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @isset($products)
                                                @foreach($products as $product)
                                                    <tr>
                                                        <td>{{$product -> name}}</td>
                                                        <td>{{$product -> slug}}</td>
                                                        <td>{{$product -> price}}</td>
                                                        <td>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                                <a href="{{route('admin.products.price',$product -> id)}}"
                                                                   class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">Price</a>

                                                                <a href="{{route('admin.products.stock',$product -> id)}}"
                                                                    class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">Stock</a>

                                                                <a href="{{route('admin.products.images',$product -> id)}}"
                                                                    class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">Photos</a>

                                                                <a href="{{route('admin.products.general.edit',$product -> id)}}"
                                                                    class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">Edit</a>

                                                                {{-- <form method="POST" action="{{route('admin.products.delete',$product->id)}}">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <a class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">Delete</a>
                                                                </form>  --}}
                                                                <td>
                                                                    {{-- <a href="{{route('admin.products.general.edit',$product -> id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" tag-toggle="tooltip" title="edit" tag-placement="bottom"><i class="fas fa-edit"></i></a> --}}
                                                                    <form method="POST" action="{{route('admin.products.delete',[$product->id])}}">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button class="btn btn-danger btn-sm dltBtn" tag-id={{$product->id}} style="height:30px; width:30px;border-radius:50%" tag-toggle="tooltip" tag-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                                                    </form>
                                                                </td>
                                                               

                                                                
                                                            </div>
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
                    {{-- {!! $products -> links() !!} --}}
                </section>
            </div>
        </div>
    </div>

    @stop
    @endsection

    @push('styles')
    <link href="{{asset('backend/vendor/tagtables/tagTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <style>
        div.dataTables_wrapper div.dataTables_paginate{
             display: none;
         }
         .zoom {
           transition: transform .2s; /* Animation */
         }
   
         .zoom:hover {
           transform: scale(3.2);
         }
    </style>
   @endpush
   
   @push('scripts')
   
    <!-- Page level plugins -->
    <script src="{{asset('backend/vendor/tagtables/jquery.tagTables.min.js')}}"></script>
    <script src="{{asset('backend/vendor/tagtables/tagTables.bootstrap4.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
   
    <!-- Page level custom scripts -->
    <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
    <script>
   
   $('#banner-dataTable').DataTable( {
       "columnDefs":[
                  {
                      "orderable":false,
                      "targets":[3,4]
                  }
              ]
          } );
   
          // Sweet alert
   
          function deletetag(id){
   
          }
    </script>
    <script>
        $(document).ready(function(){
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
            $('.dltBtn').click(function(e){
              var form=$(this).closest('form');
                 var dataID=$(this).data('id');
                // alert(tagID);
                e.preventDefault();
                swal({
                      title: "Are you sure?",
                      text: "Once deleted, you will not be able to recover this tag!",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
                  })
                  .then((willDelete) => {
                      if (willDelete) {
                         form.submit();
                      } else {
                          swal("Your Product is safe!");
                      }
                  });
            })
        })
    </script>
   @endpush
   

   

