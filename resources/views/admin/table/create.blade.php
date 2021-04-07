@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Table</h1>
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
              <h3 class="card-title">Table</h3>
              <a href="{{route('table.index')}}" class="btn btn-sm btn-primary float-right">Go back</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body text-muted">
              <x-input-error />

              <form action="{{route('table.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Title</label>
                      <input type="text" name="title" placeholder="title" value="{{old('title')}}" class="form-control" required autofocus>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="" >TableType</label>
                      <select name="table_type_id" class="form-control">
                        @foreach($tableTypes as $t)
                          <option value="{{$t->id}}">{{$t->title}}</option>
                        @endforeach
                      </select>
                    </div>
                    
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <label for="">Status</label>
                      <select name="status" class="form-control" id="">
                        <option value="open">Open</option>
                        <option value="reserved">Reserved</option>
                        <option value="closed">Closed</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                      <label for="">Chair</label>
                      <input type="number" name="chair" placeholder="chair" value="{{old('chair')}}" required class="form-control" >
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
