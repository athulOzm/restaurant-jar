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
                        <h6 class="m-0 font-weight-bold text-primary">Menus <a  href="{{ route('product.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm " style="float:right"><i class="fas fa-fw fa-table fa-sm text-white-50"></i> Create New</a></h6> 
                        

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="20">ID</th>
                                        <th  width="40">image</th>

                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Menu Type</th>
                                        <th>Stock Available</th>

                                        
                                        <th>Price</th>
                                        <th>Tax</th>
                                        

                                        <th width="50">Status</th>

                                        <th width="60">Action</th>
                                       
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

                                        <td>{{$product->name}} <span style="text-align: right; float:right"> {{$product->name_ar}}</span></td>
                                        <td>{{$product->category->name}} 
                                        @if ($product->subcategory_id != null)
                                        <i class="fas fa-angle-right"></i>  {{$product->subcategory->name}} 
                                        @endif
                                        </td>
                                        <td>@foreach ($product->types as $type)
                                            {{$type->name}}, 
                                        @endforeach </td>

                                        <td>{{$product->getAvailableQty()}} </td>

                                       
                                        <td>{{$product->price}} </td>
                                        <td>{{$product->vat}}% </td>

                                       


                                        <td> @if ($product->status) <span style="color: green"> Active</span> @else Desabled @endif </td>
                                       
                                        
                                <th>
                                    <a title="Edit" href="{{route('product.edit', $product->id)}}" class="btn btn-secondary  btn-circle btn-sm "> <i
                                        class="fas fa-pencil-alt"></i></a>

                                    <a title="Delete" style="margin-left: 10px" onclick="deleteCon('delfrm{{$product->id}}');" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash" style="color: white"></i></a>
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