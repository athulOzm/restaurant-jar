<?php $branches = resolve('branches');?>

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
                            <h6 class="m-0 font-weight-bold text-primary">Update Unit</h6> 
                            
    
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <form class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8" method="POST" action="{{ route('pos.unit.update') }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="id" value="{{$unit->id}}">


                                    <div class="form-group">
                                        <label for="unit_code" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                                            Unit Code:
                                        </label>
                                        <input id="unit_code" type="text"
                                            class="form-control w-full border-gray-400 @error('unit_code') border-red-500 @enderror" name="unit_code"
                                            value="{{ $unit->unit_code }}" required  autofocus>
                
                                            @error('unit_code')
                                            <p class="text-red-500 text-xs italic mt-4">
                                                {{ $message }}
                                            </p>
                                            @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="unit_name" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                                            Unit Name:
                                        </label>
                                        <input id="unit_name" type="text"
                                            class="form-control w-full border-gray-400 @error('unit_name') border-red-500 @enderror" name="unit_name"
                                            value="{{ $unit->unit_name }}" required  autofocus>
                
                                            @error('unit_name')
                                            <p class="text-red-500 text-xs italic mt-4">
                                                {{ $message }}
                                            </p>
                                            @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="branch_id" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                                            Base Unit:
                                        </label>
                                            <select   class="form-control w-full border-gray-400" name="base_unit">
                                                <option value=""> No Base Unit</option>
                                                @foreach ($units as $unitp)
                                                <option 
                                                @if ($unitp->id == $unit->base_unit)
                                                    selected
                                                @endif
                                                value="{{$unitp->id}}">{{$unitp->unit_name}}</option>
                                                @endforeach
                                            </select>
                                    </div>
                
                                     


                                    <div class="form-group">
                                        <label for="operator" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                                            Operator:
                                        </label>
                                        <input id="operator" type="text"
                                            class="form-control w-full border-gray-400 @error('operator') border-red-500 @enderror" name="operator"
                                            value="{{$unit->operator}}" required  autofocus>
                
                                            @error('operator')
                                            <p class="text-red-500 text-xs italic mt-4">
                                                {{ $message }}
                                            </p>
                                            @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="operation_value" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                                            Operation value:
                                        </label>
                                        <input id="operation_value" type="text"
                                            class="form-control w-full border-gray-400 @error('operation_value') border-red-500 @enderror" name="operation_value"
                                            value="{{$unit->operation_value}}" required  autofocus>
                
                                            @error('operation_value')
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