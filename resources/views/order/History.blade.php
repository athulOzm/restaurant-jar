<?php 
$members = resolve('members');
?>

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
                        <h6 class="m-0 font-weight-bold text-primary">Order History</h6>
                        
                        
                        <div class="col-md-12 mt-3" style="border-radius: 6px;background: #f5f6fa;padding: 10px;">
                            <div class="row">

                                <div class="col-md-4 mt-2">
                                    <p class="la">Miss ID</p>
                                    <select name="memberid" class="form-control  selectpicker" data-live-search="true" style="background: #fff">
                                        <option data-tokens="">All Member</option>

                                      @foreach ($members as $user)
                                          <option data-tokens="{{$user->id}}">{{$user->memberid}}</option>
                                      @endforeach
                                    </select>
                                </div>
                          
                                <div class="col-md-4 mt-2">
                                    <p class="la">Date From</p>
                                    <input name="df"  step="any"  type="datetime-local" class="form-control border-gray-400 txtb">
                                </div>

                                <div class="col-md-4 mt-2">
                                    <p class="la">Date To</p>
                                    <input name="dt"  step="any"  type="datetime-local" class="form-control border-gray-400 txtb">
                                </div>
                        
                                <div class="form-group col-md-4 mt-2">
                                    <p class="la">
                                        Payment Type:
                                    </p>
                                    <select  class="form-control " name="payment_type_id" id="paymenttype">
                                        <option value="">All</option>
                                        <option value="1">Card</option>
                                        <option value="2">Credit</option>         
                                    </select>
                                </div>
                        
                                <div class="form-group col-md-4 mt-2">
                                    <p class="la">
                                        Delivery Type:
                                    </p>
                                    <select  class="form-control " name="delivery_type" id="paymenttype">
                                        <option value="">All</option>
                                            <option value="Dinein">Dinein</option>
                                            <option value="Takeaway">Takeaway</option>
                                            <option value="Delivery">Delivery</option>
                                    </select>
                                </div>
                        
                                <div class="form-group col-md-4 mt-2">
                                    <p class="la">
                                        Delivery Location:
                                    </p>
                                    <select  class="form-control " name="payment_type_id" id="paymenttype">
                                        <option value="">All</option>
                                        <option value="1">Pool 1</option>
                                        <option value="2">Pool 2</option>
                                        <option value="3">Guarden </option>        
                                    </select>
                                </div>


                            </div>
                        </div>
                        

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