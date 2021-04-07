<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Invoice Print</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">

  <link rel="stylesheet" href="{{asset('css/adminlte.min.css')}}">
</head><body>
  <div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
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
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          To
          <address>
            <strong>{{$order->customer_name}}</strong><br>
            Phone: {{$order->reservation->phone}}<br>
            Room: {{$order->reservation->room->name}}
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
        <!-- /.col -->
      </div>
      <!-- /.row -->
  
      <!-- Table row -->
      <div class="row">
        <div class="col-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Qty</th>
              <th>Product</th>
              <th>Qty</th>
              <th>Description</th>
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
          {{-- <p class="lead">Amount Due 2/22/2014</p> --}}
  
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
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- ./wrapper -->
  
  <script type="text/javascript"> 
    window.addEventListener("load", window.print());
  </script>
  </body>
  </html>