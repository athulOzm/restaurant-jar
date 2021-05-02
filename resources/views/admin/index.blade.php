@extends('admin.layouts.master')


@section('head', 'Dashboard')

@section('content')





<div class="col-xl-3 col-md-3 mb-6">
    <div class="card border-left-primary  h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"></div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"> <a href="{{route('kitchen')}}">KITCHEN</a></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-md-3 mb-6">
    <div class="card border-left-primary  h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"></div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"> <a href="{{route('pos')}}">POS</a></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-md-3 mb-6">
    <div class="card border-left-primary  h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"></div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"> <a href="{{route('member.index')}}">MEMBERS</a></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-md-3 mb-6">
    <div class="card border-left-primary  h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"></div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"> <a href="{{route('order.all')}}">ORDER HISTORY</a></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-md-3 mt6" style="margin-top: 30px">
    <div class="card border-left-primary  h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"></div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"> <a href="{{route('product.index')}}">MENUS</a></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

 

 

 



 


@endsection