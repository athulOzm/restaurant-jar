<?php $branches = resolve('branches');?>

@extends('admin.layouts.master')

@section('head', 'Menu Types')

@section('content')






<!-- Begin Page Content -->
<div class="container-fluid">


    <div class="pull-right" style="height: 70vh;">
        <div class="card-body p-0">
            <div class="row">
    
         
    
                <div class="col-md-12">
                    <div class="card shadow mb-12" style="width:100%">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Purchases 

                                <a  href="{{ route('purchase.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm " style="float:right"><i class="fas fa-fw fa-table fa-sm text-white-50"></i> Create New</a>  
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                           
                                            <th class="text-left text-blue-900">Date</th>
                                            <th class="text-left text-blue-900">Reference</th>
                                            <th class="text-left text-blue-900">Supplier</th>
                                            <th class="text-left text-blue-900">Purchase Status</th>
                                            <th class="text-left text-blue-900">Payment Status</th>
                                            <th class="text-left text-blue-900">Grand Total</th> 
                                          
                                            <th class="text-left text-blue-900"  width="60">Action</th>
                                         

    
                                        </tr>
                                    </thead>
    
                                    <tbody>
                                        @forelse ($purchases as $purchase)
                                        <tr>
                                           
                                            <td>{{$purchase->date}}</td>
                                            <td> {{$purchase->reference}}</td>
                                            <td>{{$purchase->supplier->name}}</td>
                                            <td>{{$purchase->purchasestatus->name}}</td>
                                            <td>{{$purchase->paymentstatus->name}}</td>
                                            <td>{{$purchase->tot_price}}</td>
                                        
                                            <th><a href="{{route('pos.table.edit', $purchase->id)}}" class="btn btn-secondary  btn-circle btn-sm "> <i
                                                class="fas fa-pencil-alt"></i></a> 

                                            <button style="margin-left: 10px" onclick="deleteCon('delfrm{{$purchase->id}}');" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></button> 
                                                <form id="delfrm{{$purchase->id}}" method="POST" action="{{ route('purchase.delete') }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id" value="{{$purchase->id}}">
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                            <tr><td>No found</td></tr>
                                           
                                        @endforelse
     
                                        
                                     
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>





                 





            </div>
        </div>

    </div>

</div>


 
    
    @endsection