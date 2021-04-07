@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Billing</h1>
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
  
  <section class="content no-print">
    <div class="container-fluid">
      <x-alert-msg />
      <div class="card card-outline card-primary">
        <div class="card-header">
          <h3 class="card-title">{{$reservation->fname.' '.$reservation->lname}}'s reservation  <span class="badge badge-{{$reservation->status == 'paid'?'success':'danger'}} text-uppercase ml-2">Status : {{$reservation->status}}</span></h3>
          
          <div class="card-tools">
            <a href="{{route('reservation.show',$reservation->id)}}" class="btn btn-sm btn-primary">Go to reservation</a>
          </div>
        </div>
        @if($reservation->status !== "paid")
        <div class="card-body">
          <form action="{{route('billing.store')}}" method="POST">
            @csrf 
            <input type="hidden" class="form-control" name="reservation" value="{{$reservation->id}}">
            <div class="row">
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="">Service charge</label>
                  <input type="number"   class="form-control" name="service_charge" value="{{$billing->service_charge??''}}">
                  <input type="hidden"  class="form-control" name="total" value="{{$billing->total??''}}">
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="">Miscellaneous</label>
                  <input type="number"  class="form-control" name="misc" value="{{$billing->misc??''}}">
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="">Telephone Charge</label>
                  <input type="number"  class="form-control" name="telephone" value="{{$billing->telephone??''}}">
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label >Customer Feedback</label>
                  <textarea class="form-control" name="feedback" rows="1">{{$reservation->feedback??old('feedback')}}</textarea>
                </div>
              </div>
            </div>
  
            <button type="submit" class="btn btn-primary">Save</button>
          </form>
     
        </div>
        @endif
          
        </div>
      </div>
  </section>
  
  <section class="content">
    <div class="container-fluid">
  
      <div class="row">
        <div class="col-12">
          <div class="invoice p-3 mb-3">
            <div class="row">
              <div class="col-12">
                <h4>
                  <i class="fas fa-globe"></i> {{$NAME->value??''}}
                </h4>
              </div>
            </div>
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
                  <strong>{{$reservation->fname .' '. $reservation->lname}}</strong><br>
                  Phone: {{$reservation->phone}}<br>
                  Room: {{$reservation->room->name}} <br>
                  Confirmation number: {{$reservation->confirmation_number}}
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                <b>Invoice (Billing) #{{$reservation->id}}</b><br>
                <b>Issue Date:{{now()->format('Y/m/d')}}</b><br>
                Check in date: {{$reservation->checkin .' '.$reservation->checkin_time}} <br>
                Check out date: {{$reservation->checkout .' '.$reservation->checkout_time}} <br>
  
              </div>
  
            </div>
  
            <div class="row">
              <div class="col-12 table-responsive">
                <table class="table table-striped">
                  <thead>
                  <tr>
                    <th>Sn</th>
                    <th>Order date</th>
                    <th>Particular</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                  </tr>
                  </thead>
                  <tbody>
                    @forelse($orders as $order)
                      @foreach($order->orderProducts as $key=>$p)
                      <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$order->updated_at->format('d/m/Y')}}</td>
                        <td>{{$p->title}}</td>
                        <td>{{$p->qty}}</td>
                        <td>{{number_format($p->price)}}</td>
                        <td>{{number_format($p->total)}}</td>
                      </tr>
                      @endforeach
                    @empty
                    <tr>
                      <td>-</td>
                      <td></td>
                      <td></td>  
                      <td></td>  
                      <td></td>  
                      <td></td>  
                      <td></td>  
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
  
            <div class="row">
              <div class="col-6">
                
              </div>
              <div class="col-6">
                <div class="table-responsive">
                  <table class="table">
                    <tr>
                      <th style="width:50%">Sub total:</th>
                      <td>{{$subTotal}}</td>
                    </tr>
                    <tr>
                      <th style="width:50%">Paid total:</th>
                      <td>{{$paidTotal}}</td>
                    </tr>
                    <tr>
                      <th style="width:50%">Due Total:</th>
                      <td>{{$dueTotal}}</td>
                    </tr>
                    <tr>
                      <th>Rooms({{$days}} days):</th>
                      <td>{{$roomRate}}</td>
                    </tr>
                    <tr>
                      <th>Service charge:</th>
                      <td>{{$billing->service_charge??'-'}}</td>
                    </tr>
                    <tr>
                      <th>Telephone charge:</th>
                      <td>{{$billing->telephone??'-'}}</td>
                    </tr>
                    <tr>
                      <th>Miscellaneous:</th>
                      <td>{{$billing->misc??'-'}}</td>
                    </tr>
                    <tr>
                      <th>Grand Total:</th>
                      <td>{{number_format($grandTotal)}}</td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
            <div id="qrDiv">
              {!!QrCode::size(300)->generate(json_encode($reservation->confirmation_number))!!}
              {{-- <img src=" {{DNS1D::getBarcodePNG('4', 'C39+',3,33) }}" alt="barcode"   />; --}}
              @php
              //  echo DNS1D::getBarcodeHTML($reservation->confirmation_number, 'C39');
              @endphp
            </div>
            <br>
  
            <div class="row no-print">
              <div class="col-6">
                
                <button onclick="window.print()" 
                  target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</button>
                 {{-- <a href="{{route('billing.code',['reservation'=>$reservation->id])}}" class="btn btn-default"><i class="fas fa-qrcode"></i> Generate qr code</a>  --}}
                 <button class="btn btn-default" id="qrButton"><i class="fas fa-qrcode"></i> Generate code</button> 
               
              </div>
              <div class="col-6">
                @if($reservation->status !=='paid')
                <form action="{{route('billing.update',['reservation'=>$reservation->id])}}" class="float-right" method="POST">
                  @csrf @method('put')
                  <button type="submit" class="btn btn-success btn-sm">Set as paid</button>
                </form>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </section>

</div>
@endsection
@push('js')
<script>
  $(document).ready(function(){
    // $('#qrDiv').hide();
    $('#qrButton').click(function(){
      $('#qrDiv').slideToggle('fast');
    })
  })
</script>
@endpush