@extends('admin.layouts.master')

@section('head', 'Menus')

@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">


<div class="pull-right" style="height: 70vh;">
    <div class="card-body p-0">
        <div class="row">

     

            <div class="col-md-12">
                <div class="card shadow mb-12" style="width:100%">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Menus Stocks </h6> 
                        

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="20">ID</th>
                                        <th  width="40">image</th>

                                        <th>Name</th>
                                        <th>Stock Available</th>
                                        <th>Add Stock</th>
                                        <th>Update Stock</th>
                                        <th>Stock log</th>
                                        {{-- <th>Category</th>
                                        <th>Menu Type</th> --}}
                                       
                                       
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{$product->id}}</td>

                                        <td> 
                                            @if ($product->cover != null)
                                            <img class="img-thumbnail " width="40" src="{{env('IMAGE_PATH')}}{{ $product->cover}}" />
                                            @else
                                            <img class="img-thumbnail " width="40" src="{{asset('img/dummy_img')}}" />
                                            @endif
                                        </td>
                                        <td>{{$product->name}}</td>
                                        <th>{{$product->stock_available}}</th>
                                        <th><a  href="{{ route('stock.menu.create', $product->id)}}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm " style="float:right"><i class="fas fa-fw fa-plus fa-sm text-white-50"></i> Add Stock</a></th>
                                        <th><a  href="{{ route('stock.menu.update', $product->id)}}" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm " style="float:right"><i class="fas fa-fw fa-retweet fa-sm text-white-50"></i> Update Stock</a></th>

                                        <th><a  href="{{ route('stock.menu.log', $product->id)}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm " style="float:right"><i class="fas fa-fw fa-retweet fa-sm text-white-50"></i> Stock log</a></th>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div></div>

@endsection