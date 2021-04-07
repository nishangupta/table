@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Food</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
            <li class="breadcrumb-item active">Create</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-outline card-primary">
            <div class="card-header">
              <h3 class="card-title">Food</h3>
              <a href="{{route('food.index')}}" class="btn btn-sm btn-primary float-right">Go back</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body text-muted">
              <x-input-error />

              <form action="{{route('food.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="" >Title</label>
                      <input type="text" name="title" placeholder="title" value="{{old('title')}}" class="form-control" required autofocus>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="" >Menu Category</label>
    
                      <select name="menu_id" class="form-control">
                        @foreach($menus as $menu)
                          <option value="{{$menu->id}}">{{$menu->title}}</option>
                        @endforeach
                      </select>
                    </div>
                    
                  </div>
                </div>

                <div class="row">
                  {{-- <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <label for="">Unit</label>
                      <select name="type" class="form-control" id="">
                        <option value="fixed">Fixed</option>
                        <option value="percent">Percent</option>
                      </select>
                    </div>
                  </div> --}}
                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <label for="">Priee</label>
                      <input type="text" name="price" placeholder="price" value="{{old('price')}}" required class="form-control" >
                    </div>
                  </div>
                </div>

                <button type="submit" class="btn btn-primary mt-4">Submit</button>
                
              </form>
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
