@extends('pos.layout.master')

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
  .catwraper {
    margin: 10px 0;
    background: #e5e9f1;
    border: 1px solid #ccc;
    padding: 10px 10px 0;
    border-radius: 6px;
}
.btn-circle.btn-sm, .btn-group-sm>.btn-circle.btn {
    height: 1.6rem;
}
label {
    display: inline-block;
    margin-bottom: .1rem;
}
.form-control {
    height: 28px;
    padding: 3px 10px;
}
</style>

<form action="{{route('pos.checkout')}}" method="POST" id="mform" autocomplete="off" enctype="multipart/form-data">
  @csrf

<input type="hidden" name="reqtype" value="pos" id="reqtype">
<input type="hidden" name="paymenttype" value="" id="paymenttype">
<input type="hidden" name="subtt2" id="totcre" value="">
<input type="hidden" name="subtt2" id="subtotal2" value="">
<input type="hidden" name="branch_id" value="{{ Session::get('branch')->id}}">

<div class="row">

 



  <div class="col-sm-5 p0" style="background: #2c3346;">
    


      
 <style>
   .nns::placeholder{color:#4e72df; font-weight: 300;font-size:13px}
 </style>



<div class="card  shadow-xs my-1" id="leftpanel" style="padding: 0 0px 0 20px">


  

 
        {{-- <div style="
        
        
        position: absolute;
        right: 0;
        margin-left: -150px;
        width: 300px;
        background: #2c3346;
        margin-top: -45px;
        padding:0;
        border-top-left-radius: 6px;
        height: 41px;
    
    
    ">
    <div class="row">
      <div class="col-sm-2">
        <i class="fas fa-barcode" style="
            color: #717994;
            font-size: 40px;
            line-height: 1px;
            margin: 21px 0 0;
        "></i>
      </div>
      
      <div class="col-sm-10">
        <input type="text" class="form-control w-full txtb nns" id="sbc"  name="asdsssf" 
        style="height: 32px;border-radius: 0;border-top-left-radius: 5px;border-bottom-left-radius: 5px;margin-top: 5px;" 
        placeholder="Scan Bill Barcode">
      </div>
    </div>
           
  </div>
  --}}



        


        <div class="row" style="
    background: #1b1f32;
    margin-right: 2px;
    border-bottom: 1px solid #353e56; padding-bottom:9px;
">

          <div class="col-md-6">
            <p class="lab1b" >Order Code: <b style="font-size: 15px; color:#e65776">{{ Session::get('token')->id}}</b></p>
          </div>

          <div class="col-md-6">
            <p class="lab1b">Date:  <b>{{Carbon\Carbon::now()->isoFormat('LLLL') }}</b></p>
          </div>
          
        
          {{-- <div class="col-md-6">
            <p class="lab1b">MESS ID</p>
            <input type="text" name="memberid" value="@if($cur_token->user){{$cur_token->user->memberid}}@endif" autocomplete="false" required id="autocomplete" class="form-control w-full txtb">
          </div>
    
          <div class="col-md-6">
            <p class="lab1b">Member Name</p>
            <input type="text" value="@if($cur_token->user){{$cur_token->user->name}}@endif" name="memberid_name" required id="autocomplete2" class="form-control w-full txtb" >
          </div>
          <div class="col-md-6">
            <p class="lab1b">Member Balance</p>
            <input type="text" id="totcre2" readonly value="@if($cur_token->user){{number_format($cur_token->user->limit - $cur_token->user->getCreditAmount(), 3)}}@endif" style="background: #424961" class="form-control w-full txtb">
          </div>
    
          <div class="col-md-6">
            <p class="lab1b">Payment Type</p>
            <div id="pt">
              <div class="bgh p0">
              <div class="flex">
              <label class="box3"><input type="radio"  required="" @if($cur_token->payment_type_id == 1) checked @endif name="pt" value="1"> <b class="lab1a">Card</b></label>
              <label class="box3"  style="margin-right: 0"><input type="radio"  id="crepay" @if($cur_token->payment_type_id == 2) checked @endif required="" name="pt" value="2"> <b class="lab1a">Credit</b></label>
              </div></div>
            </div>
          </div> --}}

          {{-- <div class="col-md-6">
            <div id="dtime">
              <p class="lab1b">Delivery Time</p>
              <input name="dtime" id="dtimee" step="any" type="datetime-local" onchange="getlimitbydate()" class="form-control border-gray-400 txtb">
            </div>
          </div> --}}
    
          <div class="col-md-6 ">
            {{-- <p class="lab1b">Delivery Type</p> --}}
         
              <div id="delivery">
                <div class=" flex">
                  <label class="box3"><input @if($cur_token->delivery_type == 'Dinein') checked @endif  checked type="radio" required="" name="del" value="Dinein" onclick="getTables('9')"> <b class="lab1a">Dinein</b></label>

                <label class="box3"><input @if($cur_token->delivery_type == 'Take away') checked @endif type="radio" required="" name="del" value="Take away" onclick="takeaway()"> <b class="lab1a">Take away</b></label>
                
                <label class="box3" style="margin-right: 0"><input @if($cur_token->delivery_type == 'Delivery') checked @endif type="radio" required="" name="del" value="Delivery" onclick="ShowDelType('@if($cur_token->user){{$cur_token->user->memberid}}@endif')"> <b class="lab1a">Delivery</b></label>
                </div>
              </div>

              <p class="lab1b">Customer</p>


              <select data-live-search="true" name="customer" class="form-control mb-1 mt-1" name="rank_id"  style="
                background: #424961;
                color: #fff;
                font-size: 13px;border:1px solid #424961
                ">
            
                  @foreach ($members as $member)
                  <option @if ($loop->first) selected @endif value="{{$member->id}}">{{$member->name}}</option>
                  @endforeach                        
              </select>

              {{-- <p class="lab1b">Promotions</p>
              <br>
           
              
              <label>
                <input type="checkbox" @if($cur_token->order_promotion == '30.000') checked @endif name="order_promotion" id="order_promotion" value="30"> 
                <b class="lab1a">Women's day (30%)</b>
              </label> --}}

              <input type="hidden" name="order_promotion">
 
            


              

          </div>

       

          <div class="col-md-6">

          


          
            <div class="flex" style="flex-direction: column" id="dineinwrap">
              <p class="lab1b">Waiter</p>
              <select data-live-search="true" name="dine_waiter" class="form-control mb-1"    style="
                background: #424961;
                color: #fff;
                font-size: 13px;border:1px solid #424961
                ">
                  @foreach ($waiters as $waiter)
                  <option @if ($loop->first) selected @endif value="{{$waiter->id}}">{{$waiter->name}}</option>
                  @endforeach                        
              </select>

              <p class="lab1b">Select Table</p>
              <select data-live-search="true" required name="dine_table" class="form-control mb-1"  style="
                background: #424961;
                color: #fff;
                font-size: 13px;border:1px solid #424961
                ">
                @if($cur_token->table)
                  <option value="{{$cur_token->table->id}}" selected>{{$cur_token->table->name}} - {{$cur_token->table->chair}}</option>
                  @else
                  <option value="">Select Table</option>

                @endif
 

                
                  @foreach  ($tables as $table)

                  @if ($table->status == 1)
                  <option value="{{$table->id}}">{{$table->name}} - {{$table->chair}} Chair</option>
                  @endif

                  
                  @endforeach                        
              </select>
            </div>


            <div class="row" id="deliverywrap" style="display: none">
              <p class="lab1b">Delivery Type</p>
              <select  data-live-search="true"  name="del_type" class="form-control mb-1"  style="
                background: #424961;
                color: #fff;
                font-size: 13px;border:1px solid #424961
                ">
                  @foreach  ($deltypes as $deltype)
                 
                  <option  value="{{$deltype->id}}">{{$deltype->name}}</option>
                  @endforeach                        
              </select>

              {{-- <p class="lab1b">Delivery Location</p> --}}
              <input type="hidden" name="del_loc"   class="form-control">

              {{-- <p class="lab1b">Delivery Time</p> --}}
              <input name="dtime" id="dtimee" step="any" type="hidden"  class="form-control  ">
           
               
            </div>


            <div class="row" id="dtawrap" style="display: none">
            
              <p class="lab1b">Vehicle Number</p>
              <input name="vn"   step="any" type="text"   class="form-control  ">
           
               
            </div>

            {{-- <div id="vallimit" style="
            font-size: 13px;
            color: #e65776;
        "></div> --}}
          </div>

          

        </div>




        <div id="itembox" class="scro" style="height:calc(100vh - 390px); margin-top:5px; overflow:hidden;  overflow-y: scroll;">
          <div class="cart"  style="width:99%" id="cart">
          </div>
        </div>
      </div>
<style>
  .custom-file-input:lang(en)~.custom-file-label::after {
    content: "Attach";
    background: #2c3346;
    margin: 0;
    color: #4e72df; left: 0px
}
</style>
    
      <div class="bgh tar" style="padding-bottom: 3px;padding-top: 5px;min-height:150px; position: absolute; bottom:0; width:100% ">
        <div class="row py-3" >
          <div class="col-md-6 " style="padding-right: 0">

            <input type="hidden" name="sn" value="">
        
              {{-- <div class="bgh p0" style="text-align: left">
                <b class="lab1a">Special Note</b>
                <div class="flex">
                  <textarea class="form-control w-full txtb" name="sn" style="background: #424a63; color:#fff; height:30px; "></textarea>
                </div>
              </div> --}}

              {{-- <div class="bgh p0 " style="text-align: left; display:flex">
                <div>
                  <b class="lab1a">Discount</b>
                  <input type="text" value="" id="ord_discount"  style="font-size: 20px; font-weight:600; height:38px; background:#e7e7e7" class="form-control w-full txtb" name="ord_discount">
                </div>
              </div> --}}

              <div class="bgh p0 " style="text-align: left; display:flex">
                 

                <div>
                  <b class="lab1a">Paying Amount</b>
                  <input type="text" value="" id="payingamount"  style="font-size: 20px; font-weight:600; height:38px; background:#e7e7e7" class="form-control w-full txtb" name="paying_amount">
                </div>

                <div>
                  <b class="lab1a" style="padding-left: 10px">Balance</b>
                  
                    <input type="text" value="" id="balancepay" class="form-control w-full txtb" style="background: #1a1f32; height:38px; color: #e65776;font-weight: 900;font-size: 22px;" name="balance_amount">
                  
                </div>

              </div>

              

         
          </div>

          <div class="col-md-6" style="font-size: 14px">
            
                <div class="row">
                  <div class="col-sm-6" style="color: white">Sub Total:</div>
                  <div class="col-sm-6" ><label id="st"  style="font-weight: 600;color:#fff"></label></div>
                </div>
                
                <div class="row" id="vat"></div>
                <div class="row" id="discount"></div>
                <div class="row" id="container"></div>
                <div class="row" id="promotion"></div>
                <div class="row" id="ordpromotion"></div>

                <div class="row" style="border-top:1px solid #333; width:98%; line-height:33px; margin-left:2%">
                  <div class="col-sm-5 p0" style="text-align: right"><b class="lab1">Total Amount:</b></div>
                  <div class="col-sm-7 p0" style="color:#e65776">OMR <label class="total" id="subtotal" style="font-weight: 600;font-size: 25px; margin-right:0px;color:#e65776"></label></div>
                </div>


           
          </div>
 
        </div>
        
        {{-- <div class="row totalamd tar">
          <div class="col-sm-9" style="text-align: right"><b class="lab1">Total Amount:</b></div>
          <div class="col-sm-3" style="color:#e65776; line-height:20px; padding-left:25px">OMR <label class="total" id="subtotal" style="font-weight: 600;font-size: 30px;"></label></div>
        </div> --}}

        <div class="row">

          

         

          <div class="col-sm-2 p5">
            <button class="btn btn-primary btnc22"    onclick="actcancel({{ Session::get('token')->id}})" type="button" ><i class="fas fa-retweet"></i> Cancel</button>
          </div>

  
          

          {{-- <div class="col-sm-2 p5">
            <button onclick="hold()" class="btn btn-primary btnc22" type="button"><i class="fas fa-pause-circle"></i> Hold</button>
          </div> --}}

          <div class="col-sm-2 p5">
            <button onclick="kot()"  class="btn btn-primary btnc22" type="button"><i class="fas fa-fw fa-print"></i> Save</button>
          </div>


          

          
          <div class="col-sm-2 p5">
            <button onclick="ponline()"  class="btn btn-primary btnc22" id="pay4" type="submit" style="width:100%; background:#7594f1; border:1px solid #7594f1"> <i class="fas fa-fw fa-globe-americas"></i> Online Pay </button>
          </div>
          <div class="col-sm-3 p5 op">
            <button onclick="pcard()"  class="btn btn-primary btnc22" id="pay2" type="submit" style="width:100%; background:#2196F3; border:1px solid #2196F3"> <i class="fas fa-fw fa-credit-card"></i> Card </button>
          </div>
          <div class="col-sm-3 p5 op">
            <button onclick="pcash()"  class="btn btn-primary btnc22" id="pay32" type="submit" style="width:100%; background:#8BC34A; border:1px solid #8BC34A"> <i class="fas fa-fw fa-money-bill-wave-alt"></i> Cash </button>
          </div>

          


        </div>
      </div>

      <div class="backDrop"></div>


      

      {{-- end sales log --}}

  
      <div class="box2 scro " style="max-height: 90vh; overflow-x:hidden">
        <div class="row">
          <div class="bgh2 col-sm-6">
            <div style="display: flex"><b class="lab1a">Items</b></div>
            <div class="pt-4 pl-2">
              <div class="row " style="
                    color: #e65776;
                    font-size: 12px;
                    text-align: left;
                    font-weight: 600;
                ">
                <div class="col-sm-1 p0">S.N</div>
                <div class="col-sm-4 p0">Item Name</div>
                <div class="col-sm-2 p0">Quantity</div>
                <div class="col-sm-2 p0">Unit Price</div>
                <div class="col-sm-3 p0">Action</div>  
              </div>
      
              <div id="addoncart"></div>
            </div>
          </div>
        
          <div class="col-sm-6">
            <div class="bgh" style="display: flex"> <b class="lab1a">Add On</b></div>
            <div id="addonwrap" class="row"></div><br>
          </div>
        </div>
      </div>

      

      <div class="boxsett3 scro3 " id="printsettlement" style="max-height: 90vh; overflow-x:hidden">
        <div class="row">
          <div class="bgh2 setle" style="background: #2196F3; color:white">Settlement</div>

        </div>

        

        <div class="row sitem">
          <div class="col-md-8">Cash Payment</div>
          <div class="col-md-4">RO: <b id="settle_total_cash"></b></div>
        </div>

        <div class="row sitem">
          <div class="col-md-8">Card Payment</div>
          <div class="col-md-4">RO: <b id="settle_total_card"></b></div>
        </div>

        <div class="row sitem">
          <div class="col-md-8">Online Payment</div>
          <div class="col-md-4">RO: <b id="settle_total_online"></b></div>
        </div>

        <div class="row sitem">
          <div class="col-md-8">Total Settlement</div>
          <div class="col-md-4">RO: <b id="settle_total"></b></div>
        </div>

        <div class="row sitem">
          <div class="col-md-8">Cash in Drawer</div>
          <div class="col-md-4">RO: <b id="settle_total_drawer"></b></div>
        </div>

        <div class="row">
          <div class="bgh2 setle" style="background: #515151;padding: 3px; color:white">Soled Items</div>
        </div>

        <div class="row">
          <div class="container " id="sold_items">


          </div>
        </div>

        <div class="row">
          <div class="bgh2 setle" style="background: #515151;padding: 3px; color:white">Online Order</div>
        </div>

        <div class="row">
          <div class="container " id="settle_t">


          </div>
        </div>

        <hr>
        <div class="row">
          <div class="container" style="font-size: 13px; color:black">
            @if(auth()->user()->biller()->first())
            Time : {{auth()->user()->biller()->first()->created_at}} - {{Carbon\Carbon::now()}} <br>
            Biller : {{auth()->user()->biller()->first()->user->email}} <br>
            Branch : {{auth()->user()->biller()->first()->branch->name}} 

            @endif
          </div>
          
        </div>

        <div class="row sitem printbtn" >
          <div class="col-md-8"><button class="btn btn-secondary w-full" onclick="printsettle()" type="button" ><i class="fas fa-print"></i> Print </button></div>
          <div class="col-md-4"><button class="btn btn-primary w-full"  onclick="donsettlement()" type="button" ><i class="fas fa-sign-out-alt"></i> Submit Settlement</button></div>
        </div>

       


        

    
 


      </div>


    </div>



  <div class="col-sm-7 mt-4">
    <div class="card  shadow-xs mt-1" >

      
 





      <div id="exTab2">
        
        <ul class="nav nav-pills" id="pills-tab" role="tablist">
          <li class="nav-item" style="width: 100%">
            <input type="text" class="form-control orderser" id="sermenus" placeholder="Search Items/ Add by Barcode" style="margin: 7px 3px;
            width: 99%;
            font-size: 14px;
            padding: 20px 15px;">
          </li>
 
          {{-- menutype here --}}
          
          
        </ul>

<style>
  .phidden{cursor:inherit;filter: grayscale(0.90);}
</style>
        <div class="tab-content scro2" style="min-height:calc(100vh - 130px);height:calc(100vh - 130px);overflow-y:scroll">


        <div class="tab-content" id="pills-tabContent">
 
          @foreach ($menutypes as $menutype)

          
            <div class="tab-pane fade @if($loop->first) show active @endif" id="p{{$menutype->id}}" role="tabpanel" aria-labelledby="{{$menutype->id}}">

              <div class="row">

                <div class="col-10 p0">
                  <div class="tab-content" id="v-pills-tabContent">





                    {{-- for all --}}
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                      <div style="display: flex;flex-wrap: wrap;">
                        @forelse ($menutype->products as $product)

                        <div id="variants{{$product->id}}" class="variant" style="border-radius:6px">

                          <a onclick="addtocart({{$product->id}}, 0, {{$product->price}}, {{$product->vat}}, {{$product->promotion_price}});" href="#" class="nav-link btn btn-primary btnc2 btnn1v"  style="width: 100%"> {{$product->name}} {{$product->name_ar}} ({{$product->name}} {{$product->name_ar}})</a>

                          @if ($product->v1_price != '')
                          <a onclick="addtocart({{$product->id}}, 1, {{$product->v1_price}}, {{$product->vat}}, {{$product->promotion_price}});" href="#"class="nav-link btn btn-primary btnc2 btnn1v"  style="width: 100%"> {{$product->name}} {{$product->name_ar}} ({{$product->v1_name}}) - {{$product->v1_price}}</a>
                          @endif

                          @if ($product->v2_price != '')
                            <a onclick="addtocart({{$product->id}}, 2, {{$product->v2_price}}, {{$product->vat}}, {{$product->promotion_price}});" href="#" class="nav-link btn btn-primary btnc2 btnn1v"  style="width: 100%"> {{$product->name}} {{$product->name_ar}} ({{$product->v2_name}}) - {{$product->v2_price}}</a>
                          @endif

                          @if ($product->v3_price != '')
                          <a onclick="addtocart({{$product->id}}, 3, {{$product->v3_price}}, {{$product->vat}}, {{$product->promotion_price}});" href="#" class="nav-link btn btn-primary btnc2 btnn1v" style="width: 100%"> {{$product->name}} {{$product->name_ar}} ({{$product->v3_name}}) - {{$product->v3_price}}</a>
                          @endif

                          @if ($product->v4_price != '')
                          <a onclick="addtocart({{$product->id}}, 3, {{$product->v4_price}}, {{$product->vat}}, {{$product->promotion_price}});" href="#" class="nav-link btn btn-primary btnc2 btnn1v" style="width: 100%"> {{$product->name}} {{$product->name_ar}} ({{$product->v4_name}}) - {{$product->v4_price}}</a>
                          @endif
                           
                        </div>


                          <div 
                          @if ($product->variant)
                            onclick="showvariant({{$product->id}});"  
                          @else
                            onclick="addtocart({{$product->id}}, 0, {{$product->price}}, {{$product->vat}}, {{$product->promotion_price}});"
                          @endif

                          class="card itembox"
                          style="background: url('@if($product->cover != null){{env('IMAGE_PATH')}}{{ $product->cover}} @else {{asset('img/dummy_img.jpg')}}@endif');min-height:110px;background-size: 100% 100%;">
                              <h5>{{$product->price}}</h5>
                              @if ($promo = $product->getpromotion()) <h4>{{$promo}}</h4> @endif
                              <h6 class="itemtitle">{{$product->name}} {{$product->name_ar}} </h6>
                          </div>


                        @empty
                          No menu found!
                        @endforelse
                      </div> 
                    </div>

                     
                    
                    @foreach ($menutype->categories() as $cat)
                      <div class="tab-pane fade" id="v-pills-{{$cat->id}}{{$menutype->id}}" role="tabpanel" aria-labelledby="v-pills-profile-tab{{$cat->id}}{{$menutype->id}}">
                        <div style="display: flex;flex-wrap: wrap;">
                        @forelse ($cat->productsbytype($menutype->id) as $product)

                        
                        <div id="variants{{$product->id}}aa{{$cat->id}}" class="variant" style="border-radius:6px">

                   
                          <a onclick="addtocart({{$product->id}}, 0, {{$product->price}}, {{$product->vat}}, {{$product->promotion_price}});" href="#"class="nav-link btn btn-primary btnc2 btnn1v"  style="width: 100%"> {{$product->name}} {{$product->name_ar}} ({{$product->name}} {{$product->name_ar}})</a>
                         

                          @if ($product->v1_price != '')
                          <a onclick="addtocart({{$product->id}}, 1, {{$product->v1_price}}, {{$product->vat}}, {{$product->promotion_price}});" href="#"class="nav-link btn btn-primary btnc2 btnn1v"  style="width: 100%"> {{$product->name}} {{$product->name_ar}} ({{$product->v1_name}}) - {{$product->v1_price}}</a>
                          @endif

                          @if ($product->v2_price != '')
                            <a onclick="addtocart({{$product->id}}, 2, {{$product->v2_price}}, {{$product->vat}}, {{$product->promotion_price}});" href="#" class="nav-link btn btn-primary btnc2 btnn1v"  style="width: 100%"> {{$product->name}} {{$product->name_ar}} ({{$product->v2_name}}) - {{$product->v2_price}}</a>
                          @endif

                          @if ($product->v3_price != '')
                          <a onclick="addtocart({{$product->id}}, 3, {{$product->v3_price}}, {{$product->vat}}, {{$product->promotion_price}});" href="#" class="nav-link btn btn-primary btnc2 btnn1v" style="width: 100%"> {{$product->name}} {{$product->name_ar}} ({{$product->v3_name}}) - {{$product->v3_price}}</a>
                          @endif

                          @if ($product->v4_price != '')
                          <a onclick="addtocart({{$product->id}}, 3, {{$product->v4_price}}, {{$product->vat}}, {{$product->promotion_price}});" href="#" class="nav-link btn btn-primary btnc2 btnn1v" style="width: 100%"> {{$product->name}} {{$product->name_ar}} ({{$product->v4_name}}) - {{$product->v4_price}}</a>
                          @endif
                           
                        </div>


                          <div 
                          @if ($product->variant)
                            onclick="showvariant2({{$product->id}}, {{$cat->id}});"  
                          @else
                            onclick="addtocart({{$product->id}}, 0, {{$product->price}}, {{$product->vat}}, {{$product->promotion_price}});"
                          @endif
                          
                          class="card itembox" 
                          
                            style="background: url('@if($product->cover != null){{env('IMAGE_PATH')}}{{ $product->cover}} @else {{asset('img/dummy_img.jpg')}}@endif');min-height:110px;background-size: 100% 100%;">
                              <h5>{{$product->price}}</h5>
                              @if ($promo = $product->getpromotion()) <h4>{{$promo}}</h4> @endif
                              <h6 class="itemtitle">{{$product->name}} {{$product->name_ar}} </h6>
                          </div>
                        @empty
                          No menu found!
                        @endforelse
                      </div>
                      </div>
                    @endforeach

                 
                  </div>
                </div>


                <div class="col-2 p0">
                  <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">All</a>

                    @foreach ($menutype->categories() as $cat)
                    
                    <a class="nav-link" id="v-pills-{{$cat->id}}{{$menutype->id}}-tab" data-toggle="pill" href="#v-pills-{{$cat->id}}{{$menutype->id}}" role="tab" aria-controls="v-pills-profile" aria-selected="false">{{$cat->name}}</a>

                  @endforeach

                  
                  </div>
                </div>
                
              </div>
            

            </div>
          @endforeach
        </div>


 














        </div>

      </div>

    </div>
  </div>
</div>
</form>

<div class="box scro">
  <div class="p0">
  @include('pos.partials.SalesLog')
  </div>
</div>

{{-- <div class="boxordersource scro">
  <div class="p0">
  @include('pos.partials.ResourceLog')
  </div>
</div> --}}

<div class="sales_return" style="max-height: 90vh; overflow-x:hidden; padding:0">

  <div class="row">
    <div class="bgh2 setle" style="background: #424962">Sales Return</div>
  </div>

  <div class="row" style="padding:30px">
    <form action="{{route('pos.refund.gettoken')}}" method="POST">
      @csrf()
      @method('POST')
      <p class="lab1a" style="color: #1b1f32">Receipt ID</p>
      <input required type="text" name="token_id" class="form-control w-full txt" id="">
      <button class="btn btn-primary btnc1" id="pay" type="submit" style="padding: 8px 0; width:100%; background:#6c759c; border:1px solid #424962">Go <i class="fas fa-arrow-right"></i></button>
    </form>
  </div>
</div>




 

@if (!auth()->user()->biller()->count())
<div style="position: fixed;z-index: 99999;width: 500px;background: #fff;top: 20%;left: 50%;margin-left: -250px;padding: 30px;border-radius: 6px;border: 2px solid #2196F3;">

<form action="{{route('user.cashregister')}}" method="post" style="
font-size: 14px;
color: #111;
">
  @csrf
<div class="form-group">
  <label for="inputCity">Branch: *</label>
  
  <select  required class="form-control w-full border-gray-400" name="branch_id">

    @if (auth()->user()->type == 1)
      @foreach ($branches as $item)
      <option  @if (Session::get('branch')->id == $item->id)
          selected
      @endif value="{{$item->id}}">{{$item->name}}</option>
      @endforeach

    @else

    <option value="{{auth()->user()->branch->id}}">{{auth()->user()->branch->name}}</option>
    @endif


  </select>

</div><div class="form-group">

  <label for="inputCity">Cash in hand: *</label>


  
  <input type="text" name="cash_in_hand" required class="form-control w-full" id="">
</div>

<div class="form-group">
<input type="submit" value="Submit" class="btn btn-primary">  
</div>
</form>

</div> 

  <div class="backDrop2" style="display: block!important; opacity:.8!important; "></div>
@endif


 
@endsection




@section('script')
 
<script type="text/javascript">
const printsettle = () => {
 
  var divToPrint=document.getElementById('printsettlement');
  var newWin=window.open('','Print-Window');
  newWin.document.open();
  newWin.document.write(`<html><link href="http://jar.link/dashboard/css/sb-admin-2.min.css" rel="stylesheet"><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous"><body style="padding:80px" onload="window.print()"><style>
  @media print {
  .printbtn {
    display: none;
  }
}
</style>`+divToPrint.innerHTML+`</body></html>`);
  newWin.document.close();
  //setTimeout(function(){newWin.close();},10);
 
}
 //swich branch
 const switchBranch = () => {
  var token = $("meta[name='csrf-token']").attr("content");
  $.ajax({
      type: 'POST',
      url: `/switchbranch`,
      data: {
          "branch_id": $('#branch_id').val(),
          "_token": token,
      },
      success: function(res){
      location.reload();  
      }
  });
}
//room services
const roomservices = (memberid) => {
  hideloc();
  $.ajax({
    type: 'GET',
    url: `/get/members/${memberid}`,
    success: function(res){
      //console.log(res);
      $('#locations').append(`<input type="text" value="${res.room_address}" name="room_address" placeholder="Room Number" class="form-control w-full txtb mt-2">`);
    }
  });
}
 
//update token
$('#sbc').keyup(function(){
  if($('#sbc').val().length > 3){
    var sid = $('#sbc').val();
    
    window.location.href = "/pos/update/"+sid.replace('RE-', '');
  }
});
//balance
$('#payingamount').on('keyup', function() {
  var pay = this.value
  var st = $('#subtotal2').val();
  var dd = $('#ord_discount').val();
  var balance = parseFloat(pay - st).toFixed(3);
 // balance = parseFloat(balance + dd).toFixed(3);
  //console.log(st);
  $('#balancepay').val(balance);
});
//order discount
// $('#ord_discount').on('keyup', function() {
//   var dis = this.value
//   var st = $('#subtotal2').val();
//   var balance = parseFloat(st - dis).toFixed(3);
//   //console.log(balan);
  
//   $('#subtotal').empty();
//   $('#subtotal').append(balance);
// });
//add cart from barcode
$('#sermenus').keyup(function(){
  var sid = $('#sermenus').val();
  if(sid.includes('ME-')){
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        type: 'POST',
        url: `/pos/addtocartbybarcode`,
        data: {
            "item": sid,
            "_token": token,
        },
        success: function(res){
         // $('#crepay').prop('checked', false);
          $('#sermenus').val(null);
          getOrders();
        }
    });
  } else if(sid.includes('RE-')){
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        type: 'POST',
        url: `/pos/addtocartbyreceipt`,
        data: {
            "item": sid,
            "_token": token,
        },
        success: function(res){
         // $('#crepay').prop('checked', false);
          $('#sermenus').val(null);
          getOrders();
        }
    });
  }
});
//open and submit kot
const kot = () =>  {
if($('#autocomplete').val() == ''){
  alert('Please Choose Member');
} else{
  $('#reqtype').val('kot');
  $('#mform').submit();
}
}
//open and submit kot
const pcard = () =>  {
  $('#paymenttype').val(1);
  $('#mform').submit();
}
const pcash = () =>  {
$('#paymenttype').val(2);
$('#mform').submit();
}
const ponline = () =>  {
$('#paymenttype').val(3);
$('#mform').submit();
}
//open and submit hold
const hold = () =>  {
 
    $('#reqtype').val('hold');
    $('#mform').submit();
 
}
const paynow = () => {
  // var isValid = $("#mform").parents('form').isValid();
  // if(!isValid) {
  //   e.preventDefault(); //prevent the default action
  // }
  //alert('asdf');
  $("#mform").submit();
  printDiv();
}
// function printDiv() 
// {
//   var divToPrint=document.getElementById('printarea');
//   var newWin=window.open('','Print-Window');
//   newWin.document.open();
//   newWin.document.close();
//   setTimeout(function(){newWin.close();},10);
// }
const showvariant = (id) => {
$(".backDrop").animate({"opacity": ".80"}, 300);
$(`#variants${id}`).animate({"opacity": "1.0"}, 300);
$(`#variants${id}`).css("display", "block");
$(".backDrop").css("display", "block");
}
const showvariant2 = (id, cat) => {
$(".backDrop").animate({"opacity": ".80"}, 300);
$(`#variants${id}aa${cat}`).animate({"opacity": "1.0"}, 300);
$(`#variants${id}aa${cat}`).css("display", "block");
$(".backDrop").css("display", "block");
}
 
