@extends('admin.layouts.master')

@section('head', 'Coupon List')


@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">

        <div class="col-md-6">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Products</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Obtained Coupons</th>
                                    <th>Used Coupons</th>
                               

                                </tr>
                            </thead>

                            @foreach($store->product as $product)
                                <tr>
                                    <th>{{ $product->name }}</th>
                                    <th><a href="{{route('admin.coupons', [$product->id, 'obtained'])}}">View Customers</a> <b> ({{ $product->coupon->count()}})</b></th>
                                    <th><a href="{{route('admin.coupons', [$product->id, 'used'])}}">View Customers</a> <b> ({{ $product->coupon->count()}})</b></th>
                                  
                                </tr>
                            @endforeach

                        
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 ">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{$store->name}}</h6>
                </div>
                <div class="card-body row">


            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Obtained</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$store->getObtainedCoupons()}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Used</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$store->getUsedCoupons()}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Products</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$store->product->count()}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>



       



 
                </div>
            </div>
        </div>

    </div>
</div>

@endsection 