
@extends('admin.layouts.master')

@section('head', 'Edit Member')

@section('content')



 

<!-- Begin Page Content -->
<div class="container-fluid">


    <div class="pull-right" style="height: 70vh;">
        <div class="card-body p-0">
            <div class="row">
    
         
     


 
    <div class="card shadow mb-12" style="width:100%">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Members</h6> 
            

        </div>
        <div class="card-body">
            <div class="table-responsive">

                <form class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8" method="POST" action="{{ route('member.update') }}">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" value="{{$user->id}}" name="id">

                    <div class="row">

                    <div class="form-group col-md-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">Full Name:</label>
                        <input id="name" type="text"
                            class="form-control w-full border-gray-400 @error('name') border-red-500 @enderror" name="name"
                            value="{{ $user->name }}" required  autofocus>

                            @error('name')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                            Email:
                        </label>
                        <input id="email" type="email"
                            class="form-control w-full border-gray-400 @error('email') border-red-500 @enderror" name="email"
                            value="{{ $user->email }}" required  autofocus>

                            @error('email')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="phone" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                            Phone Number:
                        </label>
                        <input id="phone" type="text"
                            class="form-control w-full border-gray-400 @error('phone') border-red-500 @enderror" name="phone"
                            value="{{ $user->phone }}" required  autofocus>

                            @error('phone')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="memberid" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                            Military ID:
                        </label>
                        <input id="memberid" type="text"
                            class="form-control w-full border-gray-400 @error('memberid') border-red-500 @enderror" name="memberid"
                            value="{{ $user->memberid }}" required  autofocus>

                            @error('memberid')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="position" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                            Rank:
                        </label>
                        <select  
                            required 
                            class="form-control w-full border-gray-400" 
                            name="rank_id"
                            id="rank_id">
               
                            @foreach ($ranks as $rank)
                                <option value="{{$rank->id}}">{{$rank->name}}</option>
                            @endforeach

                            @error('rank')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                        
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="position" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                            Payment Type:
                        </label>
                        <select  
                            required 
                            class="form-control w-full border-gray-400" 
                            name="payment_type_id"
                            id="paymenttype">
               
                            @foreach ($paymenttypes as $paymenttype)
                                <option value="{{$paymenttype->id}}">{{$paymenttype->name}}</option>
                            @endforeach

                            @error('paymenttype')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                        
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="limit" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                            Order Limit:
                        </label>
                        <input id="limit" type="text"
                            class="form-control w-full border-gray-400 @error('limit') border-red-500 @enderror" name="limit"
                            value="{{ $user->limit }}"   autofocus>

                            @error('limit')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="item_limit" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                            Item Limit Per Order:
                        </label>
                        <input id="item_limit" type="text"
                            class="form-control w-full border-gray-400 @error('item_limit') border-red-500 @enderror" name="item_limit"
                            value="{{$user->item_limit}}"   autofocus>

                            @error('item_limit')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="location" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                            Room Number:
                        </label>
                        <input id="room_address" type="text"
                            class="form-control w-full border-gray-400 @error('room_address') border-red-500 @enderror" name="room_address"
                            value="{{$user->room_address}}"   autofocus>
 
                    </div>

                    <div class="form-group col-md-8">
                        <label for="location" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                            Location:
                        </label>
                        <input id="location" type="text"
                            class="form-control w-full border-gray-400 @error('location') border-red-500 @enderror" name="location"
                            value="{{$user->location}}"   autofocus>
 
                    </div>

                </div>

                    
                    <button type="submit"  
                    class="btn1 btn btn-primary">
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


 
    
    @endsection

