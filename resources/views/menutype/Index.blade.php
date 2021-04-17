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
                            <h6 class="m-0 font-weight-bold text-primary">Menu Types</h6> 
                            
    
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                           
                                            <th class="text-left text-blue-900">Name</th>
                                            <th class="text-left text-blue-900">Time From</th>
                                            <th class="text-left text-blue-900">Time To</th>
                                            <th class="text-left text-blue-900"  width="30">Update</th>
                                            <th class="text-left text-blue-900" width="30">drop</th>

    
                                        </tr>
                                    </thead>
    
                                    <tbody>
                                        @forelse ($menutypes as $menutype)
                                        <tr>
                                           
                                            <td>{{$menutype->name}}</td>
                                            <td>{{ \Carbon\Carbon::parse($menutype->from)->format('g:i A') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($menutype->to)->format('g:i A') }}</td>
                                            <th><a href="{{route('menutype.edit', $menutype->id)}}" class="btn btn-info  btn-circle btn-sm "> <i
                                                class="fas fa-pencil-alt"></i></a></th>
                                            <td> <button onclick="document.getElementById({{$menutype->id}}).submit();" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></button> 
                                                <form id="{{$menutype->id}}" method="POST" action="{{ route('menutype.delete') }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id" value="{{$menutype->id}}">
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
                            <h6 class="m-0 font-weight-bold text-primary">Add New</h6> 
                            
    
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <form class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8" method="POST" action="{{ route('menutype.store') }}">
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
                                            Time From:
                                        </label>
                                        <input id="from" type="time"
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
                                        <input id="from" type="time"
                                            class="form-control w-full border-gray-400 @error('to') border-red-500 @enderror" name="to"
                                            value="{{ old('to') }}" required  autofocus>
                
                                            @error('to')
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