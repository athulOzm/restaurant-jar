
@extends('admin.layouts.master')

@section('head', 'Create Member')

@section('content')



 

<div class="container" style="height: 90vh;">
    <div class="card-body p-0">
        <div class="row">



            <div class="col-md-12">
                <div class="card shadow mb-12">
                    <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Members</h6> 
            

        </div>
        <div class="card-body">
 

                <form class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8" method="POST" action="{{ route('member.store') }}">
                    @csrf

                    <div class="row">

                    <div class="form-group col-md-4">
                        <label for="name" class="block  text-sm font-bold mb-2 sm:mb-4">Full Name:</label>
                        <input id="name" type="text"
                            class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" required  autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="email" class="block  text-sm font-bold mb-2 sm:mb-4 ">
                            Email:
                        </label>
                        <input id="email" type="email"
                            class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="phone" class="block  text-sm font-bold mb-2 sm:mb-4 ">
                            Phone Number:
                        </label>
                        <input id="phone" type="text"
                            class="form-control @error('phone') is-invalid @enderror" name="phone"
                            value="{{ old('phone') }}" required  autofocus>

                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="memberid" class="block  text-sm font-bold mb-2 sm:mb-4 ">
                            Miss ID:
                        </label>
                        <input id="memberid" type="text"
                            class="form-control @error('memberid') is-invalid @enderror" name="memberid"
                            value="{{ old('memberid') }}" required  autofocus>

                            @error('memberid')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label for="serviceid" class="block  text-sm font-bold mb-2 sm:mb-4 ">
                            Service ID:
                        </label>
                        <input id="serviceid" type="text"
                            class="form-control @error('serviceid') is-invalid @enderror" name="serviceid"
                            value="{{ old('serviceid') }}" required  autofocus>

                            @error('serviceid')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="position" class="block  text-sm font-bold mb-2 sm:mb-4 ">
                            Rank:
                        </label>
                        <select  
                            required 
                            class="form-control @error('rank_id') is-invalid @enderror" 
                            name="rank_id"
                            id="rank_id">
                            <option value="">Select Rank</option>

               
                            @foreach ($ranks as $rank)
                                <option
                                @if (old('rank_id') == $rank->id)
                                    selected
                                @endif
                                
                                value="{{$rank->id}}">{{$rank->name}}</option>
                            @endforeach

                            @error('rank_id')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="position" class="block  text-sm font-bold mb-2 sm:mb-4 ">
                            Payment Type:
                        </label>
                        <select  
                            required 
                            class="form-control @error('payment_type_id') is-invalid @enderror" 
                            name="payment_type_id"
                            id="paymenttype">
                            <option value="">Select Payment Type</option>

               
                            @foreach ($paymenttypes as $paymenttype)
                                <option 

                                @if (old('payment_type_id') == $paymenttype->id)
                                    selected
                                @endif
                                
                                value="{{$paymenttype->id}}">{{$paymenttype->name}}</option>
                            @endforeach

                            @error('payment_type_id')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="limit" class="block  text-sm font-bold mb-2 sm:mb-4 ">
                            Member Limit:
                        </label>
                        <input id="limit" type="text"
                            class="form-control @error('limit') is-invalid @enderror" name="limit"
                            value="{{ old('limit') }}"   autofocus>

                            @error('limit')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                    </div>

                

                    <div class="form-group col-md-4">
                        <label for="item_limit" class="block  text-sm font-bold mb-2 sm:mb-4 ">
                            Order Limit:
                        </label>
                        <input id="item_limit" type="text"
                            class="form-control @error('item_limit') is-invalid @enderror" name="item_limit"
                            value="5"   autofocus>

                            @error('item_limit')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="location" class="block  text-sm font-bold mb-2 sm:mb-4 ">
                            Room Number:
                        </label>
                        <input id="room_address" type="text"
                            class="form-control @error('room_address') is-invalid @enderror" name="room_address"
                            value=""   autofocus>
 
                    </div>

                    

                    <div class="form-group col-md-4">
                        <label for="position" class="block  text-sm font-bold mb-2 sm:mb-4 ">
                            Member Category:
                        </label>
                        <select  
                            required 
                            class="form-control @error('category_id') is-invalid @enderror" 
                            name="category_id"
                            id="category_id">
                            <option value="">Select category</option>
                            @foreach ($memcategories as $category)
                                <option
                                @if (old('category_id') == $category->id)
                                    selected
                                @endif
                                
                                value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach

                            @error('category_id')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="location" class="block  text-sm font-bold mb-2 sm:mb-4 ">
                        Address:
                        </label>
                        <input id="location" type="text"
                            class="form-control @error('location') is-invalid @enderror" name="location"
                            value=""   autofocus>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="inputCity">Status</label>
                        <label class="flex flex-row items-center mt-3">
                            <div>
                                <input type="radio" class="form-checkbox h-5 w-5 text-gray-600" value="1" checked name="status">
                                <span class="ml-2 text-gray-700">Active</span>
                            </div>
                            <div>
                                <input type="radio" class="form-checkbox h-5 w-5 text-gray-600" value="0" name="status">
                                <span class="ml-2 text-gray-700">Desable</span>
                            </div>
                        </label>
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


 
    
    @endsection

