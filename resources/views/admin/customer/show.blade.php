@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Customer</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('customer.index')}}">Customers</a></li>
            <li class="breadcrumb-item active">Show</li>
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
              <h3 class="card-title font-weight-bold">{{$customer->name}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <x-input-error />

              <div class="row">
                <div class="col-12 col-md-6">
                  <div class="mb-3">
                    <p>Email: {{$customer->email}}</p>
                  </div>
    
                  <div class="mb-3">
                    <p>Phone: {{$customer->phone}}</p>
                  </div>

                  <div class="mb-3">
                    <p>Address: {{$customer->address}}</p>
                  </div>
    
                  <div class="mb-3">
                    <p class="h5">Pending Balance: <span class="text-danger">{{ number_format($pendingBal)}}</span></p>
                  </div>

                </div>

                <div class="col-12 col-md-6">
                  <div class="mb-3">
                    <p>Created at: {{$customer->created_at}}</p>
                  </div>
    
                  <div class="mb-3">
                    <p>Updated at:{{$customer->updated_at}}</p>
                  </div>

                  <div class="d-flex">
                    <a href="{{route('customer.edit',$customer)}}" class="btn btn-info btn-sm mr-3">Edit Customer</a>
                    <form action="{{route('customer.destroy',$customer)}}" method="POST">
                      @csrf @method('delete')
                      <button type="submit" class="dltBtn btn btn-danger btn-sm">Delete Customer</button>
                    </form>
                  </div>
                </div>
            </div>

            <hr>

            <h4>All sales</h4>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>Sale No</th>
                    <th>Sale Description</th>
                    <th>Total Items</th>
                    <th>Total Amount</th>
                    <th>Paid</th>
                    <th>Due</th>
                    <th>Payment</th>
                    <th>Sale Date</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($sales as $sale)
                    <tr>
                      <td>{{$sale->id}}</td>
                      <td>{{$sale->details??'-----'}}</td>
                      <td>{{$sale->sale_products_count}}</td>
                      <td>{{number_format($sale->total_amount)}}</td>
                      <td>{{number_format($sale->paid_amount)}}</td>
                      <td>{{number_format($sale->due_amount)}}</td>
                      <td>{{$sale->payment_type}}</td>
                      <td>{{$sale->updated_at}}</td>
                      <td>
                        <a href="{{route('sale.show',$sale->id)}}" class="btn btn-sm btn-primary float-left">Show</a>
                        <a href="{{route('sale.edit',$sale->id)}}" class="btn btn-sm btn-info float-left">Edit</a>
                      </td>
                    </tr>
                  @empty
                    <td>No Sales Available</td>
                  @endforelse
                </tbody>
              </table>
            </div>
            {{$sales->links()}}
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