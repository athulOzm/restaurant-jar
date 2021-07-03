<?php 
$members = resolve('members');
$menutypes = resolve('menutypesforrep');
$menucat = resolve('mcategories');
?>
@extends('admin.layouts.master')

@section('head', 'Dashboard')

@section('content')


 
 

<div class="container">
    <h4 class="mb-3">Sales Report by Member</h4>
    <form action="{{route('report.salemem')}}" method="GET">
      
    <div class="row py-3" style="margin: 0; background:white; border-radius:6px">

        <div class="col-md-4">
            <label for="branch_id" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                Member Id:
            </label>
            <select name="user_id" class="form-control  selectpicker" data-live-search="true" style="background: #fff">
                <option data-tokens="" value="All">All Member</option>

              @foreach ($members as $user)

                        @if (isset($_GET['memberid']) and $user->id == $_GET['memberid'])
                        <option selected value="{{$user->id}}">{{$user->memberid}}</option>
                        @else
                        <option value="{{$user->id}}">{{$user->memberid}}</option>
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
                    <table class="table table-bordered" id="dtable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            <th width="30">Member ID</th>
                            <th width="30">Bill Count</th>
                            <th width="30">Sales</th>
                            {{-- <th width="30">In Stock</th> --}}
                            </tr>
                        </thead>

                        <tbody>
                        @foreach($items as $item)
                        
                            <tr>
                                <th width="30">{{$item->user->name}}</th>
                                <th width="30">{{$item->bill_sum}}</th>
                                <th width="30">{{$item->amount_sum}}</th>
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
        "aaSorting": [[ 1, "desc" ]]
    } );
} );
</script>
@endsection



