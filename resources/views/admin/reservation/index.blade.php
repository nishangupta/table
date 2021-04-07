@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h1>Reservation</h1>
        </div>
        <div class="col-sm-6">
          <form action="{{route('reservation.filter')}}" class="float-right" method="Get">
            <div class="form-group form-inline">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="far fa-calendar-alt"></i>
                  </span>
                </div>
                <input type="text" class="form-control" name="datepicker" id="datePicker" value="{{request()->datepicker}}" >
              </div>
            <button type="submit" class="btn btn-primary ml-2">Search</button>
          </div>
        </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <x-input-error/>
              <x-alert-msg/>

              <a href="{{route('reservation.create')}}" class="btn btn-primary float-left mr-3">Create</a>
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>People</th>
                  <th>Phone</th>
                  <th>Confirmation</th>
                  <th>ReservationDate</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($reservations as $reservation)
                  <tr>
                    <td>{{$reservation->id}}</td>
                    <td><a href="{{route('reservation.show',$reservation->id)}}">{{$reservation->name}}</a></td>
                    <td>{{$reservation->person}}</td>
                    <td>{{$reservation->phone}}</td>
                    <td>{{$reservation->confirmation_number}}</td>
                    <td>{{$reservation->reservation_date.' '.$reservation->reservation_time}}</td>
                    <td><span class="badge badge-{{$reservation->status=='pending'?'danger':'info'}}">{{$reservation->status}}</span></td>
                    <td>
                      <a href="{{route('reservation.edit',$reservation->id)}}" class="btn btn-xs btn-info float-left">Edit</a>
                      <form action="{{route('reservation.destroy',$reservation->id)}}" method="POST">
                        @csrf @method('delete')
                        <button class="btn dltBtn btn-danger btn-xs float-right">Delete</button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endpush

@push('js')
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>

<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

<script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
<script>
$(function () {
  $('#datePicker').daterangepicker({
    locale: {
      format: 'YYYY/MM/DD'
    }
  })

  $("#example1").DataTable({
    "responsive": true,
    "autoWidth": false,
    "paging":true,
    "sorting":false,
    dom: 'Bfrtip',
    buttons: [
      'copy', 'excel', 'print'
    ]
  });

  $('.dltBtn').click(function(e){
    e.preventDefault()
    if(confirm('Are you sure to delete')){
      this.form.submit();
    }
  })
});
</script>
@endpush