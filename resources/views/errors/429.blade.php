@extends('layouts.auth')

@section('content')
<div class="login-box">
  <div class="login-logo">
    <a href="{{route('home.index')}}"><b>Login</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>
      <x-input-error />

      <div class="alert alert-warning">You logged in too many times. Please wait before retrying.</div>
    
      <form action="{{route('login')}}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email" value="{{old('email')}}" required autofocus>
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
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" name="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-1 mt-4">
        <a href="{{route('password.request')}}">I forgot my password</a>
      </p>
      <p class="mb-0 mt-2">
        <a href="{{route('register')}}" class="text-center">Register now</a>
      </p>
      
      <p class="mb-0 mt-2 float-right">
        <a href="{{route('home.index')}}" class="text-center">Go back</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
@endsection