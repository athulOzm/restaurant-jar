@extends('admin.layouts.master')

@section('head', 'Products')

@section('content')






<!-- Begin Page Content -->
<div class="container-fluid">


    <div class="pull-right" style="height: 70vh;">
        <div class="card-body p-0">
            <div class="row">
    
         
    
                <div class="col-md-6">
                    <div class="card shadow mb-12" style="width:100%">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Categories</h6> 
                            
    
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-left text-blue-900">Order</th>
                                            <th class="text-left text-blue-900">Name</th>
                                            <th class="text-left text-blue-900">Parant</th>
                                            <th class="text-left text-blue-900">drop</th>
    
                                        </tr>
                                    </thead>
    
                                    <tbody>
                                        @forelse ($categories as $category)
                                        <tr>
                                            <td>{{$category->order}}</td>
                                            <td>{{$category->name}}</td>
                                            <td>
                                                @if ($category->parant()->exists())
                                                    {{$category->parant->name}}
                                                @endif
                                                </td>
                                            
                                            <td> <button onclick="document.getElementById({{$category->id}}).submit();" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></button> 
                                                <form id="{{$category->id}}" method="POST" action="{{ route('category.delete') }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id" value="{{$category->id}}">
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





                <div class="col-md-6">
                    <div class="card shadow mb-12" style="width:100%">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add Categories</h6> 
                            
    
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <form class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8" method="POST" action="{{ route('category.store') }}">
                                    @csrf
                
                                    <div class="form-group col-md-4">
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
    
                                    <div class="form-group col-md-4">
                                        <label for="parant" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                                            Parant:
                                        </label>
                                       
                                            
    
                                            <select class="form-control w-full border-gray-400" name="parant">
                                                <option value="">Main</option>
                                                @foreach ($categories as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                                
                                            </select>
                 
                                    </div>
    
    
                                    <div class="form-group col-md-4">
                                        <label for="order" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                                            Order:
                                        </label>
                                        <input id="order" type="number"
                                            class="form-control w-full border-gray-400 @error('name') border-red-500 @enderror" name="order"
                                            value="0" required  autofocus>
                 
                                    </div>
    
                                    
                                    <button type="submit"  
                                    class="btn1">
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