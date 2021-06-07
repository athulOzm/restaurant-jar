@extends('admin.layouts.master')

@section('head', 'Products')

@section('content')

<style>

.btn-info {
    color: #fff;
    background-color: #36b9cc;
    border-color: #36b9cc;
    padding: 3px 5px;
    font-size: 13px;
}


</style>
<!-- Begin Page Content -->
<div class="container-fluid">


<div class="pull-right" style="height: 70vh;">
    <div class="card-body p-0">
        <div class="row">

     

            <div class="col-md-12">
                <div class="card shadow mb-12" style="width:100%">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">All Delivered</h6> 
                        

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                   


                                    <th width="30">Member ID</th>
                                    <th width="30">Receipt Id</th>
                                    <th width="30">User</th>
                                    <th width="30">Ord. Source</th>
                                    

                                    <th width="30">Amount Total</th>
                                 
 
                                    <th width="30">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                         
                                        <td>@if ($order->user)
                                            {{$order->user->memberid}}
                                        @endif</td>
                                        <td>{{$order->id}}</td>
                                       
                                        <td>@if ($order->user)
                                            {{$order->user->name}}
                                        @endif</td>
                                        <td>{{$order->getReqByAttribute()}}</td>
                                        <td>{{$order->gettotalprice()['subtotal']}}</td>
                                       
 
                                        
                                <th style="font-size: 10px">
                                    <a target="_blank" href="{{route('pos.view', $order->id)}}" class="btn btn-info"> <i class="fas fa-eye"></i> View</a>
                        <a target="_blank" href="{{route('pos.print', $order->id)}}" class="btn btn-info"> <i class="fas fa-print"></i> Reprint</a>
                        <a href="{{route('pos.clone', $order->id)}}" class="btn btn-info"> <i class="fas fa-clone"></i> Clone</a>
                        <a href="{{route('pos.update', $order->id)}}" class="btn btn-info"> <i class="fas fa-pen-square"></i> Edit</a>

                                    <a onclick="deleteCon('delfrm{{$order->id}}');" class="btn btn-danger "><i class="fas fa-trash"></i></a>
                                    <form id="delfrm{{$order->id}}" action="{{route('order.destroy')}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{$order->id}}">
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