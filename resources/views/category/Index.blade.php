<?php
$categories = resolve('allCategories');
?>
@extends('admin.layouts.master')

@section('head', 'Categories')

@section('content')






<!-- Begin Page Content -->
<div class="container-fluid">


    <div class="pull-right" style="height: 70vh;">
        <div class="card-body p-0">
            <div class="row">
    
         
    
                <div class="col-md-8">
                    <div class="card shadow mb-12" style="width:100%">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Categories</h6> 
                            
    
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-left text-blue-900">SO</th>
                                        <th style="width: 65px">image</th>
                                            <th class="text-left text-blue-900">Name</th>
                                            <th class="text-left text-blue-900">Parant</th>
                                            <th class="text-left text-blue-900" width="160">Action</th>
                                            
    
                                        </tr>
                                    </thead>
    
                                    <tbody>
                                        @forelse ($categories as $category)
                                        <tr>
                                            <td>{{$category->order}}</td>
                                            <td> 
                                                @if ($category->cover != null)
                                                <img class="img-thumbnail " width="60" src="{{env('IMAGE_PATH')}}{{ $category->cover}}" />
                                                @endif
                                            </td>
                                            <td>{{$category->name}}</td>
                                            <td>
                                                @if ($category->parant()->exists())
                                                    {{$category->parant->name}}
                                                @else
                                                Main Category
                                                @endif
                                                </td>

                                                <th><a href="{{route('category.edit', $category->id)}}" class="btn btn-secondary  btn-circle btn-sm "> <i
                                                    class="fas fa-pencil-alt"></i></a>
                                            
                                             <button style="margin-left: 10px" onclick="deleteCon('delfrm{{$category->id}}', 'Deleting category will remove all Menus under this category');" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></button> 
                                                <form id="delfrm{{$category->id}}" method="POST" action="{{ route('category.delete') }}">
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





                <div class="col-md-4">
                    <div class="card shadow mb-12" style="width:100%">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add New Category</h6> 
                            
    
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <form class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8" method="POST" action="{{ route('category.store') }}"  enctype='multipart/form-data'>
                                    @csrf
                
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
    
                                    <div class="form-group">
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
    
    
                                    <div class="form-group">
                                        <label for="order" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                                            Sort Order:
                                        </label>
                                        <input id="order" type="number"
                                            class="form-control w-full border-gray-400 @error('name') border-red-500 @enderror" name="order"
                                            value="0" required  autofocus>
                 
                                    </div>

                                    <div class="form-group">
                                        <label for="inputCity">Cover Image *</label>
                                        <input type="file" class="form-control-file  @error('cover') is-invalid @enderror"
                                            id="exampleFormControlFile1" accept="image/x-png,image/gif,image/jpeg,image/jpg"  name="cover" value="{{@old('cover')}}">
                                        @error('cover')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
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