$(document).ready(() => {
  //set time
  var dtimee = $('#dtimee').val();
  
  if(dtimee == ''){
    $('#dtimee').val(`<?=$daten;?>`)
  }
  //items
  getOrders();
  //lightbox 
  $("#pay").on("click", function(){
    $(".backDrop").animate({"opacity": ".80"}, 300);
    $(".box").animate({"opacity": "1.0"}, 300);
    $(".backDrop, .box").css("display", "block");
  });
  //lightbox 
  // $("#pay2").on("click", function(){
  //   $(".backDrop").animate({"opacity": ".80"}, 300);
  //   $(".boxordersource").animate({"opacity": "1.0"}, 300);
  //   $(".backDrop, .boxordersource").css("display", "block");
  // });
  $(".close, .backDrop").on("click", function(){
    closeBox();
  });
  function closeBox(){
    $(".backDrop, .box, .box2, .sales_return, .boxsett3, .boxordersource, .variant").animate({"opacity": "0"}, 300, function(){
    $(".backDrop, .box, .box2, .sales_return, .boxsett3, .boxordersource, .variant").css("display", "none");
    });
  }
  //lightbox sales return 
  $("#salesreturn").on("click", function(){
    $(".backDrop").animate({"opacity": ".80"}, 300);
    $(".sales_return").animate({"opacity": "1.0"}, 300);
    $(".backDrop, .sales_return").css("display", "block");
  });
 
 
});
  //lightbox addon
  const showaddon = (pitem, pid)=>{
    getaddon(pitem);
    getaddonavailable(pid, pitem);
    $(".backDrop").animate({"opacity": ".80"}, 300);
    $(".box2").animate({"opacity": "1.0"}, 300);
    $(".backDrop, .box2").css("display", "block");
  }
  //show settlement
  const showsettlement = ()=>{
    $.ajax({
        type: 'GET',
        url: `/pos/getsettlement`,
        success: function(res){
         // console.log(res);
          $('#settle_total').empty();
          $('#settle_total_cash').empty();
          $('#settle_total_card').empty();
          $('#settle_total_online').empty();
          $('#settle_total_cash').empty();
          $('#settle_total_drawer').empty();
          $('#settle_t').empty();
          $('#settle_a').empty();
          $('#settle_o').empty();
          $('#sold_items').empty();
       
          $('#settle_total').append(res.st);
          $('#settle_total_cash').append(res.cash);
          $('#settle_total_card').append(res.card);
          $('#settle_total_online').append(res.online);
          $('#settle_total_drawer').append(res.drawer);
      
          res.items.map(item => {
            $('#sold_items').append(`
            <div class="row sitem">
              <div class="col-sm-4">${item.product.name}</div>
              <div class="col-sm-4">${item.quantity_sum}</div>
              <div class="col-sm-4">RO: ${ parseFloat(
        item.price_sum.replace(/,/g, ".")
    ).toFixed(3)}</div>
            </div>
            `);
          })
          res.online_order.map(item => {
            $('#settle_t').append(`
            <div class="row sitem">
              <div class="col-sm-8">${item[0]}</div>
      
              <div class="col-sm-4">RO: ${item[1]}</div>
            </div>
            `);
          })
 
        }
    });
   
    $(".backDrop").animate({"opacity": ".80"}, 300);
    $(".boxsett3").animate({"opacity": "1.0"}, 300);
    $(".backDrop, .boxsett3").css("display", "block");
  }
  //settlement done
  const donsettlement = () => {
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        type: 'POST',
        url: `/pos/donesettlement`,
        data: {
            //"token": id,
            "_token": token,
        },
        success: function(res){
        location.reload();  
        }
    });
  }
    //get addon items
    const getaddonavailable = (id, pitem) => {
    $.ajax({
      url: `/pos/getaddonava/${id}`,
      async: true,
      dataType: 'json',
      success: function (data) {
        //console.log(data);
        $('#addonwrap').empty();
        data.map(item => {
          $('#addonwrap').append(`<div class="col-md-6"  onclick="addtocartaddon('${item.id}', '${pitem}');" >
          <div style="
              color: #fff;
              font-size: 13px;
              text-align: center;
              font-weight: 600;
              padding: 10px 0 5px;
              border: 1px solid #363e54;
              margin-top: 5px; cursor:pointer
          ">
            ${item.name}
          </div></div>`);
          
        })
        
      }
    });
  }
  //get addon items
  const getaddon = (id) => {
    $.ajax({
      url: `/pos/getaddon/${id}`,
      async: true,
      dataType: 'json',
      success: function (data) {
        //console.log(data);
        $('#addoncart').empty();
        data.map(item => {
          $('#addoncart').append(`
          <div class="row" style="
              color: #fff;
              font-size: 13px;
              text-align: left;
              font-weight: 600;
              padding: 10px 0 5px;
              border-top: 1px solid #363e54;
              margin-top: 5px;
          ">
            <div class="col-sm-1 p0">${item.id}</div>
            <div class="col-sm-4 p0">${item.name}</div>
            <div class="col-sm-2 p0">${item.pivot.quantity}</div>
            <div class="col-sm-2 p0">${item.price}</div>
            <div class="col-sm-3 p0">
              <div style="display: flex"> 
                <button type="button" onclick="addtocartaddon('${item.id}', '${id}')" class="btn btn-circle btn-sm">
                  <i class="fas fa-plus btnc"></i>
                </button>
                <button type="button" onclick="downcartaddon('${item.id}', '${id}');" class="btn  btn-circle btn-sm">
                  <i class="fas fa-minus btnc"></i>
                </button>
                <button type="button" style="margin-left: 2px" onclick="removecartaddon('${item.id}', '${id}');" class="btn  btn-circle btn-sm">
                  <i class="fas fa-trash btnc"></i>
                </button>
              </div>
            </div>  
          </div>`);
        })
        
      }
    });
  }
 
  $(document).ready(function(){	
    
    
	var members = [];
	$.ajax({
		url: "/pos/getmembers",
   // /pos/getmember
		async: true,
		dataType: 'json',
		success: function (data) {
      //console.log(data);
			for (var i = 0, len = data.length; i < len; i++) {
				var id = (data[i].id).toString();
				members.push({
          'value' : data[i].memberid +` | `+ data[i].phone +` | `+ data[i].name +` | `+ data[i].ar_name +` | `+ data[i].rank.name +` | `+ data[i].serviceid +` | `+ data[i].room_address, 
          'data' : id, 
          'name' : data[i].name, 
          'pty' : data[i].payment_type_id, 
          'credit' : data[i].total_credit
          });
			}
			loadSuggestions(members);
		}
	});
  var menus = [];
	$.ajax({
		url: "/pos/getmenus",
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
	function loadSuggestions(options) {
		$('#autocomplete').autocomplete({
			lookup: options,
			onSelect: function (member) {
        //console.log(member);
        //console.log();
        $('#totcre').val(null);
        $('#totcre2').val(null);
        $('#totcre2').val(member.credit);
        $('#totcrename').empty();
        $('#totcre').val(member.credit);
        $('#totcrename').append(member.name);
        getPaymenttype(member.data);
        var res2 = member.value.split(" | ");
        // switch (member.pty) {
        //   case 1:
        //     var pty = 'Cash';
        //     break;
        //   case 2:
        //     var pty = 'Credit';
        //     break;
        
        //   default:
        //     var pty = 'Cash / Credit';
        //     break;
        // }
        $('#autocomplete2').val(res2[2]);
        var dtimee = $('#dtimee').val();
        if(dtimee != ''){
          cartcontinue(member.data, dtimee, 'withid');
        }
			}
		});
	}
  });
const getlimitbydate = () => {
    var dtimee = $('#dtimee').val();
    
    var res = $('#autocomplete').val().split(" | ");
    if(dtimee != '' & res[0] != ''){
      cartcontinue(res[0], dtimee, 'withmid');
    }
}
  
 
  //member selected to continue
  const cartcontinue = (data, delitime, pa) => {
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        type: 'POST',
        url: `/pos/creditstatus`,
        data: {
          "id": data,
          "dt": delitime,
          "pa": pa,
          "_token": token,
        },
        success: function(res){
          //console.log(res.msg);
          if(res.msg == 'ok'){
            $('#delivery').empty();
            $('#alert').empty();
            $('#pay').prop('disabled', false);
            $('#delivery').append(`
            <div class=" flex">
            <label class="box3"><input type="radio" required name="del" value="Take away" onClick="takeaway()"> <b class="lab1a">Take away</b></label>
            <label class="box3"><input type="radio" required name="del" value="Dinein" onClick="getTables('${data}')"> <b class="lab1a">Dinein</b></label>
            <label class="box3" style="margin-right:0"><input type="radio" required name="del" value="Delivery" onClick="ShowDelType('${data}')"> <b class="lab1a">Delivery</b></label>
            </div>`);
          }
          else{
            $('#delivery').empty();
            $('#dt').empty();
            $('#tables').empty();
            //$('#pt').empty();
            $('#alert').empty();
            $('#alert').append(`<div class="alert flex">${res.msg}</div>`);
            $('#pay').prop('disabled', true);
            //alert(res.msg);
          }
        }
    });
  }
  //continue with military id
  const cartcontinuebymid = (data) => {
    $.ajax({
        type: 'GET',
        url: `/pos/creditstatus2/${data}`,
        success: function(res){
          //console.log(res.msg);
          if(res.msg == 'ok'){
            $('#delivery').empty();
            $('#alert').empty();
            $('#pay').prop('disabled', false);
            $('#delivery').append(`
            <div class=" flex">
            <label class="box1a"><input type="radio" required name="del" value="Take away" onClick="takeaway()"> <b class="lab1a">Take away</b></label>
            <label class="box1a"><input type="radio" required name="del" value="Dinein" onClick="getTables('${res.id}')"> <b class="lab1a">Dinein</b></label>
            <label class="box1a" style="margin-right:0"><input type="radio" required name="del" value="Delivery" onClick="ShowDelType('${res.id}')"> <b class="lab1a">Delivery</b></label>
            </div>`);
          }
          else{
            $('#delivery').empty();
            $('#dt').empty();
            $('#tables').empty();
           // $('#pt').empty();
            $('#alert').empty();
            $('#alert').append(`<div class="alert flex">${res.msg}</div>`);
            $('#pay').prop('disabled', true);
            //alert(res.msg);
          }
        }
    });
  }
  const takeaway = () => {
    $('#dineinwrap').css({display : 'none'});
$('#deliverywrap').css({display : 'none'});
$('#dtawrap').css({display : 'block'});
  }
 
  
  const hideloc = () =>  {
    $('#locations').empty();
  }
  const ShowDelType = (memberid) =>  {
    $('#dineinwrap').css({display : 'none'});
$('#deliverywrap').css({display : 'block'});
$('#dtawrap').css({display : 'none'});
    
  }
  const getPaymenttype = (memberid) => {
    $('#pt').empty();
        $.ajax({
            type: 'GET',
            url: `/pos/${memberid}/getpaymenttype`,
            success: function(res){
             //console.log(res);
             
             switch (res.id) {
              case 1:
                $('#pt').empty();
                $('#pt').append(`<div class="bgh p0">
                  <div class="flex"><label class="box3"  style="margin-right: 0"><input  type="radio"  required name="pt" value="1"> <b class="lab1a">Card</b></label></div>
                </div>`);
                 break;
              case 2:
                $('#pt').empty();
                $('#pt').append(`<div class="bgh p0">
                  <div class="flex"><label class="box3"  style="margin-right: 0"><input  id="crepay" type="radio"  required name="pt" value="2"> <b class="lab1a">Credit</b></label></div></div>`);
                 break;
             
               default:
                $('#pt').empty();
                $('#pt').append(`<div class="bgh p0">
                  <div class="flex">
                  <label class="box3"><input type="radio"  required name="pt" value="1"> <b class="lab1a">Card</b></label>
                  <label class="box3 checkbx"  style="margin-right: 0"><input type="radio"  id="crepay" required name="pt" value="2"> <b class="lab1a">Credit</b></div>
                  </label></div>`);
                 break;
             }
            }
        });
  }
