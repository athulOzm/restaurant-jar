<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>@yield('head')</title>

  <!-- Custom fonts for this template-->
  <link rel="stylesheet" href="{{asset('dashboard/vendor/fontawesome/css/all.min.css')}}"  />
 

  <!-- Custom styles for this template-->
  <link href="{{asset('dashboard/css/admin-2.css')}}" rel="stylesheet">
<style>

form.user .form-control-user {
    font-size: 0.8rem;
    border-radius: 10rem;
    padding: 1.5rem 1rem;
}
</style>
</head>

<body class="bg-gradient-primary">
@if(Session('message'))
<div class="msgbox sucbox" > {{ Session('message') }} </div>
@endif
  <div class="container">

    <div style="text-align:center;margin: auto;margin-top: 50px; max-width: 140px;"><img style="max-width: 170px;"  src="{{asset('img/marsa.png')}}"></div>
    
  
    <!-- Outer Row -->
    <div class="row justify-content-center" >

      <div class="col-xl-5 col-lg-5 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->

              
              <div class="col-lg-12">

                <div class="p-5">
                  <div class="text-center">

                    <h1 class="h4 text-gray-900 mb-4">Admin Login</h1>

                  </div>


                    <form method="POST" class="user" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                          
                            
                                <input id="email" type="text" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required  autofocus="" placeholder="Enter Username" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                     
                        </div>

                        <div class="form-group row">
                           
                   
                                <input id="password" type="password" class="form-control form-control-user  @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"  autofocus="" placeholder="Enter Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                       
                        </div>

                        <div class="form-group row">
                           
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                         
                        </div>

                        <div class="form-group row mb-0">
                            
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    {{ __('Login') }}
                                </button>

                               
                         
                        </div>
                    </form>
                </div>
            </div>









            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('dashboard/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"   crossorigin="anonymous"></script>


  <!-- Core plugin JavaScript-->
  <script src="{{asset('dashboard/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{asset('dashboard/js/sb-admin-2.min.js')}}"></script>

</body>

</html>




 
