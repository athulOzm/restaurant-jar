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
                            <h6 class="m-0 font-weight-bold text-primary">Promotions</h6> 
                            
    
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                           
                                            <th class="text-left text-blue-900">Name</th>
                                            <th class="text-left text-blue-900">Start Date</th>
                                            <th class="text-left text-blue-900">End Date</th>
                                            <th class="text-left text-blue-900">Value/ Amount</th>
                                            <th class="text-left text-blue-900"  width="60">Action</th>
                                         

    
                                        </tr>
                                    </thead>
    
                                    <tbody>
                                        @forelse ($promotions as $promotion)
                                        <tr>
                                           
                                            <td>{{$promotion->name}}</td>
                                            <td>{{ \Carbon\Carbon::parse($promotion->from)->format('g:i A') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($promotion->to)->format('g:i A') }}</td>
                                            <td>
                                                
                                            @if ($promotion->amount_type == 1)
                                            {{@number_format($promotion->value, 2)}}%
                                            @else
                                               RO:  {{@number_format($promotion->value, 3)}}
                                            @endif
                                            
                                            </td>
                                            <th><a href="{{route('promotion.edit', $promotion->id)}}" class="btn btn-secondary  btn-circle btn-sm "> <i
                                                class="fas fa-pencil-alt"></i></a> 

                                            <button style="margin-left: 10px" onclick="deleteCon('delfrm{{$promotion->id}}');" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></button> 
                                                <form id="delfrm{{$promotion->id}}" method="POST" action="{{ route('promotion.delete') }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id" value="{{$promotion->id}}">
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
                            <h6 class="m-0 font-weight-bold text-primary">Add Promotion</h6> 
                            
    
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <form class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8" method="POST" action="{{ route('promotion.store') }}">
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
                                        <label for="from" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                                            Promotion Start Date:
                                        </label>
                                        <input id="from" type="datetime-local"
                                            class="form-control w-full border-gray-400 @error('from') border-red-500 @enderror" name="from"
                                            value="{{ old('from') }}" required  autofocus>
                
                                            @error('from')
                                            <p class="text-red-500 text-xs italic mt-4">
                                                {{ $message }}
                                            </p>
                                            @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="to" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                                            Promotion End Date:
                                        </label>
                                        <input id="to" type="datetime-local"
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
                                                    <input id="pers" onchange="checklab()" type="radio" checked class="form-checkbox h-5 w-5 text-gray-600" value="1"   name="amount_type">
                                                    <span class="ml-2 text-gray-700">Percentage</span>
                                                </div>
                                                <div  class="col-md-6">
                                                    <input  onchange="checklab()" type="radio" class="form-checkbox h-5 w-5 text-gray-600" value="2"  name="amount_type">
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
                                            value="{{ old('value') }}" required  autofocus>
                
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