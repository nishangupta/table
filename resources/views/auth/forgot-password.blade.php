@extends('layouts.auth')

@section('content')
<div class="login-box">
  <div class="login-logo">
    <img src="{{asset($LOGO->value)}}" width="80" alt=""> <br>
    <a href="{{route('home.index')}}"><b>{{$NAME->value??'Forgot Password'}}</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
      <x-input-error />
      @if (session('status'))
          <div class="mb-4 text-info text-center">
              {{ session('status') }}
          </div>
      @endif
    
      <form action="{{route('password.email')}}" method="post">
        @csrf 
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email" autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Request new password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="{{route('login')}}">Login</a>
      </p>
      {{-- <p class="mb-0">
        <a href="{{route('register')}}" class="text-center">Register now</a>
      </p> --}}
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
@endsection