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
                            <h6 class="m-0 font-weight-bold text-primary">Suppliers</h6> 
                            
    
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                           
                                            <th class="text-left text-blue-900">S/L</th>
                                            <th class="text-left text-blue-900">Name</th>
                                            <th class="text-left text-blue-900">phone</th>
                                            <th class="text-left text-blue-900">address</th>
                                          
                                            <th class="text-left text-blue-900"  width="60">Action</th>
                                         

    
                                        </tr>
                                    </thead>
    
                                    <tbody>
                                        @forelse ($suppliers as $supplier)
                                        <tr>
                                           
                                            <td>{{$supplier->id}}</td>
                                            <td>{{$supplier->name}}</td>
                                            <td>{{$supplier->phone}}</td>
                                            <td>{{$supplier->address}}</td>
                                        
                                            <th><a href="{{route('supplier.edit', $supplier->id)}}" class="btn btn-secondary  btn-circle btn-sm "> <i
                                                class="fas fa-pencil-alt"></i></a> 

                                            <button style="margin-left: 10px" onclick="deleteCon('delfrm{{$supplier->id}}');" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></button> 
                                                <form id="delfrm{{$supplier->id}}" method="POST" action="{{ route('supplier.delete') }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id" value="{{$supplier->id}}">
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
                            <h6 class="m-0 font-weight-bold text-primary">Add Supplier</h6> 
                            
    
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <form class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8" method="POST" action="{{ route('supplier.store') }}">
                                    @csrf
                
                                    <div class="form-group">
                                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                                            Name * :
                                        </label>
                                        <input id="name" type="text"
                                            class="form-control w-full border-gray-400 @error('name') border-red-500 @enderror" name="name"
                                            value="{{ old('name') }}" required  autofocus>
                
                                            @error('name')
                                            <p class="text-red-500 text-xs italic mt-4">
                                                {{ $message }}
                                            </p>
                                            @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="phone" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                                            Phone:
                                        </label>
                                        <input id="phone" type="text"
                                            class="form-control w-full border-gray-400 @error('phone') border-red-500 @enderror" name="phone"
                                            value="{{ old('phone') }}"   autofocus>
                
                                            @error('phone')
                                            <p class="text-red-500 text-xs italic mt-4">
                                                {{ $message }}
                                            </p>
                                            @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="address" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                                            Address:
                                        </label>
                                        <input id="address" type="text"
                                            class="form-control w-full border-gray-400 @error('address') border-red-500 @enderror" name="address"
                                            value="{{ old('address') }}"    autofocus>
                
                                            @error('address')
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