<?php 
$branches = resolve('branches');
$members = resolve('members');
$locations = resolve('locations');
?>
@extends('admin.layouts.master')

@section('head', 'Products')

@section('content')


<style>

    .box{
     border: 2px solid #237ef7;
      
      display: none;
     
      left: 50%;
      margin-left: -200px;
      opacity: 0;
      position: fixed;
      top: 4%;
      z-index: 51; width: 400px;
      
      -moz-border-radius: 2px;
      -webkit-border-radius: 2px;
      border-radius: 2px;  overflow-y: scroll;
      background: #ffffff;
        padding: 20px; height: auto; padding-bottom: 20px;
    }
    
    .backDrop{
      background-color: #000;
      display: none;
      filter: alpha(opacity=0);
      height: 100%;
      left: 0px;
      opacity: .0;
      position: fixed;
      top: 0px;
      width: 100%;
      z-index: 50;
    }
    
    </style>

<style>
.nav-pills {
    border-top: 2px solid #f5f6fa;
    border-radius: 0;
    background: #f5f6fa;
}
.btn-info {
    color: #fff;
    background-color: #36b9cc;
    border-color: #36b9cc;
    padding: 3px 5px;
    font-size: 13px;
}
.la {
    font-size: 12px;
    margin-bottom: 5px;
}
.form-control {
 
    height: calc(1em + .95rem);
    padding: 0.275rem 1rem; border-color: rgb(211, 217, 234)
    }
</style>
<!-- Begin Page Content -->
<div class="container-fluid">


<div class="pull-right" style="height: 70vh;">
    <div class="card-body p-0">
        <div class="row">

     

            <div class="col-md-12">
                <div class="card shadow mb-12" style="width:100%">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Order List</h6> 

                        <form action="{{route('order.list')}}" method="GET">
                            @csrf
                        <div class="col-md-12 mt-3" style="border-radius: 6px;background: #f5f6fa;padding: 10px;">
                            <div class="row">

                                <div class="form-group col-md-3">
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

                                <div class="col-md-3 mt-2">
                                    <p class="la">Miss ID</p>
                                    <select name="memberid" class="form-control  selectpicker" data-live-search="true" style="background: #fff">
                                        <option data-tokens="">All Member</option>

                                      @foreach ($members as $user)

                                                @if (isset($_GET['memberid']) and $user->id == $_GET['memberid'])
                                                <option selected value="{{$user->id}}">{{$user->memberid}}</option>
                                                @else
                                                <option value="{{$user->id}}">{{$user->memberid}}</option>
                                                @endif

 
                                      @endforeach
                                    </select>
                                </div>
                          
                                <div class="col-md-3 mt-2">
                                    <p class="la">Date From</p>
                                    <input name="df"  step="any"  type="datetime-local" class="form-control border-gray-400 txtb">
                                </div>

                                <div class="col-md-3 mt-2">
                                    <p class="la">Date To</p>
                                    <input name="dt"  step="any"  type="datetime-local" class="form-control border-gray-400 txtb">
                                </div>
                        
                                <div class="form-group col-md-3 mt-2">
                                    <p class="la">
                                        Payment Type:
                                    </p>
                                    <select  class="form-control " name="payment_type_id">
                                        <option value="All">All</option>
                                        <option @if (isset($_GET['payment_type_id']) and $_GET['payment_type_id'] == 1) selected @endif value="1">Card</option>
                                        <option @if (isset($_GET['payment_type_id']) and $_GET['payment_type_id'] == 2) selected @endif value="2">Credit</option>         
                                    </select>
                                </div>
                        
                                <div class="form-group col-md-3 mt-2">
                                    <p class="la">
                                        Delivery Type:
                                    </p>
                                    <select  class="form-control " name="delivery_type">
                                        <option value="All">All</option>
                                            <option @if (isset($_GET['delivery_type']) and $_GET['delivery_type'] == 'Dinein') selected @endif value="Dinein">Dinein</option>
                                            <option @if (isset($_GET['delivery_type']) and $_GET['delivery_type'] == 'Take away') selected @endif value="Take away">Takeaway</option>
                                            <option @if (isset($_GET['delivery_type']) and $_GET['delivery_type'] == 'Delivery') selected @endif value="Delivery">Delivery</option>
                                    </select>
                                </div>
                        
                                <div class="col-md-3 mt-2">
                                    <p class="la">Delivery Location</p>
                                    <select name="deliverylocation_id" class="form-control  selectpicker" data-live-search="true" style="background: #fff">
                                        <option value="All">All Location</option>

                                      @foreach ($locations as $location)

                                                @if (isset($_GET['deliverylocation_id']) and $location->id == $_GET['deliverylocation_id'])
                                                <option selected value="{{$location->id}}">{{$location->name}}</option>
                                                @else
                                                <option value="{{$location->id}}">{{$location->name}}</option>
                                                @endif

 
                                      @endforeach
                                    </select>
                                </div>


                                {{-- <div class="col-md-3 mt-2">
                                    <p class="la">Order Source</p>
                                    <select name="ord_source" class="form-control  selectpicker" data-live-search="true" style="background: #fff">

                                        <option value="All">All Source</option>
                                        <option value="1">Admin</option>
                                        <option value="2">Apps</option>
                                        <option value="3">Tablet</option>

                                    </select>
                                </div> --}}


                                <div class="form-group col-md-3 mt-4">
                                    <button class="btn btn-primary btnc2 pull-right" style="float: right; font-size:11px; margin-top:5px" id="pay" type="submit">View Order Lists <i class="fas fa-arrow-right"></i></button>
                                </div>


                            </div>
                        </div>

                    </form>
                        

                    </div>


                    @include('pos.partials.ResourceLog')


                    






                </div>
            </div>
        </div>
    </div>
    </div></div>


    <div class="backDrop"></div>

<div class="box scro" style="max-height: 90vh; padding-bottom:0">
        <form id="rnw" action="{{route('pos.order.pay')}}" method="POST">
            @csrf()
            @method('PATCH')
    <input type="hidden" name="order_id" value="" id="order_id">

    Receipt ID : <input type="text" name="receipt_id" value="">


<button type="submit" class="btn1 btn btn-primary" style="margin: 20px 0; width:100%">
    Pay
</button>
</form>
</div>


 

@endsection


@section('script')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {


    $('#dataTable').DataTable();
    $('#dataTable2').DataTable();
    $('#dataTable3').DataTable();
    $('#dataTable4').DataTable();

    $('#dataTablea').DataTable();
    $('#dataTablea2').DataTable();
    $('#dataTablea3').DataTable();

} );




const cpay = (order, pt) => {

    if(pt == 2){

        $('#order_id').val(order);
        $('#rnw').submit();
    } else {


        $('#order_id').val(order);



        $(".backDrop").animate({"opacity": ".80"}, 300);
    $(".box").animate({"opacity": "1.0"}, 300);
    $(".backDrop, .box").css("display", "block");
    }

}


$(".close, .backDrop").on("click", function(){
    closeBox();
  });
  function closeBox(){
    $(".backDrop, .box").animate({"opacity": "0"}, 300, function(){
    $(".backDrop, .box").css("display", "none");
    });
  }





</script>
{{-- <script src="{{asset('dashboard/vendor/jquery/jquery.min.js')}}"></script> --}}



{{-- <script src="{{asset('dashboard/js/jQuery.print.js')}}"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
{{-- <script src="{{asset('dashboard/vendor/jquery-easing/jquery.easing.min.js')}}"></script> --}}

  <!-- Page level plugins -->
<script src="{{asset('dashboard/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('dashboard/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
@endsection