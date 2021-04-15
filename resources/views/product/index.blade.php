@extends('admin.layouts.master')

@section('head', 'Products')

@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">


<div class="pull-right" style="height: 70vh;">
    <div class="card-body p-0">
        <div class="row">

     

            <div class="col-md-12">
                <div class="card shadow mb-12" style="width:100%">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">All Products <a  href="{{ route('product.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm " style="float:right"><i class="fas fa-fw fa-table fa-sm text-white-50"></i> Create New</a></h6> 
                        

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                      



                                    <th width="30">Update</th>
                                    <th width="30">Delete</th>
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{$product->name}}</td>
                                        <th><a href="{{route('product.edit', $product->id)}}" class="btn btn-info  btn-circle btn-sm "> <i
                                            class="fas fa-pencil-alt"></i></a></th>
                                        
                                <th>
                                    <a onclick="deleteCon('delfrm{{$product->slug}}');" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                                    <form id="delfrm{{$product->slug}}" action="{{route('product.destroy')}}" method="post">
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