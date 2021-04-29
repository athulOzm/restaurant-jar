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
                        <h6 class="m-0 font-weight-bold text-primary">All Menus <a  href="{{ route('product.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm " style="float:right"><i class="fas fa-fw fa-table fa-sm text-white-50"></i> Create New</a></h6> 
                        

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="width: 65px">image</th>
                                        <th>Name</th>
                                        <th>Qty Available</th>

                                        <th width="80">Status</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Menu Type</th>
                                        <th>Created at</th>

                                      



                                    <th width="30">Update</th>
                                    <th width="30">Delete</th>
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td> 
                                            @if ($product->cover != null)
                                            <img class="img-thumbnail " width="60" src="{{env('IMAGE_PATH')}}{{ $product->cover}}" />
                                            @endif
                                        </td>

                                        <td>{{$product->name}}</td>
                                        <td>{{$product->getAvailableQty()}} </td>

                                        <td> @if ($product->status) Active @else Desabled @endif </td>
                                        <td>{{$product->category->name}} </td>
                                        <td>{{$product->price}} </td>

                                        <td>@foreach ($product->types as $type)
                                            {{$type->name}}, 
                                        @endforeach </td>
                                        <td>{{ \Carbon\Carbon::parse($product->created_at)->toFormattedDateString() }} </td>


                                        
                                        <th><a href="{{route('product.edit', $product->id)}}" class="btn btn-info  btn-circle btn-sm "> <i
                                            class="fas fa-pencil-alt"></i></a></th>
                                        
                                <th>
                                    <a onclick="deleteCon('delfrm{{$product->id}}');" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                                    <form id="delfrm{{$product->id}}" action="{{route('product.destroy')}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{$product->id}}">
                                    </form>
                                </th>
                                    
                                    </tr>
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