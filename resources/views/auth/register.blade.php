@extends('layouts.auth')

@section('content')
<div class="register-box">
  <div class="register-logo">
    <img src="{{asset($LOGO->value)}}" width="80" alt=""> <br>
    <a href="{{route('home.index')}}"><b>{{$NAME->value??'Register'}}</b></a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new account</p>

      <x-input-error />
      @if (session('status'))
      <div class="mb-4 text-info text-center">
              {{ session('status') }}
          </div>
      @endif
      <form action="{{route('register')}}" method="POST">
        @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Full name" value="{{old('name')}}" name="name" required autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" value="{{old('email')}}" name="email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Retype password" name="password_confirmation" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree" name="remember" required> 
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4 mt-2">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      {{-- <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google
        </a>
      </div> --}}

      <a href="{{route('login')}}" class="text-center">I already have a account</a>

      <p class="mb-0 mt-2">
        <a href="{{route('home.index')}}" class="text-center">Go back</a>
      </p>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
@endsection