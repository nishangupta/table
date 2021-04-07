@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Reservation</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
            <li class="breadcrumb-item active">Create</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="card card-outline card-primary">
        <div class="card-header">
          <h3 class="card-title">Create</h3>
          <a href="{{route('reservation.index')}}" class="btn btn-sm btn-primary float-right">Go back</a>
        </div>
        <div class="card-body text-muted">
          <x-input-error />

          <form action="{{route('reservation.store')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
              <div class="col-4">
                <div class="form-group">
                  <label for="">First Name</label>
                  <input type="text" name="name" placeholder="name" value="{{old('name')}}" class="form-control" required>
                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label for="">No of people</label>
                    <input type="number" name="person" placeholder="person" value="{{old('person')??1}}"  class="form-control" required>
                  </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                <label for="">Phone</label>
                  <input type="string" name="phone" placeholder="phone" value="{{old('phone')}}"  class="form-control">
                </div>
              </div>

              <div class="col-6">
                <div class="form-group">
                  <label for="">Reservation date (MM/DD/YYYY)</label>
                  <input type="date" name="reservation_date" placeholder="reservation_date" value="{{old('reservation_date')}}" class="form-control" required>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label for="">Reservation Time</label>
                  <input type="time" name="reservation_time" placeholder="reservation_time" value="{{old('reservation_time')}}" class="form-control" required>
                </div>
              </div>

              <div class="col-12">
                <div class="form-group">
                  <label for="">Tables</label>
                  <select name="table[]" id="selectize" multiple required>
                    @foreach($tables as $t)
                    <option value="{{$t->id}}">{{$t->title}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
             
            <div>

            <button type="submit" class="btn btn-primary mt-4">Submit</button>

          </form>
        </div>
      </div>
    </div>
  </section>

</div>
@endsection

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

@endpush

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<script>
 $(document).ready(function () {
    const tables = @json($tables)

    $('#selectize').selectize({
        sortField: 'text',
        onChange: function(value) {
          setRate(value);
        }
    });

    function setRate(id){
      let table = tables.find(i=>i.id == id)
      $('#rate').val(table.rate)
      // alert(room)      
    }

  })
</script>
@endpush