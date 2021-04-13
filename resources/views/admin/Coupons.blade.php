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
                    <h6 class="m-0 font-weight-bold text-primary">Customer Details  <b style="float:right"> Total {{$coupons->count()}}</b></h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Date</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    

                                </tr>
                            </thead>


                            @foreach($coupons as $coupon)
                                <tr>
                                <th>{{ $coupon->carbondate($coupon->created_at) }}</th>

                                    <th>{{ $coupon->name }}</th>
                                    <th>{{ $coupon->email }}</th>

                                    <th>{{ $coupon->phone }}</th>

                                  
                           
                                </tr>
                            @endforeach


                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

       

    </div>
</div>

@endsection 