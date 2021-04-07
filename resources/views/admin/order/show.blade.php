@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Order</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
            <li class="breadcrumb-item active">Show</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>


  <section class="content">
    <div class="container-fluid">

      <div class="no-print">
        <a href="{{route('reservation.show',$order->reservation_id)}}" class="btn btn-primary btn-sm mb-3">Back to reservation</a>
      </div>

      <x-input-error />
      <x-alert-msg />

        <div class="row">
          <div class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> {{$NAME->value??''}}
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong>{{$NAME->value??''}}</strong><br>
                    {{$ADDRESS->value??''}}<br>
                    Phone: {{$PHONE->value??''}}<br>
                    Email: {{$EMAIL->value??'info@example.com'}}
                  </address>
                </div>
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong>{{$order->customer_name}}</strong><br>
                    Phone: {{$order->reservation->phone}}<br>
                    Confirmation number: {{$order->reservation->confirmation_number}}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Invoice #{{$order->id}}</b><br>
                  <b>Issue Date:{{$order->created_at->format('Y/m/d')}}</b><br>
                  <b>Payment type: </b> {{$order->payment_type}}<br>
                  @if($order->payment_type =='bank')
                  <b>Cheque no: </b> {{$order->chq_no}}<br>
                  <b>Cheque date: </b> {{$order->chq_date}}<br>
                  @endif
                </div>

              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Sn</th>
                      <th>Title</th>
                      <th>Qty</th>
                      <th>Price</th>
                      <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($order->orderProducts as $key=>$p)
                      <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$p->title}}</td>
                        <td>{{$p->qty}}</td>
                        <td>{{number_format($p->price)}}</td>
                        <td>{{number_format($p->total)}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                 
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>{{number_format($order->sub_total)}}</td>
                      </tr>
                      <tr>
                        <th>Discount:</th>
                        <td>{{number_format($order->discount_amount)}}</td>
                      </tr>
                      {{-- <tr>
                        <th>Tax:</th>
                        <td>{{number_format($order->tax_amount)}}</td>
                      </tr> --}}
                      <tr>
                        <th>Grand Total</th>
                        <td>{{number_format($order->total_amount)}}</td>
                      </tr>
                      <tr>
                        <th>Due:</th>
                        <td>{{number_format($order->due_amount)}}</td>
                      </tr>
                      <tr>
                        <th>Paid:</th>
                        <td>{{number_format($order->paid_amount)}}</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>

              <div class="row no-print">
                <div class="col-6">
                  <button onclick="window.print()" class="btn btn-default"><i class="fas fa-print"></i> Print</button>
                </div>
                <div class="col-6">
                  <div class="d-flex justify-content-end">
                    <a href="{{route('order.edit',$order)}}" class="btn btn-info mr-3">Edit</a>
                    <form action="{{route('order.destroy',$order)}}" method="POST">
                      @csrf @method('delete')
                      <button type="submit" class="dltBtn btn btn-danger">Delete</button>
                    </form>
                  </div>
                </div>
                
              </div>
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      
      
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@endsection

@push('js')
<script>
  $(document).ready(function(){
    $('.dltBtn').click(function(e){
      e.preventDefault();
      if(confirm('Are you sure to delete!')){
        this.form.submit();
      }
    })
  })
</script>
@endpush