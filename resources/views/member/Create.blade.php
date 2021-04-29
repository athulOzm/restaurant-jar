
@extends('admin.layouts.master')

@section('head', 'Create Member')

@section('content')






<!-- Begin Page Content -->
<div class="container-fluid">


    <div class="pull-right" style="height: 70vh;">
        <div class="card-body p-0">
            <div class="row">
    
         
     


 
    <div class="card shadow mb-12" style="width:100%">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Members</h6> 
            

        </div>
        <div class="card-body">
            <div class="table-responsive">

                <form class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8" method="POST" action="{{ route('member.store') }}">
                    @csrf

                    <div class="row">

                    <div class="form-group col-md-6">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 col-md-6">
                            Name:
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

                    <div class="form-group col-md-6">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                            Email:
                        </label>
                        <input id="email" type="email"
                            class="form-control w-full border-gray-400 @error('email') border-red-500 @enderror" name="email"
                            value="{{ old('email') }}" required  autofocus>

                            @error('email')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="phone" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                            Phone:
                        </label>
                        <input id="phone" type="text"
                            class="form-control w-full border-gray-400 @error('phone') border-red-500 @enderror" name="phone"
                            value="{{ old('phone') }}" required  autofocus>

                            @error('phone')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="memberid" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                            Military ID:
                        </label>
                        <input id="memberid" type="text"
                            class="form-control w-full border-gray-400 @error('memberid') border-red-500 @enderror" name="memberid"
                            value="{{ old('memberid') }}" required  autofocus>

                            @error('memberid')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="position" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                            Position:
                        </label>
                        <input id="position" type="text"
                            class="form-control w-full border-gray-400 @error('position') border-red-500 @enderror" name="position"
                            value="{{ old('position') }}"   autofocus>

                            @error('position')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="limit" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                            Limit:
                        </label>
                        <input id="limit" type="text"
                            class="form-control w-full border-gray-400 @error('limit') border-red-500 @enderror" name="limit"
                            value="{{ old('limit') }}"   autofocus>

                            @error('limit')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
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

</div>


 
    
    @endsection

