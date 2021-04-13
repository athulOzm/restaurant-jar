@extends('admin.layouts.master')

@section('head', 'Stores')

@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">

        <div class="col-md-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Stores</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Agent Name</th>
                                    <th>Coupons Details</th>
                                  

                                    



                                 
                                    <th width="30">Update</th>
                                    <th width="30">Delete</th>

                                </tr>
                            </thead>

                            @foreach(resolve('adminbind')['stores'] as $store)
           
                            <tr>
                                <th><a href="{{route('couponsList', $store->id)}}">{{ $store->name }}</a></th>
                                <th>{{ $store->agent->name }}</th>
                                <th> <a href="{{route('couponsList', $store->id)}}">View Coupons</a>   </th>
                            
     

                                <th><a href="{{route('admin.store.createUpdate', $store->id)}}" class="btn btn-info  btn-circle btn-sm "> <i class="fas fa-pencil-alt"></i></a></th>
                                <th>
                                    <a onclick="deleteCon('delfrm{{$store->id}}', 'Are you sure?, Deleting this store will remove all deals under this store.');" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                                    <form id="delfrm{{$store->id}}" action="{{route('admin.store.destroy')}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{$store->id}}">
                                    </form>
                                </th>
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
<!-- /.container-fluid -->


@endsection