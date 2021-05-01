@extends('pos.layout.master')

<?php 
$menutypes = resolve('menutypesforpos');
?>

@section('content')
<div class="row">

  <div class="col-sm-5">
    <div class="card  shadow-xs my-1" style="height: 60vh; overflow:hidden">

      <div style="height: 50vh">
        <table class="cart"  style="width:100%" id="cart">
          
        
         
         

           
  
          
            
        </table>
      </div>


      <div style="height: 90px">
        <table id="customers" class="cart" style="width:100%">
          <tr>
            <th style="padding: 0"> </th>
            <th style="text-align: right; padding:0; padding-right:10px">Tax</th>
            <th width="150" style="padding:0;text-align: right; padding-right:30px; font-size:17px; font-weight:bold;">RO 0.000</th>
          </tr>

          <tr>
            <th>Order Token <b style="font-size: 19px;padding-top: 0;">#{{ $token->id }}</b></th>
            <th style="text-align: right;padding-top: 0px;">Total Amount</th>
            <th width="150" style="text-align: right; padding-right:30px; font-size:17px; font-weight:bold;" id="total">RO 30.500</th>
          </tr>
          
        </table>
      </div>
    
      
    
    </div>

    <div class="card  shadow-xs mt-2" style="height: 24vh"></div>

  </div>

  <div class="col-sm-7">
    <div class="card  shadow-xs mt-1" style="height: 85vh; max-height:85vh; overflow-y:scroll">
    
    
 
      
      <div id="exTab2"  >	
        <ul class="nav nav-tabs">

          @foreach ($menutypes as $menutype)
          <?php $nub = 1; ?>
            <li class="@if ($loop->first) active @endif">
              <a  href="#{{$menutype->id}}" data-toggle="tab">{{$menutype->name}}</a>
            </li>
            <?php 
            $nub = 2;
            ?>
          @endforeach


              
               
            </ul>
        
              <div class="tab-content ">

          @foreach ($menutypes as $menutype)

                <div class="tab-pane @if ($loop->first) active @endif flex" id="{{$menutype->id}}" >
                  <div style="display: flex;flex-wrap: wrap;">

                    @forelse ($menutype->products as $product)
                      <div class="card itembox" onclick="addtocart({{$product->id}});">
                        <h5><span style="font-size: 10px">OMR</span> {{$product->price}}</h5>
                        <img width="100%" src="{{asset('img/dummy_img.jpg')}}">
                        <h6>{{$product->name}}</h6>
                      </div>
                    @empty
                      No menu found!
                    @endforelse
                    

                   


                  </div>
                </div>
          @endforeach



                <div class="tab-pane" id="2">
                  sdfsdf
                 </div>
                 <div class="tab-pane" id="3">
                  sdfsdf
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
      getOrders();
  });
  
  
  const getOrders = () => {
          $.ajax({
          type: 'GET',
          url: '/pos/getcart',
          success: function(res){
              $('#cart').empty();
              $('#cart').append(`<tr>
                <th  width="30">S/L</th>
                <th>Name</th>
                <th width="40">Qty</th>
                <th width="60">U.Price</th>
                <th width="60">Amount</th>
                <th width="90">Action</th>
              </tr>`)
              var sum = null;
              res.products.map(item => {

                sum += item.price * item.pivot.quantity;

                  $('#cart').append(
                    `<tr>
                      <td>${item.id}</td>
                      <td>${item.name}</td>
                      <td>${item.pivot.quantity}</td>
                      <td>${item.price}</td>
                      <td>${item.price * item.pivot.quantity}</td>
                      <td>
                        <div style="display: flex">
                          
                          <button  onclick="addtocart(${item.id});" class="btn btn-circle btn-sm">
                            <i class="fas fa-plus btnc"></i>
                          </button>
          
                          <button  onclick="downcart(${item.id});" class="btn  btn-circle btn-sm">
                            <i class="fas fa-minus btnc"></i>
                          </button>
          
                          <button style="margin-left: 2px" onclick="removecart(${item.id});" class="btn  btn-circle btn-sm">
                            <i class="fas fa-trash btnc"></i>
                          </button>
                        </div>
                      </td>
                    </tr>`
                  );
              });

              $('#total').empty();
              $('#total').append('OMR '+sum); 
          }
      });
  };
  
  const addtocart = (item) => {
  
      var token = $("meta[name='csrf-token']").attr("content");
      $.ajax({
          type: 'POST',
          url: `/pos/addtocart`,
          data: {
              "id": item,
              "_token": token,
          },
          success: function(res){
           // console.log(res);
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
        getOrders();
      }
  });
}
  
  //get subcat
  // $('#category').change(function() {
  //     var category = this.value;
  //     if (this.value) {
  //         $.ajax({
  //             type: 'GET',
  //             url: "/getsubcategory/" + category,
  //             success: function(res) {
  //                 if (res.length == 0) {
                      
  //                     $('#subcat').empty();
  //                     $('#subcat').append('<option value="">No Sub category found</option>')
  //                 } else {
  //                     $('#subcat').empty();
  //                     res.map(subcat => {
  //                         //console.log(subcat);
                          
  //                         $('#subcat').append('<option value="' + subcat.id + '">' + subcat.name + '</option>')
  //                     })
  //                 }
  //             }
  //         })
  //     }
  // });

</script>
@endsection

