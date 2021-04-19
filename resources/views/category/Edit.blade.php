<?php
$categories = resolve('allCategories');
?>
@extends('admin.layouts.master')

@section('head', 'Update Category')

@section('content')






<!-- Begin Page Content -->
<div class="container-fluid">


    <div class="pull-right" style="height: 70vh;">
        <div class="card-body p-0">
            <div class="row">
    
         
     




                <div class="col-md-6 col-sm-12" >
                    <div class="card shadow mb-12" style="width:100%">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Update Category</h6> 
                            
    
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <form class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8" method="POST" action="{{ route('category.update') }}"  enctype='multipart/form-data'>
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" value="{{$category->id}}" name="id">
                            <input type="hidden" value="{{$category->cover}}" name="curimage">
                
                                    <div class="form-group">
                                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                                            Name:
                                        </label>
                                        <input id="name" type="name" value="{{$category->name}}"
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
                                                


                                                @if ($category->parant()->exists())
                                                    <option value="{{$category->parant->id}}">{{$category->parant->name}}</option>   
                                                @else
                                                    <option value="">Main</option>
                                                @endif


                                                @foreach ($categories as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                                
                                            </select>
                 
                                    </div>
    
    
                                    <div class="form-group">
                                        <label for="order" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                                            Sort Order:
                                        </label>
                                        <input id="order" type="number" value="{{$category->order}}"
                                            class="form-control w-full border-gray-400 @error('order') border-red-500 @enderror" name="order"
                                            value="0" required  autofocus>
                 
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="inputCity">Cover Image *</label>
                                        <input type="file" class="form-control-file  @error('cover') is-invalid @enderror"
                                            id="exampleFormControlFile1" accept="image/x-png,image/gif,image/jpeg,image/jpg"  name="cover" value="{{@old('cover')}}">
                                        @error('cover')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <label for="inputCity">Cover Image</label>
                                <div class="row">
                                    <div class="col-md-9">
                                        @if ($category->cover != null)
                                    <img class="img-thumbnail " src="{{env('IMAGE_PATH')}}{{ $category->cover}}" />
                                    @endif
                                    </div>
                                </div>
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