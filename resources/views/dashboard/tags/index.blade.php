@extends('layouts.admin')
@section('title')
Tags Index
@endsection
@section('content')

<!-- tagTales Example -->
<div class="card shadow mb-4">
    <div class="row">
        <div class="col-md-12">
            @include('dashboard.includes.notification')
            @include('dashboard.includes.alerts.success')
            @include('dashboard.includes.alerts.errors')
        </div>
    </div>
   <div class="card-header py-3">
     <h6 class="m-0 font-weight-bold text-primary float-left">Tags List</h6>
     <a href="{{route('admin.tags.create')}}" class="btn btn-primary btn-sm float-right" tag-toggle="tooltip" tag-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add Tag</a>
   </div>
   <div class="card-body">
     <div class="table-responsive">
       @if(count($tags)>0)
       <table class="table table-bordered table-hover" id="post-category-tagTable" width="100%" cellspacing="0">
         <thead>
           <tr>
             <th>#</th>
             <th>Name</th>
             <th>Slug</th>
             <th>Status</th>
             <th>Action</th>
           </tr>
         </thead>
         <tbody>
            @isset($tags)
            @foreach($tags as $tag)               <tr>
                   <td>{{$tag->id}}</td>
                   <td>{{$tag->name}}</td>
                   <td>{{$tag->slug}}</td>
                   <td>
                    @if($tag->is_active=='1')
                        <span class="badge badge-success"> {{__('admin.available')}}</span>
                    @else
                        <span class="badge badge-danger">{{ __('admin.un_available')}}</span>
                    @endif
                  </td>
                   <td>
                       <a href="{{route('admin.tags.edit',$tag->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" tag-toggle="tooltip" title="edit" tag-placement="bottom"><i class="fas fa-edit"></i></a>
                   <form method="POST" action="{{route('admin.tags.delete',[$tag->id])}}">
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
       <span style="float:right">{{$tags->links()}}</span>
       @else
         <h6 class="text-center">No Post Tag found!!! Please create post tag</h6>
       @endif
     </div>
   </div>
</div>
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
                       swal("Your tag is safe!");
                   }
               });
         })
     })
 </script>
@endpush
