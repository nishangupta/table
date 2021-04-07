@extends('layouts.auth')
@section('content')
<div class="mt-5 server-error-page">
  <div class="container-fluid jumbotron  ">

    <div class="mt-5">
      <div class="text-center" >
        <h2 class="error mx-auto">500</h2>
        <p class="lead mb-5">Server Error</p>
        <p class="text-gray-500 mb-0">Something wrong encountered with server...</p>
        <a href="{{route('home.index')}}">&larr; Back to Home</a>
      </div>
    </div>
  
  </div>
</div>

@endsection

@push('css')
<style>
.server-error-page{
  min-height:80vh;
  background-color: #E9ECEF;
}
</style>
@endpush