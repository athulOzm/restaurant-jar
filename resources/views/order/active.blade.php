@extends('admin.layouts.master')


@section('head', 'Dashboard')


@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">


<div class="pull-right" style="height: 70vh;">
    <div class="card-body p-0">
        
 

    
            @foreach($orders as $order)
            <div class="row" style="margin-bottom: 20px">
                <div class="col-xl-8 col-md-10 col-sm-12 mb-6 " style="clear: both">
                    
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col-xl-10 col-sm-9 mr-1">
                                    <div class="text-md font-weight-bold text-primary text-uppercase mb-1">Token : 00{{$order->id}}</div>
                                    <div class="text-sm mb-0 font-weight-normal text-gray-800">Customer Name : {{$order->user->name}} ({{$order->created_at}}, RO: 24.400)</div>
                                    
                                </div>
                                <div class="col-xl-1 col-sm-2 align-items-center" style="text-align: center">
                                    <a href="">
                                        <i class="fas fa-calendar fa-2x text-blue-300" style="color: green"></i>
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Ready</div>
                                    </a>


                                </div>
                            </div>
                        </div>
                    </div>
                  
                </div>
            </div>
            @endforeach
               
        
    </div>
    </div></div>

@endsection