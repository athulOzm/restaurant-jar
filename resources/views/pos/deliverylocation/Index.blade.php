<?php $branches = resolve('branches');?>


@extends('admin.layouts.master')

@section('head', 'Menu Types')

@section('content')






<!-- Begin Page Content -->
<div class="container-fluid">


    <div class="pull-right" style="height: 70vh;">
        <div class="card-body p-0">
            <div class="row">
    
         
    
                <div class="col-md-8">
                    <div class="card shadow mb-12" style="width:100%">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Delivery Locations</h6> 
                            
    
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                           
                                            <th class="text-left text-blue-900">ID</th>
                                            <th class="text-left text-blue-900">Name</th>
                                            <th class="text-left text-blue-900">Branch</th>

                                           
                                          
                                            <th class="text-left text-blue-900"  width="60">Action</th>
                                         

    
                                        </tr>
                                    </thead>
    
                                    <tbody>
                                        @forelse ($deliverylocations as $deliverylocation)
                                        <tr>
                                           
                                            <td>{{$deliverylocation->id}}</td>
                                            <td>{{$deliverylocation->name}}</td>
                                            <td>{{$deliverylocation->branch->full_name}}</td>

                                            
                                           
                                        
                                            <th><a href="{{route('pos.deliverylocation.edit', $deliverylocation->id)}}" class="btn btn-secondary  btn-circle btn-sm "> <i
                                                class="fas fa-pencil-alt"></i></a> 

                                            <button style="margin-left: 10px" onclick="deleteCon('delfrm{{$deliverylocation->id}}');" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></button> 
                                                <form id="delfrm{{$deliverylocation->id}}" method="POST" action="{{ route('pos.deliverylocation.delete') }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id" value="{{$deliverylocation->id}}">
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





                <div class="col-md-4">
                    <div class="card shadow mb-12" style="width:100%">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add New table</h6> 
                            
    
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <form class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8" method="POST" action="{{ route('pos.deliverylocation.store') }}">
                                    @csrf

                                    <div class="form-group">
                                        <label for="branch_id" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                                            Branches:
                                        </label>
                                            <select required class="form-control w-full border-gray-400" name="branch_id">
                                                <option value=""> Choose Branch</option>
                                                @foreach ($branches as $item)
                                                <option value="{{$item->id}}">{{$item->full_name}}</option>
                                                @endforeach
                                            </select>
                                    </div>
                
                                    <div class="form-group">
                                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                                            Name:
                                        </label>
                                        <input id="name" type="name"
                                            class="form-control w-full border-gray-400 @error('name') border-red-500 @enderror" name="name"
                                            value="{{ old('name') }}" required  autofocus>
                
                                            @error('name')
                                            <p class="text-red-500 text-xs italic mt-4">
                                                {{ $message }}
                                            </p>
                                            @enderror
                                    </div>


                        
    
                                   
    
                                    
                                    <button type="submit"  
                                    class="btn1 btn-primary btn">
                                        Submit
                                    </button>
                
                                    
                                    
                
                                    
                                </form>

                            </div>
                        </div>
                    </div>
                </div>





            </div>
        </div>

    </div>

</div>


 
    
    @endsection