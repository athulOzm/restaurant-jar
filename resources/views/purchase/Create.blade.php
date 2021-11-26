 
@extends('admin.layouts.master')


<?php 
$menutypes = resolve('menutypesforpos');
$waiters = resolve('waiter');
$tables = resolve('tables');
$deltypes = resolve('locations');
$members = resolve('members');
$allmenus = resolve('allmenus');
$mcategories = resolve('mcategories'); 
$daten =  str_replace(' ', 'T', Carbon\Carbon::now());
$branches = resolve('branches');

?>

 
 


@section('content')
 
<style>
 
     
    
    #exTab2 ul li{padding: 0px 2px 1px; 
    font-weight: 700; 
    font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji"}
    
    .nav-pills{
        border-bottom: 0px solid #e7e7e7;
        border-radius: 6px; background: #e5e9f1
    }
    
    #exTab2 ul li a {
        color: #1b1f32;
        padding: 10px 13px;
        line-height: 35px;
        text-decoration: none;
        font-weight: 400;color: #1b1f32
    }
    #exTab2 ul li.active a {
        color: #000;
    }
    
    .tab-content>.active{border-left: 0px solid #e7e7e7; padding: 10px}
    
    #exTab2 ul li {
          border-radius: 3px; padding: 0px 
    }
    #exTab2 ul li.active {
        background: #ffffff;box-shadow: 0 .10rem 0.45rem 0 rgba(58,59,69,.15)!important 
    }
    
    
    #exTabsale ul li a {
        padding: 10px 13px;
        line-height: 35px;
        text-decoration: none;
        font-weight: 400;
        font-size: 15px;
        color: #404040;
    }
    #exTabsale ul li.active a {
        color: #000;
    }
    
    .tab-content>.active{border-left: 0px solid #fff; padding: 10px}
    
    #exTabsale ul li {
          border-radius: 0px; padding: 3px 
    }
    #exTabsale ul li.active {
        background: #ffffff;
    }
    
     
    #exTabsale2 ul li a {
        padding: 10px 13px;
        line-height: 35px;
        text-decoration: none;
        font-weight: 400;
        font-size: 15px;
        color: #404040;
    }
    #exTabsale2 ul li.active a {
        color: #000;
    }
    
    .tab-content>.active{border-left: 0px solid #fff; padding: 10px}
    
    #exTabsale2 ul li {
          border-radius: 0px; padding: 3px 
    }
    #exTabsale2 ul li.active {
        background: #ffffff;
    }
    
    /* remove border radius for the tab */
    
    #exTab1 .nav-pills > li > a {
      border-radius: 0;
    }
    
    /* change border radius for the tab , apply corners on top*/
    
    #exTab3 .nav-pills > li > a {
      border-radius: 4px 4px 0 0 ;
    }
    
    #exTab3 .tab-content {
      color : white;
      background-color: #3f6cb1;
      padding : 5px 15px;
    }
    
    .btnc {
        font-size: 14px;
        font-weight: 600;
        color: #8790a5;
    }
    
    .itembox{width: 120px; margin:5px;border: 1px solid #b9bdc3; cursor: pointer;
        border-top: none; overflow: hidden; font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji" }
    .itembox h6{font-weight: 600;
        color: #000;
        text-align: center;
        
        line-height: 20px;
        padding: 6px 0px 6px;
        font-size: 0.9rem; 
        font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji"}
    
        .itembox h5 {
        font-size: 15px;
        font-weight: 400;
        background: #4e72df;
        padding: 3px 8px;
        color: #fff;
        margin: 0;
        position: absolute;
        border-bottom-right-radius: 6px;
    }
    .smtxt {
        width: 100%;
        background: #fff;
        border: 0;
        text-align: center;
        color: black; line-height: 25px;border:1px solid #878787; height: 27px
    }
    .brn{border-right :none}
    .bln{border-left :none}
    .itembox h4 {
        font-size: 13px;
        font-weight: 400;
        background: #e65776;
        padding: 3px 8px;
        color: #fff;
        margin: 0;
        position: absolute;
        border-bottom-left-radius: 6px;
        right: 0;
        line-height: 18px;
    }
    .box1 {
        padding: 7px 20px;
        background: #1b1f32;
        margin-right: 20px;
    }
    .box2 {
        padding: 7px 20px;
        background: #2c3346;
        margin-right: 20px; margin-top: 4px
    }
    /* .box3 {
        padding: 7px 20px;
        background: #2c3346;
        margin-right: 20px; margin-top: 4px
    } */
    
    .box3 {
        padding: 11px 0px;
        background: #424962;
        margin-right: 5px;
        margin-top: 0px;
        border-radius: 3px;
        cursor: pointer;
        display: flex;
        margin-bottom: 0;
        flex-direction: column;
        justify-content: center;
        width: 100%;
        align-items: center;
    }
    .box3 input {opacity: 0;  }
    .box3 input:checked {opacity: 1;  }
    
    .box1 input[type=radio]{ margin-right: 10px}
    
    .flex{display: flex}
    .lab1 {
        font-size: 16px;
        color: #f4f5fa;
        font-weight: 200; 
    }
    .lab1a {
        font-size: 14px;
        color: #f8f9fc;
        font-weight: 300;
        display: inline-block;
        margin-left: 0;
        margin-bottom: 1px;
    }
    
    .lab1b {
        font-size: 12px;
        color:#758098;
        font-weight: 400;
        display: inline-block;
        margin-left: 0;
        margin-bottom: 0px;
    }
     
    .lab1a b{
        font-size: 14px;
        color: #7c8498;
        font-weight: 500!important; display: inline-block
    }
    .lab2{
        font-size: 14px;
        color: #444; font-weight: 600; width: 100%; display: block
    }
    .lab3 {
        font-size: 12px;
        font-weight: 600;
        color: #6f788e;
    }
    .item {
    line-height: 20px;
    margin: 0px 0;
    padding-right: 15px;
    padding: 4px 0;
    border: 1px solid #c4c4c4;
    border-top: none;
    background: #e1e1e1;
}
    .item label{margin-bottom: 0}
    .item h3 {
        font-size: 15px;
        color: #e6ebf3;
    }
    .btn-circle.btn-sm, .btn-group-sm>.btn-circle.btn {
        font-size: 14px;
        margin: 0 2px;
        background: #363e54;
        border-radius: 4px;
    }
    .item .price {
    font-size: 13px;
    color: #201e1e;
    line-height: 26px;
    font-weight: 500;
}
    .item .qty {
        font-size: 15px;
      
        background: #fff;
        padding: 0px 2px;
        border-radius: 3px; line-height: 20px;
     
        margin: 0 3px;
    }
    
    
    .itemdis {
        max-width: 100%;
     
        background: #fff;
        border: none;
        border-radius: 3px;
        height: 26px;
    }
    .item .ttl {
        font-size: 13px;
        color: #000; font-weight: 600; line-height: 26px
    }
    .btn-light {
        color: #3a3b45;
        background-color: #e5e9f1;
        border-color: #e5e9f1;
        padding: 3px 15px;
    }
    .txtb {
        background: #424962;
        border: 0;
        border-radius: 3px;
        color:#e65776; font-size: 13px; height: 27px;
    }
    .itembox img {
        width: 100%;
        height: 90px;
    }
    .btnc1 {
        height: auto;
        background: #e65776;
        border-color: #e65776;
        margin: 10px 0;
        padding: 8px 20px;font-size: 14px
        
    }
    .btnc2 {
        height: auto;
        background: #b6bece;
        border-color: #b6bece;
        margin: 6px 0;
        padding: 5px 0px;
        color: #1b1f32;
        width: 100%;font-size: 14px; border-radius: 3px
    }
    
    .btnc22 {
        height: auto;
        background: #424962;
        border-color: #424962;
        margin: 6px 0;
        padding: 12px 0px;
        color: #fff;
        font-size: 14px;
        border-radius: 3px;
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
    }
    
    .btnc22 i {font-size: 23px; color: white}
    
    .p5{padding-left: 5px; padding-right: 5px}
    .tar{text-align: right}
    .p10{padding: 3px 10px}
    #pt input{font-size: 22px}
    .autocomplete-suggestions {
        
    background: #4285f4;
    overflow: auto;
    color: #fff;
    font-size: 16px;
    }
    .autocomplete-selected {background: #222!important}
        .autocomplete-suggestion { padding: 5px 15px; white-space: nowrap; overflow: hidden;font-size: 15px; cursor: pointer;border-bottom: 1px solid #000; }
        
        .autocomplete-suggestions strong { font-weight: normal; color: #777; }
        .autocomplete-group { padding: 2px 5px; }
        .autocomplete-group strong { display: block; border-bottom: 1px solid #000; }
    
    .tablepic {
        background: #3f6cb1;
        text-align: center;
        padding: 3px;
        color: #fff;
    }
    .tablepic h5{padding-top: 5px; font-size: 20px}
    .tablepic p{
        padding: 0;
        margin: 0;
        font-size: 12px;
    }
    .card{background: none; border: 0}
    .cart th{background: none}
    .cart tr:nth-child(even){background: none}  
    .bgh {
        background: #1a1f32;
        padding: 15px 15px 0 25px
    }
    
    .bgh2 {
        background: #2c3346;
        padding: 15px 30px;
    }
    
    .bgh2a {
        background: #2c3346;
        padding: 5px 10px;
    }
    .oc {
        font-size: 24px;
        color: #fff;
        border: 1px solid #475066;
        padding: 3px 10px;
        width: 100%;
        background: #475066;
        border-radius: 3px;
        line-height: 27px;
    }
    .oc2 {
        font-size: 14px;
        color: #fff;
        border: 1px solid #475066;
        padding: 3px 10px;
        width: 100%;
        background: #475066;
        border-radius: 3px;
        line-height: 27px;
    }
    .box1a {
        padding: 9px 0px 0px;
        background: #1b1f32;
        
        margin-top: 30px;
        border-radius: 3px;
        text-align: center;
        display: flex;
        align-items: center; margin-right: 10px; line-height: 13px
    }

    .received{display: none}
    /*
     *  STYLE 4
     */
    
     .scro::-webkit-scrollbar-track
    {
      -webkit-box-shadow: inset 0 0 2px rgba(0,0,0,0.3);
      background-color: #2c3346;
    }
    
    .scro::-webkit-scrollbar
    {
      width: 13px;
      background-color: #2c3346;
    }
    
    .scro::-webkit-scrollbar-thumb
    {
      background-color: #4e72df;
      border: 0px solid #555555;
    }
    
    .pl18{padding-left: 18px}
    
    .scro2::-webkit-scrollbar-track
    {
      /* -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); */
      background-color: #f4f5fa;
    }
    
    .scro2::-webkit-scrollbar
    {
      width: 5px;
      background-color: #f4f5fa;
    }
    
    .scro2::-webkit-scrollbar-thumb
    {
      background-color: #e7e7e7;
      border: 0px solid #555555;
    }
    
    .scro3::-webkit-scrollbar-track
    {
      /* -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); */
      background-color: #f4f5fa;
    }
    
    .scro3::-webkit-scrollbar
    {
      width: 5px;
      background-color: #f4f5fa;
    }
    
    .scro3::-webkit-scrollbar-thumb
    {
      background-color: #000000;
      border: 0px solid #555555;
    }
    
    
    .btn-group-sm>.btn, .btn-sm {
        padding: .25rem .2rem;}
    
    
    
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
    
    .backDrop2{
      background-color: #fff;
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
    
    .box{
     
     display: none;
     min-height: 600px;
     left: 5%;
     opacity: 0;
     position: fixed;
     top: 4%;
     z-index: 51; width: 90%; overflow: hidden;
     
     -moz-border-radius: 6px;
     -webkit-border-radius: 6px;
     border-radius: 6px; background: #fff; padding-bottom: 20px;overflow-y: scroll; 
    }
    
    .boxordersource{
     
     display: none;
     min-height: 600px;
     left: 5%;
     opacity: 0;
     position: fixed;
     top: 4%;
     z-index: 51; width: 90%; overflow: hidden;
     
     -moz-border-radius: 6px;
     -webkit-border-radius: 6px;
     border-radius: 6px; background: #fff; padding-bottom: 20px;overflow-y: scroll; 
    }
    
    .box2{
     border: 1px solid #656f9e;
      padding: 0;
      display: none;
       
      left: 50%;
      margin-left: -400px;
      opacity: 0;
      position: fixed;
      top: 4%;
      z-index: 51; width: 800px;
      
      -moz-border-radius: 2px;
      -webkit-border-radius: 2px;
      border-radius: 2px; background: #1a1f32; padding-bottom: 0px;overflow-y: scroll;
    }
    .sales_return{
     border:1px solid #424962;
      padding: 20px;
      display: none;
       
      left: 50%;
      margin-left: -170px;
      opacity: 0;
      position: fixed;
      top: 50%;
      z-index: 51; width: 350px; margin-top: -175px;
      
      -moz-border-radius: 2px;
      -webkit-border-radius: 2px;
      border-radius: 2px; background: #fff; overflow-y: scroll; padding-bottom: 20px
    }
    .variant{
     border:1px solid #424962;
      padding: 20px;
      display: none;
       
      left: 50%;
      margin-left: -170px;
      opacity: 0;
      position: fixed;
      top: 50%;
      z-index: 51; width: 450px; margin-top: -150px;
      
      -moz-border-radius: 2px;
      -webkit-border-radius: 2px;
      border-radius: 2px; background: #fff; overflow-y: scroll; padding-bottom: 20px
    }
    .boxsett3{
     border: 5px solid #fff;
      padding: 0;
      display: none;
       
      left: 50%;
      margin-left: -430px;
      opacity: 0;
      position: fixed;
      top: 4%;
      z-index: 51; width: 860px;
      
      -moz-border-radius: 2px;
      -webkit-border-radius: 2px;
      border-radius: 2px; background: #fff; padding-bottom: 0px;overflow-y: scroll;padding: 0px;
    }
    .setle {
        width: 100%;
        text-align: center;
        color: #fff;
        text-transform: uppercase;
    }
    
    .sitem {
        background: #fff;
        padding: 10px;
        color: #333;
        border-bottom: 1px solid #e7e7e7;font-size: 13px
    }
    
    .p0{padding: 0!important}
    .close{
      color: white;
      cursor: pointer;
      float: left;
      font-size: 32px;
      margin: 10px;
      position: absolute;
    }
    
    .itemtitle {
        background: #f8f9fc;
        border-radius: 6px;
        margin: 6px;
        margin-top: 90px;
        color: black!important;
        font-size: 14px!important;
    }
    
    .clear{
      clear: both;
    }
    .cf{padding-left:0; padding-right:15px; height:calc(100vh - 40px)}
    .totalamd{border-top:1px solid #2c3346;padding: 15px 0px 10px 0;border-bottom: 1px solid #2c3346;}
    .itemtitlebar {
    color: #ffffff;
    font-size: 13px;
    text-align: left;
    font-weight: 400;
    background: #888;
    padding: 5px 0;
 
    white-space: nowrap;
}
    
    .btn-circle.btn-sm, .btn-group-sm>.btn-circle.btn {
       
        width: 1.4rem;
       
    }
    .alert {
        padding: 8px 20px;margin: 0;
        margin-left: 30px;
        border-radius: 6px;
        color: #fff;
        font-size: 14px;
        background: #e65776;
        border: 1px solid #bd1a3d;
    }
    /* .orderser {
        width: 100%;
        border: 1px solid #9ba5b7;
        border-radius: 3px;
        font-weight: 300;
        color: #000;
        font-size: 14px;
        background: #ffffff;
        margin: 10px 0;
    } */
    
    .pill2 {
        border-bottom: 0px solid #e7e7e7;
        background: #FFC107;
        border-radius: 0;
    }
    
    
    .btnn1 {
        background: #fff;
        margin-right: 10px;
        width: 130px;
        border-radius: 19px;
        height: 35px;
        border: 1px solid #2196F3;
        color: #2196F3!important;
    }
    
    .btnn1v {
        background: #fff;
        margin-right: 10px;
        width: 100%;
        border-radius: 19px; line-height: 30px;
        height: 45px;
        border: 1px solid #2196F3;
        color: #2196F3!important; font-size: 16px
    }
    .btnn1v:hover {color: white!important}
    .navbar-expand .navbar-nav {
        flex-direction: row;
        vertical-align: middle;
        align-items: center;
    }
    
    .bpic {
        max-width: 150px;
        margin-top: 14px;
        margin-left: 30px; height: 33px;
    }
    .bpic select {
        background: #ffffff;
        font-size: 13px;
        color: #2196F3;
        height: 35px;
        border: 1px solid;
        border-radius: 20px; font-weight: 400
    }
    .topbar.navbar-light .navbar-nav .nav-item .nav-link {
        color: #d1d3e2;
        background: #e5e9f1;
        border-radius: 50%;
        width: 40px;
        padding: 3px;
    }
          </style>

<!-- Begin Page Content -->
<div class="container-fluid">


    <div class="pull-right" >
        <div class="card-body ">
            <div class="row">



                <div class="col-md-12">
                    <div class="card shadow mb-12" style="width:100%">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Purchase</h6> 
                            
    
                        </div>
                        <div class="card-body" style="background: #fff">
                            <div class="table-responsive">



        <form action="{{route('pur.store')}}" method="POST" id="mform" autocomplete="off" enctype="multipart/form-data">
        @csrf

     

        <div class="row">

                                    <div class="form-group col-md-4">
                                        <label for="branch_id" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                                            Branch:
                                        </label>
                                            <select required class="form-control w-full border-gray-400" name="branch_id">
                                            
                                                @foreach ($branches as $item)
                                                <option
                                                @if ($branches->first())
                                                    selected
                                                @endif
                                                value="{{$item->id}}">{{$item->full_name}}</option>
                                                @endforeach
                                            </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="supplier_id" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                                            Supplier:
                                        </label>
                                            <select required class="form-control w-full border-gray-400" name="supplier_id">
                                            
                                                @foreach ($suppliers as $item)
                                                <option
                                              
                                                value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="purchase_status_id" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                                            Purchase Status:
                                        </label>
                                            <select required class="form-control w-full border-gray-400" 
                                            name="purchase_status_id"
                                            id="purstatus"
                                            >
                                            
                                                @foreach ($purchasestatuses as $item)
                                                <option
                                              
                                                value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                    </div>
                
                                    <div class="form-group col-md-4">
                                        <label for="date" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                                            Date:
                                        </label>
                                        <input id="date" type="datetime-local"
                                            class="form-control w-full border-gray-400 @error('date') border-red-500 @enderror" name="date"
                                            value="{{ old('date') }}" required  autofocus>
                
                                            @error('date')
                                            <p class="text-red-500 text-xs italic mt-4">
                                                {{ $message }}
                                            </p>
                                            @enderror
                                    </div>

                                


                                    <div class="form-group col-md-4">
                                        <label for="chair" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                                            Reference:
                                        </label>
                                        <input id="reference" type="chair"
                                            class="form-control w-full border-gray-400 @error('reference') border-red-500 @enderror" name="reference"
                                            value="{{ old('reference') }}"   autofocus>
                
                                            @error('reference')
                                            <p class="text-red-500 text-xs italic mt-4">
                                                {{ $message }}
                                            </p>
                                            @enderror
                                    </div>


                                    <div class="form-group col-md-4">
                                      <label for="payment_status_id" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                                          Payment Status:
                                      </label>
                                          <select required class="form-control w-full border-gray-400" name="payment_status_id">
                                          
                                              @foreach ($paymentstatuses as $item)
                                              <option
                                            
                                              value="{{$item->id}}">{{$item->name}}</option>
                                              @endforeach
                                          </select>
                                  </div>

        </div>

 

 
  
        
      
       

        <div class="row">

            

            <div class="col-md-12">

                <label   class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                    Products:
                </label>


                <input type="text" class="form-control orderser" id="sermenus" placeholder="Search Items/ Item Code" style=" 
            font-size: 14px;
            padding: 20px 15px; margin-bottom:20px">
            </div>

            
        </div>







        <div id="itembox">
          <div class="cart" id="cart">
        </div>

          <div class="row itemtitlebar">
            <div class="col-sm-1 " style="padding-left:25px">Sub Total</div>
            <div class="col-sm-2"></div>
            <div class="col-sm-2 "></div>
            <div class="col-sm-1"> </div>
            <div class="col-sm-2" id="discount"> </div>
            
         
           
            <div class="col-sm-1" id="vat">0 </div>
            <div class="col-sm-2 " id="st" style="text-align: right; padding-left:75px; font-weight:bold"></div>

            <div class="col-sm-1"> </div>

           
          </div>

          <br>  
          
          
          
          
          <div class="row">
            <div class="form-group col-md-3">
                <label for="discound_value" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                     Order Discound:
                </label>
                <div class="row">
               
                    <div class="col-sm-9" style="padding-right: 0">
                      <input id="discound_value" type="text"
                      class="form-control w-full border-gray-400 @error('discound_value') border-red-500 @enderror" name="discound_value"
                      value="{{ old('discound_value') }}" style="border-right: 0; border-top-right-radius:0;border-bottom-right-radius:0;"   autofocus>
                    </div>

                    <div class="col-sm-3" style="padding-left: 0">
                      <select name="discound_unit" class="form-control"  style="border-left: 0;border-top-left-radius:0;border-bottom-left-radius:0;"> 
                        <option value="0">%</option>
                        <option value="1" >RO</option> 
                      </select>
                    </div>

               
                 
                </div>
                
            </div>

            <div class="form-group col-md-3">
                <label for="shipping_cost" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                    Shipping Cost:
                </label>
                <input id="shipping_cost" type="text"
                    class="form-control w-full border-gray-400 @error('shipping_cost') border-red-500 @enderror" name="shipping_cost"
                    value="{{ old('shipping_cost') }}"    autofocus>

                    @error('shipping_cost')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                    @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="note" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                    Note:
                </label>
                <input id="note" type="text"
                    class="form-control w-full border-gray-400 @error('note') border-red-500 @enderror" name="note"
                    value="{{ old('note') }}"   autofocus>

                    @error('note')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                    @enderror
            </div>
          </div>


        </div>


    </div>
 
    
    <div class=" tar"  >
      
       

        <div class="row">

          

         
 

          <div class="col-md-12">
            <input type="submit"    class="btn btn-primary " value=" Submit"> 
          </div>

 


        </div>
      </div>

    
 

      

       


    </div>



 
</div>
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




@section('script')
 
<script type="text/javascript">
$(document).ready(() => {

 

  //items
  getOrders();


  $('#purstatus').change(function(){
    if($(this).val() == 2){
      $(".received").css("display", "block");
    } else {
      $(".received").css("display", "none");
    }

})

//ADD
  var menus = [];
	$.ajax({
		url: "/pos/getmaterials",
		async: true,
		dataType: 'json',
		success: function (data) {
      //console.log(data);
			for (var i = 0, len = data.length; i < len; i++) {
				var id = (data[i].id).toString();
    
        if(data[i].name_ar === 'null'){
          menus.push({'value' : data[i].name, 'data' : id});

				
        } else{menus.push({'value' : data[i].name +  ` | ` + data[i].name_ar, 'data' : id});}

			}
			//send parse data to autocomplete function
			loadmenuss(menus);
		}

	});

    function loadmenuss(options) {
        $('#sermenus').autocomplete({
            lookup: options,
            onSelect: function (menu) {

            //console.log(menu);
            addtocart(menu.data);
            $('#sermenus').val('');

            }
        });
    }

 
 



});
 



   

 

 



 


 
  
  
  const getOrders = () => {
          $.ajax({
          type: 'GET',
          url: '/pur/getcart',
          success: function(res){

           // console.log(res);
              $('#cart').empty();

              $('#cart').append(`<div class="row itemtitlebar" style="width:calc(100% + 12px)">
                <div class="col-sm-1 " style="padding-left:25px">No</div>
                <div class="col-sm-2">Item Name</div>
                <div class="col-sm-1 pl18">Quantity</div>
                <div class="col-sm-1 pl18 received">Received</div>
                <div class="col-sm-1 pl18">Unit Price</div>
                <div class="col-sm-2 pl18">Discount</div>
                <div class="col-sm-2 pl18">Tax</div>
                
             
               
                <div class="col-sm-1 pl18" style="text-align:right">Sub Total</div>
                <div class="col-sm-1 pl18">Delete</div>
               
              </div>
              `)

              var subt = [];
              var n =1;
              res.purchasematerials.map(item => {

               //console.log(item);

               if(item.discount_unit == 1){
                 var disuni = `<option value="0">%</option>
              <option value="1" selected>RO</option>`
               } else {
                var disuni = `<option value="0" selected>%</option>
              <option value="1" >RO</option>`
               }

               if(item.tax_unit == 1){
                 var taxuni = `<option value="0">%</option>
              <option value="1" selected>RO</option>`
               } else {
                var taxuni = `<option value="0" selected>%</option>
              <option value="1" >RO</option>`
               }
 
                  $('#cart').append(
                    `<div class="item">
          <div class="row">
            <div class="col-sm-1" style="padding-left:25px">${n}</div>
            <div class="col-sm-2">${item.product.name} </div>
            <div class="col-sm-1">
              <div style="display: flex">
              <input class="smtxt" id="aa${item.id}" onChange="updqty('${item.id}')" type="text" value="${item.quantity}">
              </div>
            </div>
            <div class="col-sm-1 received">
              <div style="display: flex">
              <input class="smtxt"  type="text" id="aa2${item.id}" onChange="updqtyrec('${item.id}')" type="text" value="${item.quantityrec}" >
              </div>
            </div>
            <div class="col-sm-1">
            <input class="smtxt" id="a${item.id}" onChange="updprice('${item.id}')" type="text" value="${item.unit_price}">
            </div>

            <div class="col-sm-2" style="display:flex">
              <input value="${item.discount_value}" style="width:50%" onChange="adddiscount('${item.id}')" 
              id="itemd${item.id}" class="smtxt brn" type="text">
              <select onChange="adddiscount('${item.id}')" style="font-size:14px; height:27px" class="bln" id="itemdu${item.id}"> ${disuni} </select>
            </div>


            <div class="col-sm-2" style="display:flex">
              <input value="${item.tax_value}" style="width:50%" onChange="addtax('${item.id}')" 
              id="itemt${item.id}" class="smtxt brn" type="text">

              <select onChange="addtax('${item.id}')"  id="itemtu${item.id}" style="font-size:14px; height:27px" class="bln">
                ${taxuni}
              </select>

            </div>
          

        


          

 
            <div class="col-sm-1" style="text-align:right">${item.subtotal}</div>
            <div class="col-sm-1 pl18" ><button onClick="removecart(${item.product.id})" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash" style="color: white"></i></button></div>
            
           
          </div>
        </div>`);

        n = n+1;
          });


          //get total price
          

          if($("#purstatus").val() == 2){
              $(".received").css("display", "block");
          }


          gettotprice()
          }
      });
  };

  const gettotprice = async () => {

    $.ajax({
        type: 'GET',
        url: "/purc/totalprice",
        success: function(res) {
          console.log(res);

          $('#st').empty();
          $('#vat').empty();
          $('#subtotal').empty();
          $('#discount').empty();
          $('#promotion').empty();
          $('#ordpromotion').empty();
          $('#container').empty();
          $('#subtotal2').val(null);


          $('#st').append(res.price);

          if(res.tax != '0.000'){
            $('#vat').append(res.tax);
          }

          $('#subtotal').append(res.subtotal);
          $('#subtotal2').val(res.subtotal);

          if(res.discount != '0.000'){
            $('#discount').append(` ${res.discount} `);
          }

          if(res.promotion != '0.000'){
            $('#promotion').append(`<div class="col-sm-6">Promotion:</div><div class="col-sm-6" ><label style="font-weight: 600;">${res.promotion}</label></div>`);
          }

          if(res.ordpromotion != '0.000'){
            $('#ordpromotion').append(`<div class="col-sm-6">Women's day Promotion:</div><div class="col-sm-6" ><label style="font-weight: 600;">${res.ordpromotion}</label></div>`);
          }

          if(res.container != '0.000'){
            $('#container').append(`<div class="col-sm-6">Container:</div><div class="col-sm-6" ><label style="font-weight: 600;">${res.container}</label></div>`);
          }
 
        }
    })
  }

  //cancel
  const actcancel = (id) => {
  
  var token = $("meta[name='csrf-token']").attr("content");
  $.ajax({
      type: 'POST',
      url: `/pos/cancel`,
      data: {
          "token": id,
          "_token": token,
      },
      success: function(res){
      location.reload();  
      }
  });
}


//update quantity 
const updqty = (cart_item) =>  {

  let qty = $(`#aa${cart_item}`).val();
  var token = $("meta[name='csrf-token']").attr("content");
  $.ajax({
      type: 'POST',
      url: `/pur/updqty`,
      data: {
          "_token": token,
          "cart_item": cart_item,
          "qty": qty
      },
      success: function(res){
        getOrders();
      }
  });
}

//update quantity 
const updqtyrec = (cart_item) =>  {

let qty = $(`#aa2${cart_item}`).val();
var token = $("meta[name='csrf-token']").attr("content");
$.ajax({
    type: 'POST',
    url: `/pur/updqtyrec`,
    data: {
        "_token": token,
        "cart_item": cart_item,
        "qty": qty
    },
    success: function(res){
      getOrders();
    }
});
}


//update price
const updprice = (cart_item) =>  {

let qty = $(`#a${cart_item}`).val();
var token = $("meta[name='csrf-token']").attr("content");
$.ajax({
    type: 'POST',
    url: `/pur/updprice`,
    data: {
        "_token": token,
        "cart_item": cart_item,
        "price": qty
    },
    success: function(res){
      getOrders();
    }
});
}


 

  // addtocart main items
  const addtocart = (item) => {
   
 
     

      var token = $("meta[name='csrf-token']").attr("content");
      $.ajax({
          type: 'POST',
          url: `/pos/addtopurchase`,
          data: {
              "id": item,
       
              "_token": token,
          },
            success: function(res){
            
            getOrders();
          }
      });
  }


 

 


//remove item from cart
const removecart = (item) => {
var token = $("meta[name='csrf-token']").attr("content");
  $.ajax({
      type: 'POST',
      url: `/pur/removecart`,
      data: {
          "id": item,
          "_token": token,
      },
      success: function(){

        


        getOrders();
      }
  });
}

//remove item from addon
const removecartaddon = (item, pid) => {
var token = $("meta[name='csrf-token']").attr("content");
  $.ajax({
      type: 'POST',
      url: `/pos/removecartaddon`,
      data: {
          "id": item,
          "pid": pid,
          "_token": token,
      },
      success: function(){
        getaddon(pid);
        getOrders();
      }
  });
}

 

//remove item from cart
const downcart = (item) => {
var token = $("meta[name='csrf-token']").attr("content");
  $.ajax({
      type: 'POST',
      url: `/pos/downcart`,
      data: {
          "id": item,
          "_token": token,
      },
      success: function(){

        // var res = $('#autocomplete').val().split(" - ");
        // if(res[0] != ''){
        //   cartcontinuebymid(res[0]);
        // }
        getOrders();
      }
  });
}


//remove item from addon
const downcartaddon = (item, pid) => {
var token = $("meta[name='csrf-token']").attr("content");
  $.ajax({
      type: 'POST',
      url: `/pos/downcartaddon`,
      data: {
          "id": item,
          "pid": pid,
          "_token": token,
      },
      success: function(){
        getaddon(pid);
        getOrders();
      }
  });
}


//discount
const adddiscount = (item) => {
 
var dis = $(`#itemd${item}`).val();
var dis_unit = $(`#itemdu${item}`).val();
  var token = $("meta[name='csrf-token']").attr("content");
  $.ajax({
      type: 'POST',
      url: `/purc/adddiscount`,
      data: {
          "id": item,
          "dis": dis,
          "dis_unit": dis_unit,
          "_token": token,
      },
      success: function(){
        getOrders();
      }
  });
}


//discount
const addtax = (item) => {
 
 var dis = $(`#itemt${item}`).val();
 var dis_unit = $(`#itemtu${item}`).val();
   var token = $("meta[name='csrf-token']").attr("content");
   $.ajax({
       type: 'POST',
       url: `/purc/addtax`,
       data: {
           "id": item,
           "dis": dis,
           "dis_unit": dis_unit,
           "_token": token,
       },
       success: function(){
         getOrders();
       }
   });
 }

//getPromo

$('#order_promotion').change(function() {

  if(this.checked) {
      var val = 1;
      var dis = 30;
  } else{
      var val = 0;
      var dis = 0;
  }

  var token = $("meta[name='csrf-token']").attr("content");
  $.ajax({
      type: 'POST',
      url: `/pos/addpromo`,
      data: {
          "val": val,
          "dis": dis,
          "_token": token,
      },
      success: function(){
        getOrders();
      }
  });

       
              
});
 

//container
const addcontainer = (item, id) => {

var dis = $(`#itemc${id}`).val();


  var token = $("meta[name='csrf-token']").attr("content");
  $.ajax({
      type: 'POST',
      url: `/pos/addcontainer`,
      data: {
          "id": item,
          "dis": dis,
          "_token": token,
      },
      success: function(){
        getOrders();
      }
  });
}
  
  //get subcat
const getDeliverylocations = (memberid) => {
 // $('#pt').empty();
  
    $.ajax({
        type: 'GET',
        url: "/pos/locations",
        success: function(res) {
          //console.log(res);

          $('#locations').empty();
          $('#locations').append(`<div class="bgh1 mt-2">
          <select onChange="getPaymenttype('${memberid}')" class="form-control w-full txtb" name="location" required><option>Select Locations</option>`)


          res.map(locations => {
              //console.log(subcat);
              
              $('#locations select').append('<option value="' + locations.id + '">' + locations.name + '</option>')
          })
          $('#locations').append('</select></div>')

            
        }
    })
    
}


$('#mform').on('submit', function() {

  if($('#reqtype').val() == 'hold'){
  return true;
  }

  if($("input[name='pt']:checked").val() == 1){
  return true;
  }

  var avcre = $('#subtotal2').val();
  var ccre = $('#totcre2').val();
  $('#vallimit').empty();

});

 
 

 

</script>

<script src="{{asset('dashboard/js/jquery.autocomplete.min.js')}}"></script>

@endsection

