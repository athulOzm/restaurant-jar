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
                            <h6 class="m-0 font-weight-bold text-primary">Stocks

                            
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                           
                                            <th class="text-left text-blue-900">Product</th>
                                            <th class="text-left text-blue-900">Branch</th>
                                            <th class="text-left text-blue-900">Stock</th>
                                       
                                          
                                         
    
                                        </tr>
                                    </thead>
    
                                    <tbody>
                                        @forelse ($stocks as $stock)
                                        <tr>
                                           
                                            <td>{{$stock->product->name}}</td>
                                            <td> {{$stock->branch->name}}</td>
                                            <td>{{$stock->quantity}} {{$stock->product->unit->unit_name}}</td>

                                    
                                         
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