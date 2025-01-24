<!DOCTYPE html>
<html class="loading" lang="{{ app() -> getLocale() === 'ar' ? 'ar' : 'en'}}" data-textdirection="{{ app() -> getLocale() === 'ar' ? 'rtl' : 'ltr'}}">

<head>
 
  {{-- ###########################################################################3 --}}
  <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/vendors/css/file-uploaders/dropzone.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/'.getFolder().'/plugins/file-uploaders/dropzone.css')}}">
  <script src="{{asset('assets/admin/vendors/js/extensions/dropzone.min.js')}}" type="text/javascript"></script>
  <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/'.getFolder().'/vendors.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/'.getFolder().'/app.css')}}">
  {{-- ###########################################################################3 --}}

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
<link href="{{asset('backend/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <!-- Visit 'codeastro' for more projects -->
    <link href="{{asset('backend/css/sb-admin-2.min.css')}}" rel="stylesheet">
    @stack('styles')

</head>
<body id="page-top">
  
  <!-- Page Wrapper -->
  <div id="wrapper">
    
    <!-- Sidebar -->
    @include('dashboard.includes.sidebar')
    <!-- End of Sidebar -->
    
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      
      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        @include('dashboard.includes.header')
        <!-- End of Topbar -->
        
        <!-- Begin Page Content -->
        @yield('content')
        <!-- /.container-fluid -->
        
      </div>
      <!-- End of Main Content -->
      @include('dashboard.includes.footer')
      
      @yield('script')


    </body>
    
    </html>
    