@extends('admin.layouts.master')

@section('head', 'Menu Types')

@section('content')






<!-- Begin Page Content -->
<div class="container-fluid">


    <div class="pull-right" style="height: 70vh;">
        <div class="card-body p-0">
            <div class="row">
    
         
    
              





                <div class="col-md-4">
                    <div class="card shadow mb-12" style="width:100%">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Update Branch</h6> 
                            
    
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <form class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8" method="POST" action="{{ route('supplier.update') }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id" value="{{$supplier->id}}">
                
                                    <div class="form-group">
                                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                                            Name:
                                        </label>
                                        <input id="name" type="name" value="{{$supplier->name}}"
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
                                            value="{{$supplier->phone}}"   autofocus>
                
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
                                            value="{{$supplier->address}}"    autofocus>
                
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