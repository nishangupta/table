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
            <li class="breadcrumb-item active">Show</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="card card-outline card-primary">
        <div class="card-header">
          <p class="card-title">Reservation Info  <span class="badge badge-{{$reservation->status == 'paid'?'success':'danger'}} text-uppercase ml-1">Status : {{$reservation->status}}</span></p>
          <a href="{{route('reservation.index')}}" class="btn btn-sm btn-primary float-right">Go back</a>
        </div>
        <div class="card-body">
          <x-input-error />

          <div class="row">
            <div class="col-12 col-md-6">
              <table class="table table-striped table-bordered">
                <tbody>
                  <tr>
                    <th>Name</th>
                    <th>{{$reservation->name}}</th>
                  </tr>
                  <tr>
                    <th>Person</th>
                    <th>{{$reservation->person}}</th>
                  </tr>  
                  <tr>
                    <th>Phone</th>
                    <th>{{$reservation->phone}}</th>
                  </tr>
                </tbody>
              </table>
              
              <div class="d-flex">
                <a href="{{route('billing.create',$reservation->id)}}" class="btn btn-success btn-sm mr-3">Start billing</a>
                <a href="{{route('reservation.edit',$reservation)}}" class="btn  btn-sm btn-info mr-3">Edit</a>
                <form action="{{route('reservation.destroy',$reservation)}}" method="POST">
                  @csrf @method('delete')
                  <button type="submit" class="dltBtn btn btn-sm btn-danger">Delete</button>
                </form>
              </div>
              
            </div>
            <div class="col-12 col-md-6">
              <table class="table table-striped table-bordered">
                <tbody>
                  <tr>
                    <th>Reservation datetime</th>
                    <th>{{$reservation->reservation_date}} {{$reservation->reservation_time}}</th>
                  </tr>
                  <tr>
                    <th>Confirmation number</th>
                    <th>{{$reservation->confirmation_number}}</th>
                  </tr>
                  <tr>
                    <th>Reservation created on</th>
                    <th>{{$reservation->created_at->format('Y/m/d h:i:s')}}</th>
                  </tr>
                  <tr>
                    <th>Tables Booked</th>
                    <th>
                      @foreach($reservation->tables as $t)
                      <a href="{{route('table.show',$t->id)}}"><span class="badge badge-primary">{{$t->title}}</span></a>
                      @endforeach
                    </th>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    <div class="container-fluid">
      <div class="card card-outline card-primary">
        <div class="card-header">
          <p class="card-title">Orders</p>
        </div>
        <div class="card-body">
          @if($reservation->status !=='paid')
          <a href="{{route('order.create',$reservation->id)}}" class="btn btn-primary btn-sm mb-3">Add order</a>
          @else
          <p>Bill successfully created! Now can't add more orders.</p>
          @endif
          <table id="example1" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>Order id</th>
              <th>Cutomer name</th>
              <th>Total</th>
              <th>Paid</th>
              <th>Due</th>
              <th>Items</th>
              <th>Orderd at</th>
              <th>Actions</th>
            </tr>
            </thead>
            <tbody>
              @foreach($orders as $order)
              <tr>
                <td>{{$order->id}}</td>
                <td><a href="{{route('order.show',$order->id)}}">{{$order->customer_name}}</a></td>
                <td>{{$order->total_amount}}</td>
                <td>{{$order->paid_amount}}</td>
                <td>{{$order->due_amount}}</td>
                <td>{{$order->order_products_count}}</td>
                <td>{{$order->created_at->format('Y/m/d h:i')}}</td>
                <td>
                  <a href="{{route('order.edit',$order->id)}}" class="btn btn-xs btn-info float-left">Edit</a>
                  <form action="{{route('order.destroy',$order->id)}}" method="POST">
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
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

<script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script>
$(function () {
  $("#example1").DataTable({
    "responsive": true,
    "autoWidth": false,
    "paging":true,
    "sorting":false,
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