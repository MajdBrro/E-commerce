<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Ecommerce Laravel - Login Panel</title>

  <!-- Custom fonts for this template-->
  <link href="{{asset('backend/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <!-- Visit 'codeastro' for more projects -->
  <link href="{{asset('backend/css/sb-admin-2.min.css')}}" rel="stylesheet">
  @stack('styles')
</head>

<body class="bg-gradient-info">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9 mt-5">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Admin Login Panel</h1>
                  </div>
                  @include('dashboard.includes.alerts.errors')
                  @include('dashboard.includes.alerts.success')
                  <form class="user"  method="POST" action="{{ route('save.admin.login') }}">
                    @csrf
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..."  required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="exampleInputPassword" placeholder="Password"  name="password" required autocomplete="current-password">
                         @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember_me" id="remember_me" {{ old('remember_me') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember_me">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-user btn-block">
                      Login
                    </button>
                  </form>
                  <hr>

                  <div class="text-center">
                    {{-- @if (Route::has('password.request')) --}}
                        <a class="btn btn-link small" href="{{-- route('password.request') --}}">
                            Forgot Your Password?
                        </a>
                    {{-- @endif --}}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
<!-- Visit 'codeastro' for more projects -->
    </div>

  </div>
</body>

</html>
