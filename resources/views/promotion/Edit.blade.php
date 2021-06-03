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
                            <h6 class="m-0 font-weight-bold text-primary">Update</h6> 
                            
    
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <form class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8" method="POST" action="{{ route('promotion.update') }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id" value="{{$promotion->id}}">
                
                                    <div class="form-group">
                                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                                            Name:
                                        </label>
                                        <input id="name" type="name" value="{{$promotion->name}}"
                                            class="form-control w-full border-gray-400 @error('name') border-red-500 @enderror" name="name"
                                            value="{{ old('name') }}" required  autofocus>
                
                                            @error('name')
                                            <p class="text-red-500 text-xs italic mt-4">
                                                {{ $message }}
                                            </p>
                                            @enderror
                                    </div>
    
                                    <div class="form-group">
                                        <label for="from" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                                            Time From:
                                        </label>
                                        <input id="from" type="time"  value="{{$promotion->from}}"
                                            class="form-control w-full border-gray-400 @error('from') border-red-500 @enderror" name="from"
                                            value="{{ old('from') }}" required  autofocus>
                
                                            @error('from')
                                            <p class="text-red-500 text-xs italic mt-4">
                                                {{ $message }}
                                            </p>
                                            @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="from" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                                            Time To:
                                        </label>
                                        <input id="from" type="time"  value="{{$promotion->to}}"
                                            class="form-control w-full border-gray-400 @error('to') border-red-500 @enderror" name="to"
                                            value="{{ old('to') }}" required  autofocus>
                
                                            @error('to')
                                            <p class="text-red-500 text-xs italic mt-4">
                                                {{ $message }}
                                            </p>
                                            @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="amount_type" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4  ">Amount Type </label>
                                      
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input id="pers" @if($promotion->amount_type == 1) checked @endif onchange="checklab()" type="radio" checked class="form-checkbox h-5 w-5 text-gray-600" value="1"   name="amount_type">
                                                    <span class="ml-2 text-gray-700">Percentage</span>
                                                </div>
                                                <div  class="col-md-6">
                                                    <input  
                                                    @if($promotion->amount_type == 2) checked @endif
                                                    
                                                    onchange="checklab()" type="radio" class="form-checkbox h-5 w-5 text-gray-600" value="2"  name="amount_type">
                                                    <span class="ml-2 text-gray-700">Price</span>
                                                </div>
                                            </div>
                                       
                                    </div>

                                    <div class="form-group">
                                        <label for="value" id="amountlabel" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                                            Value(%)
                                        </label>
                                        <input id="value" type="text"
                                            class="form-control w-full border-gray-400 @error('value') border-red-500 @enderror" name="value"
                                            value="{{ $promotion->value }}" required  autofocus>
                
                                            @error('value')
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

<script>

    const checklab = () =>  {
    
        if($("input[name='amount_type']:checked").val() != 1){
    
            $('#amountlabel').empty();
            $('#amountlabel').append('Amount');
        } else{
            $('#amountlabel').empty();
            $('#amountlabel').append('Value(%)');
        }
    }
    </script>
 
    
    @endsection