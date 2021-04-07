@extends('layouts.auth')

@section('content')
<div class="login-box">
  <div class="login-logo">
    <img src="{{asset($LOGO->value)}}" width="80" alt=""> <br>
    <a href="{{route('home.index')}}"><b>{{$NAME->value??'Reset password'}}</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
      <x-input-error />
      @if (session('status'))
      <div class="mb-4 text-info text-center">
          {{ session('status') }}
          </div>
      @endif
      <form action="{{route('password.update')}}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{request()->segment(2)}}">
        {{-- <input type="hidden" name="email" value="{{ $email??old('email') }}"> --}}
        
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email" value="{{ request()->query('email')??old('email') }}" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" required autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Change password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="{{route('login')}}">Login</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
@endsection