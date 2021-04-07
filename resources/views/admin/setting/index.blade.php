@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Settings list</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
            <li class="breadcrumb-item active">Setting</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <x-input-error/>
      <x-alert-msg/>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <p class="card-title">
                Brand Logo
              </p>
             </div>    
            
            <div class="card-body">
              <div class="box box-primary">
                <div class="box-body box-profile">
                  <div class="d-flex">
                    <div class="avatar-upload">

                      <div class="avatar-edit mb-3">
                        <form action="{{route('setting.upload')}}" method="post" id="form-image" enctype="multipart/form-data">
                          @csrf
                          <input type='file' id="logo" name="logo"/>
                          <label for="logo"></label>
                          <input type="submit" value="Upload">
                        </form>
                      </div>

                      <div class="avatar-preview">
                        <img class="profile-user-img img-responsive img-circle" id="imagePreview" src="{{asset($LOGO->value??'img/1.png')}}" alt="Logo">
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Settings</h3>
              <a href="{{route('setting.create')}}" class="btn btn-primary btn-sm float-right">Create</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
    

              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Sn</th>
                  <th>title</th>
                  <th>value</th>
                  <th>Created at</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($settings as $setting)
                  <tr>
                    <td>{{$setting->id}}</td>
                    <td>{{$setting->title}}</td>
                    <td>{{$setting->value}}</td>
                    <td>{{$setting->created_at}}</td>
                    <td>
                      <a href="{{route('setting.edit',$setting)}}" class="btn btn-sm btn-info">Edit</a>
                      <form action="{{route('setting.destroy',$setting)}}" method="POST">
                        @csrf @method('delete')
                        <button class="btn dltBtn btn-danger btn-sm">Delete</button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              {{$settings->links()}}
            </div>
            <!-- /.card-body -->
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@endsection

@push('css')
<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<style>
  div.dataTables_wrapper div.dataTables_paginate{
      display: none;
  }
</style>
@endpush

@push('js')
<!-- DataTables -->
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script>
  
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
      "paging": false,
      "searching": true,
    });
    
    $('.dltBtn').click(function(e){
      e.preventDefault()

      if(confirm('Are you sure?')){
        this.form.submit()
      }
    })
  });
</script>
@endpush