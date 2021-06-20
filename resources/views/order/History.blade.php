<?php 
$branches = resolve('branches');
$members = resolve('members');
$locations = resolve('locations');
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
.la {
    font-size: 12px;
    margin-bottom: 5px;
}
.form-control {
 
    height: calc(1em + .95rem);
    padding: 0.275rem 1rem; border-color: rgb(211, 217, 234)
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

                        <form action="{{route('order.history')}}" method="GET">
                            @csrf
                        <div class="col-md-12 mt-3" style="border-radius: 6px;background: #f5f6fa;padding: 10px;">
                            <div class="row">

                                <div class="form-group col-md-3">
                                    <label for="branch_id" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                                        Branches:
                                    </label>
                                        <select required class="form-control w-full border-gray-400" name="branch_id">
                                            @foreach ($branches as $item)
                                                @if (isset($_GET['branch_id']) and $item->id == $_GET['branch_id'])
                                                <option selected value="{{$item->id}}">{{$item->full_name}}</option>
                                                @else
                                                <option value="{{$item->id}}">{{$item->full_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                </div>

                                <div class="col-md-3 mt-2">
                                    <p class="la">Miss ID</p>
                                    <select name="memberid" class="form-control  selectpicker" data-live-search="true" style="background: #fff">
                                        <option data-tokens="">All Member</option>

                                      @foreach ($members as $user)

                                                @if (isset($_GET['memberid']) and $user->id == $_GET['memberid'])
                                                <option selected value="{{$user->id}}">{{$user->memberid}}</option>
                                                @else
                                                <option value="{{$user->id}}">{{$user->memberid}}</option>
                                                @endif

 
                                      @endforeach
                                    </select>
                                </div>
                          
                                <div class="col-md-3 mt-2">
                                    <p class="la">Date From</p>
                                    <input name="df"  step="any"  type="datetime-local" class="form-control border-gray-400 txtb">
                                </div>

                                <div class="col-md-3 mt-2">
                                    <p class="la">Date To</p>
                                    <input name="dt"  step="any"  type="datetime-local" class="form-control border-gray-400 txtb">
                                </div>
                        
                                <div class="form-group col-md-3 mt-2">
                                    <p class="la">
                                        Payment Type:
                                    </p>
                                    <select  class="form-control " name="payment_type_id" id="paymenttype">
                                        <option value="All">All</option>
                                        <option @if (isset($_GET['payment_type_id']) and $_GET['payment_type_id'] == 1) selected @endif value="1">Card</option>
                                        <option @if (isset($_GET['payment_type_id']) and $_GET['payment_type_id'] == 2) selected @endif value="2">Credit</option>         
                                    </select>
                                </div>
                        
                                <div class="form-group col-md-3 mt-2">
                                    <p class="la">
                                        Delivery Type:
                                    </p>
                                    <select  class="form-control " name="delivery_type" id="paymenttype">
                                        <option value="All">All</option>
                                            <option @if (isset($_GET['delivery_type']) and $_GET['delivery_type'] == 'Dinein') selected @endif value="Dinein">Dinein</option>
                                            <option @if (isset($_GET['delivery_type']) and $_GET['delivery_type'] == 'Take away') selected @endif value="Take away">Takeaway</option>
                                            <option @if (isset($_GET['delivery_type']) and $_GET['delivery_type'] == 'Delivery') selected @endif value="Delivery">Delivery</option>
                                    </select>
                                </div>
                        
                                <div class="col-md-3 mt-2">
                                    <p class="la">Delivery Location</p>
                                    <select name="deliverylocation_id" class="form-control  selectpicker" data-live-search="true" style="background: #fff">
                                        <option value="All">All Location</option>

                                      @foreach ($locations as $location)

                                                @if (isset($_GET['deliverylocation_id']) and $location->id == $_GET['deliverylocation_id'])
                                                <option selected value="{{$location->id}}">{{$location->name}}</option>
                                                @else
                                                <option value="{{$location->id}}">{{$location->name}}</option>
                                                @endif

 
                                      @endforeach
                                    </select>
                                </div>


                                <div class="form-group col-md-3 mt-4">
                                    <button class="btn btn-primary btnc2 pull-right" style="float: right; font-size:11px; margin-top:5px" id="pay" type="submit">View Order Lists <i class="fas fa-arrow-right"></i></button>
                                </div>


                            </div>
                        </div>

                    </form>
                        

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
                        <a href="{{route('pos.clone', $order->id)}}" class="btn btn-info"> <i class="fas fa-clone"></i> Copy</a>
                    

                                  
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