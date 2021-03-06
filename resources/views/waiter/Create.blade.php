
<?php $branches = resolve('branches');?>

@extends('admin.layouts.master')

@section('head', 'Create waiter')

@section('content')



 

<div class="container" style="height: 90vh;">
    <div class="card-body p-0">
        <div class="row">



            <div class="col-md-6">
                <div class="card shadow mb-12">
                    <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Waiters</h6> 
            

        </div>
        <div class="card-body">
 

                <form class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8" method="POST" action="{{ route('waiter.store') }}">
                    @csrf

                    <div class="row">

                        <div class="form-group  col-md-12">
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

                    <div class="form-group col-md-12">
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

                    <div class="form-group col-md-12">
                        <label for="email" class="block  text-sm font-bold mb-2 sm:mb-4 ">
                            Email:
                        </label>
                        <input id="email" type="email"
                            class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}"   autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                    </div>

                    <div class="form-group col-md-12">
                        <label for="phone" class="block  text-sm font-bold mb-2 sm:mb-4 ">
                            Phone Number:
                        </label>
                        <input id="phone" type="text"
                            class="form-control @error('phone') is-invalid @enderror" name="phone"
                            value="{{ old('phone') }}"   autofocus>

                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                    </div>

                    <div class="form-group col-md-12">
                        <label for="memberid" class="block  text-sm font-bold mb-2 sm:mb-4 ">
                            Waiter ID:
                        </label>
                        <input id="memberid" type="text"
                            class="form-control @error('memberid') is-invalid @enderror" name="memberid"
                            value="{{ old('memberid') }}"   autofocus>

                            @error('memberid')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
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

