<?php 
$branches = resolve('branches');
$menutypes = resolve('menutypesforrep');
$menucat = resolve('mcategories');
?>
@extends('admin.layouts.master')

@section('head', 'Dashboard')

@section('content')


 
 

<div class="container">
    <h4 class="mb-3">Sales Report Slow Moving Items</h4>
    <form action="{{route('report.sale')}}" method="GET">
      
    <div class="row py-3" style="margin: 0; background:white; border-radius:6px">

        <div class="form-group col-md-4">
            <label for="branch_id" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                Branches:
            </label>
                <select required class="form-control w-full border-gray-400" name="branch_id">
                <option value="All">All Branches</option>

                    @foreach ($branches as $item)
                        @if (isset($_GET['branch_id']) and $item->id == $_GET['branch_id'])
                        <option selected value="{{$item->id}}">{{$item->full_name}}</option>
                        @else
                        <option value="{{$item->id}}">{{$item->full_name}}</option>
                        @endif
                    @endforeach
                </select>
        </div>
        <div class="form-group col-md-4">
            <label for="branch_id" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                Menu Type:
            </label>
                <select required class="form-control w-full border-gray-400" name="menutype_id">
                <option value="All">All Types</option>

                    @foreach ($menutypes as $item)
                        @if (isset($_GET['menutype_id']) and $item->id == $_GET['menutype_id'])
                        <option selected value="{{$item->id}}">{{$item->name}}</option>
                        @else
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endif
                    @endforeach
                </select>
        </div>


        <div class="form-group col-md-4">
            <label for="menucat_id" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                Menu Category:
            </label>
                <select required class="form-control w-full border-gray-400" name="menucat_id">
                <option value="All">All Category</option>

                    @foreach ($menucat as $item)
                        @if (isset($_GET['menucat_id']) and $item->id == $_GET['menucat_id'])
                        <option selected value="{{$item->id}}">{{$item->full_name}}</option>
                        @else
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endif
                    @endforeach
                </select>
        </div>
        <div class="form-group col-md-4">
            <label for="branch_id" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                Date From:
            </label>
            <input name="df"  step="any"  type="datetime-local" class="form-control border-gray-400 txtb">
        </div>
        <div class="form-group col-md-4">
            <label for="branch_id" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                Date To:
            </label>
            <input name="dt"  step="any" type="datetime-local" class="form-control border-gray-400 txtb">
        </div>
      
       
        <div class="col-md-2 mt-4 pt-1">
            <button class="btn btn-primary btnc1" id="pay" type="submit">View Report <i class="fas fa-arrow-right"></i></button>
        </div>
   
    </div>
</form>
<br> 
 



<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-12" style="width:100%">
            <div class="card-header py-3">
             

                {{-- <h5 style="width: 100%; font-size:13px; border-bottom:20px; color:#111" >
        
                    <span style="color: #888; font-size:15px">Total Sale <b style="color: blue">RO {{$tot}}</b> <br>
                         Token used  <b style="color: blue">{{$tord}}</b></span> </h5> --}}
                

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            <th width="30">Item</th>
                            <th width="30">Sold Qty</th>
                            <th width="30">Sold Amount</th>
                            {{-- <th width="30">In Stock</th> --}}
                            </tr>
                        </thead>

                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <th width="30">{{$item->product->name}}</th>
                                <th width="30">{{$item->quantity}}</th>
                                <th width="30">RO : {{number_format($item->price * $item->quantity, 3)}}</th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




 

  

</div>
 
 
 


@endsection




@section('script')
<script>
$(document).ready(function() {
    $('#dtable').dataTable( {
        "aaSorting": [[ 1, "asc" ]]
    } );
} );
</script>
@endsection