const getTables = (memberid) => {
  $('#dineinwrap').css({display : 'block'});
  $('#deliverywrap').css({display : 'none'});
$('#dtawrap').css({display : 'none'});
}
  
  
  const getOrders = () => {
          $.ajax({
          type: 'GET',
          url: '/pos/getcart',
          success: function(res){
            //console.log(res);
              $('#cart').empty();
              $('#cart').append(`<div class="row itemtitlebar" style="width:calc(100% + 12px)">
                <div class="col-sm-1 " style="padding-left:25px">No</div>
                <div class="col-sm-2 p0">Item Name</div>
                <div class="col-sm-2 ">Quantity</div>
                <div class="col-sm-1 p0">Unit Price</div>
                <div class="col-sm-2 ">Discount</div>
             
               
                <div class="col-sm-2 ">Total</div>
                <div class="col-sm-2" style="font-size:9px">Addon</div>
              </div>
              `)
              var subt = [];
              var n =1;
              res.orderproducts.map(item => {
                //console.log(item);
                
              if(item.available_addons != ''){
                var btn = `<button type="button"  onclick="showaddon('${item.id}', '${item.product.id}')" value="${item.product.id}" style="background:#3f59ad;float:right;width: 50px;color: #fff;margin-right:15px; font-size:11px" class="btn btn-circle btn-sm">
                   Addon
                </button>`
              }
              else {
                var btn = ''
              }
       
            
                switch (item.variant) {
                  case 1:
                    var vv = '('+item.product.v1_name+')';
                    break;
                  
                  case 2:
                    var vv = '('+item.product.v2_name+')';;
                    break;
                  case 3:
                    var vv = '('+item.product.v3_name+')';;
                    break;

                  case 4:
                    var vv = '('+item.product.v4_name+')';;
                    break;
                
                  default:
                    var vv = '';
                    break;
                }
        
                  $('#cart').append(
                    `<div class="item">
          <div class="row">
            <div class="col-sm-1 price " style="padding-left:25px">${n}</div>
            <div class="col-sm-2 price p0">${item.product.name} ${vv} </div>
            <div class="col-sm-2 p0">
              <div style="display: flex">
              
                          
                          <button type="button" onclick="addtocart('${item.product.id}', '${item.variant}', '${item.product.price}', '${item.product.vat}', '${item.product.promotion_price}');" class="btn btn-circle btn-sm">
                            <i class="fas fa-plus btnc"></i>
                          </button>
                          <label class="qty"><input class="smtxt" id="${item.id}" onChange="updqty('${item.id}')" type="text" value="${item.quantity}"></label>
          
                          <button  type="button" onclick="downcart('${item.product.id}');" class="btn  btn-circle btn-sm">
                            <i class="fas fa-minus btnc"></i>
                          </button>
                        </div>
            
            
            
            </div>
            <div class="col-sm-1 price p0">${item.unit_price_with_promotion}</div>
            <div class="col-sm-2 p0">
              <input value="${item.discount}" style="font-size:14px" onChange="adddiscount('${item.id}', '${item.product.id}${item.variant}');" 
              id="itemd${item.product.id}${item.variant}" class="itemdis" type="text">
            </div>
        
          
            <div class="col-sm-2 ttl p0" >${item.sub_price}</div>
            
            <div class="col-sm-2 act p0">
              <div style="display: flex">
   
                ${btn}
                
                
              </div>
            </div>
           
          </div>
        </div>`);
        n = n+1;
          });
          //get total price
          gettotprice()
          }
      });
  };
  const gettotprice = async () => {
    $.ajax({
        type: 'GET',
        url: "/pos/totalprice",
        success: function(res) {
          //console.log(res);
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
            $('#vat').append(`<div class="col-sm-6">VAT:</div><div class="col-sm-6" ><label  style="font-weight: 600;">${res.tax}</label></div>`);
          }
          $('#subtotal').append(res.subtotal);
          $('#subtotal2').val(res.subtotal);
          if(res.discount != '0.000'){
            $('#discount').append(`<div class="col-sm-6">Discount:</div><div class="col-sm-6" ><label style="font-weight: 600;">${res.discount}</label></div>`);
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
  let qty = $(`#${cart_item}`).val();
  var token = $("meta[name='csrf-token']").attr("content");
  $.ajax({
      type: 'POST',
      url: `/pos/updqty`,
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
 
  // addtocart main items
  const addtocart = (item, va, price, vat, promotion_price) => {
   
   
    $(".backDrop, .box, .box2, .sales_return, .boxsett3, .boxordersource, .variant").animate({"opacity": "0"}, 300, function(){
    $(".backDrop, .box, .box2, .sales_return, .boxsett3, .boxordersource, .variant").css("display", "none");
    });
      var token = $("meta[name='csrf-token']").attr("content");
      $.ajax({
          type: 'POST',
          url: `/pos/addtocart`,
          data: {
              "id": item,
              "va": va,
              "price": price,
              "vat": vat,
              "promotion_price": promotion_price,
              "_token": token,
          },
            success: function(res){
            
            getOrders();
          }
      });
  }
// addtocart main items
const addtocartvariant = (item, va) => {
  
  var token = $("meta[name='csrf-token']").attr("content");
  $.ajax({
      type: 'POST',
      url: `/pos/addtocartvariant`,
      data: {
          "id": item,
          "v": va,
          "_token": token,
      },
      success: function(res){
        getOrders();
      }
  });
}
  // addtocart addon items
  const addtocartaddon = (item, pitem) => {
  
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        type: 'POST',
        url: `/pos/addtocartaddon`,
        data: {
            "id": item,
            "pid": pitem,
            "_token": token,
        },
        success: function(res){
         //console.log(res);
          getaddon(pitem);
          getOrders();
        }
    });
  }
//remove item from cart
const removecart = (item) => {
var token = $("meta[name='csrf-token']").attr("content");
  $.ajax({
      type: 'POST',
      url: `/pos/removecart`,
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
const adddiscount = (item, id) => {
var dis = $(`#itemd${id}`).val();
  var token = $("meta[name='csrf-token']").attr("content");
  $.ajax({
      type: 'POST',
      url: `/pos/adddiscount`,
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
  //console.log(ccre);
  // ccre = ccre.replace(/\,/g,'');
  // ccre = ccre.replace(',', '');
  // ccre = Number(ccre);
  // avcre = Number(avcre);
  //console.log(ccre);
  //if(Math.floor(avcre) < Math.floor(ccre)){
    return true;
  
  // } else{
  //  // $('#crepay').prop('checked', false);
  //   $('#vallimit').append('Credit Limit Exced!');
  //   alert('Credit Limit Exced');
  //   return false;
  // }
});
// const getDelTime = () => {
//   console.log($('#reqtype').val());
 
//   var avcre = $('#subtotal2').val();
//   var ccre = $('#totcre').val();
//   $('#vallimit').empty();
//   ccre = ccre.replace(/\,/g,'');
//   ccre = Number(ccre);
//   avcre = Number(avcre);
//   if(Math.floor(avcre) < Math.floor(ccre)){
//     return true;
  
//   } else{
//     $('#crepay').prop('checked', false);
//     $('#vallimit').append('Credit Limit Exced!');
//     return false;
//   }
// }
 
 
</script>

<script src="{{asset('dashboard/js/jquery.autocomplete.min.js')}}"></script>

@endsection