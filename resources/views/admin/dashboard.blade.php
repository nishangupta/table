@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
  <x-alert-msg />

  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
          
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      {{-- <div class="btn-group mb-3">
        <a href="{{route('admin.index')}}" class="btn {{request()->q == ''?'btn-info':'btn-secondary'}}">Today</a>
        <a href="{{route('admin.index',['q'=>'monthly'])}}" class="btn {{request()->q == 'monthly'?'btn-info':'btn-secondary'}}">This Month</a>
        <a href="{{route('admin.index',['q'=>'yearly'])}}" class="btn {{request()->q == 'yearly'?'btn-info':'btn-secondary'}}">This Year</a>
      </div> --}}

      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h4>{{$reservationCount}}</h4>

              <p>Active Reservations</p>
            </div>
            <div class="icon">
              <i class="fas fa-check-square"></i>
            </div>
            <a href="{{route('reservation.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-navy">
            <div class="inner">
              <h4>{{$availableRoomCount}}</h4>

              <p>Rooms Available</p>
            </div>
            <div class="icon">
              <i class="fas fa-door-closed"></i>
            </div>
            <a href="{{route('room.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h4>{{$roomCount}}</h4>

              <p>Total Rooms</p>
            </div>
            <div class="icon">
              <i class="fas fa-door-open"></i>
            </div>
            <a href="{{route('room.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-olive">
            <div class="inner">
              <h4>Rs {{number_format($totalIncomes)}}</h4>

              <p>Total Billings</p>
            </div>
            <div class="icon">
              <i class="fas fa-wallet"></i>
            </div>
            <a href="{{route('income.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

       
      </div>
{{-- 
      <div class="row">
        <div class="col-6 col-sm-6 col-md-3">
          <div class="info-box shadow-hover">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cubes"></i></span>
              <div class="info-box-content">
                <a href="{{route('product.index')}}">
                  <span class="info-box-text text-dark">Rooms</span>
                  <span class="info-box-number text-dark">
                      5{{$productCount}}
                    <small>+</small>
                  </span>
                </a>
            </div>
          </div>
        </div>
        
        <div class="col-6 col-sm-6 col-md-3">
          <div class="info-box shadow-hover">
            <span class="info-box-icon bg-green elevation-1"><i class="fas fa-user-friends"></i></span>

            <div class="info-box-content">
              <a href="{{route('customer.index')}}">
                <span class="info-box-text text-dark">Guests</span>
                <span class="info-box-number text-dark">
                  6{{$customerCount}}
                </span>
              </a>
            </div>
          </div>
        </div>
    

        <div class="clearfix hidden-md-up"></div>

        <div class="col-6 col-sm-6 col-md-3">
          <div class="info-box mb-3 shadow-hover">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-envelope-open-text"></i></span>

            <div class="info-box-content">
              <a href="{{route('supplier.index')}}">
                <span class="info-box-text text-dark">Reports</span>
                <span class="info-box-number text-dark">{{$supplierCount}}</span>
              </a>
            </div>
          </div>
        </div>

        <div class="col-6 col-sm-6 col-md-3">
          <div class="info-box mb-3 shadow-hover">
            <span class="info-box-icon bg-navy elevation-1"><i class="fas fa-user-shield"></i></span>

            <div class="info-box-content">
              <a href="{{route('usermanagement.index')}}">
                <span class="info-box-text text-dark">Users</span>
                <span class="info-box-number text-dark">{{$adminCount}}</span>
              </a>
            </div>
          </div>
        </div>
      </div> --}}

      {{-- <br>

      <div class="row text-sm">
        <div class="col-12 col-md-6">
          <div class="card card-outline card-danger">
            <div class="card-header ">
              <p class="card-title text-sm">Low in Stock</p>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                  </button>
                </div>
            </div>
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Product</th>
                    <th>Minimum Stock</th>
                    <th>Current Stock</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($lowStocks as $p)
                  @php $s = $p->product @endphp
                  <tr>
                    <td><a href="{{route('product.show',$s->id)}}">{{$s->title}}</a></td>
                    <td>{{$s->minimum}}</td>
                    <td class="text-danger">{{$s->qty}}</td>
                    <td><a href="{{route('product.edit',$s->id)}}" class="btn btn-sm btn-info">Edit</a></td>
                  </tr>
                  @empty
                  <tr>
                    <td>No products in low qty</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
          </div>
    
        </div>
      </div>
    --}}
    </div>
    <!--/. container-fluid -->
  </section>
  
</div>
@endsection

@push('css')
<style>
  .shadow-hover:hover{
    transition: .35s ease;
    box-shadow: 0px 0px 15px 3px rgba(0,0,0,0.25);
  }
</style>
@endpush
