@extends('pos.layout.master')

<?php 
$menutypes = resolve('menutypesforpos');
?>

@section('content')
<div class="row">

 



  <div class="col-sm-6 p0" style="background: #2c3346; padding:0; height: 94vh;">
    <form action="{{route('pos.checkout')}}" method="POST">
      @csrf
    


    <div class="card  shadow-xs my-1" id="leftpanel" style="padding:10px; padding-left:32px; padding-right:10px">
      <b class="lab1">Order List</b>
      <label class="lab3">{{ Carbon\Carbon::now()->isoFormat('LLLL') }}</label>



      <div id="itembox" class="scro" style="height: 54vh; margin-top:10px; overflow:hidden;  overflow-y: scroll;">
        <div class="cart"  style="width:100%" id="cart">
        </div>
      </div>
    </div>

    <div style="height: 22vh"> 
      <div class="bgh" style="padding-bottom: 3px;padding-top: 14px;">
        <div class="row">
          <div class="col-sm-7">Sub Total:</div>
          <div class="col-sm-5" ><label id="st"  style="font-weight: 600;"></label></div>
          <div class="col-sm-7">VAT:</div>
          <div class="col-sm-5" ><label id="vat"  style="font-weight: 600;">0.000</label></div>
          <div class="col-sm-7">Discount:</div>
          <div class="col-sm-5" ><label id="discount" style="font-weight: 600;">0.000</label></div>
        </div>
        
      </div>

      <div class="bgh" style="border-top:1px solid #2c3346; padding:15px 20px 10px">
        <div class="row">
          <div class="col-sm-7"><b class="lab1">Total Amount:</b></div>
          <div class="col-sm-5" style="color: #ef6380; line-height:20px">OMR <label class="total" id="subtotal" style="font-weight: 600;font-size: 30px;"></label></div>
        </div>
      </div>

      <div class="col-sm-12">

  <div class="backDrop"></div>
  
  <div class="box scro" style="max-height: 90vh">
   


    <div class="p0">
      

      <div class="bgh" style="display: flex">
        <div class="col-sm-8">
          <b class="lab1a">Member ID</b>
          <input type="text" name="memberid" required id="autocomplete" class="form-control w-full txtb">
        </div>
        <div class="col-sm-3" style="float: right; padding-top:20px">OMR 
          <label id="subtotal2" style="
          float: right;
          font-size: 33px;
          color: #e65776;
      "></label>
        </div>
        
      </div>


      <div id="delivery"></div>
      
      <div id="tables"></div>
      <div id="dt"></div>
      <div id="locations"></div>
      <div id="pt"></div>
      
      
      <div id="dtime"></div>

      <button class="btn btn-primary btnc1"   type="submit" style="
      position: relative; float:right; 
  ">Submit Order <i class="fas fa-arrow-right"></i></button>

    </div>
    
    



  </div>
     
        
        <button class="btn btn-primary btnc1" id="pay" type="button">Pay Now <i class="fas fa-arrow-right"></i></button>
        
      </div>


     

      

    </div>


 
 

  </form>

  </div>














  

  <div class="col-sm-6 mt-4">
    <div class="card  shadow-xs mt-1" >
      <div id="exTab2"  >	
        <ul class="nav nav-tabs">

          @foreach ($menutypes as $menutype)
          <?php $nub = 1; ?>
            <li class="@if ($loop->first) active   @endif">
              <a  href="#{{$menutype->id}}" data-toggle="tab">{{$menutype->name}}</a>
            </li>
            <?php 
            $nub = 2;
            ?>
          @endforeach
        </ul>
        
        <div class="tab-content scro2" style="height: 80vh; max-height:80vh; overflow-y:scroll">

          @foreach ($menutypes as $menutype)
            <div class="tab-pane @if ($loop->first) active @endif flex" id="{{$menutype->id}}" >
              <div style="display: flex;flex-wrap: wrap;">
                @forelse ($menutype->products as $product)
                  <div class="card itembox" onclick="addtocart({{$product->id}});" 
                  style="background: url('@if($product->cover != null){{env('IMAGE_PATH')}}{{ $product->cover}} @else {{asset('img/dummy_img.jpg')}}@endif');
                  min-height:140px;
    background-size: 100% 100%;">
                    <h5 ><span style="font-size: 10px">RO</span> {{$product->price}}</h5>
                     

                    <h6 class="itemtitle">{{$product->name}}</h6>
                  </div>
                @empty
                  No menu found!
                @endforelse
              </div>
            </div>
          @endforeach

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

      //lightbox 
      $("#pay").on("click", function(){
        $(".backDrop").animate({"opacity": ".80"}, 300);
        $(".box").animate({"opacity": "1.0"}, 300);
        $(".backDrop, .box").css("display", "block");
      });
      $(".close, .backDrop").on("click", function(){
        closeBox();
      });
      function closeBox(){
        $(".backDrop, .box").animate({"opacity": "0"}, 300, function(){
        $(".backDrop, .box").css("display", "none");
        });
      }

      



  });


  $(document).ready(function(){	
	var arrayReturn = [];
	$.ajax({
		url: "/pos/getmembers",
   // /pos/getmember
		async: true,
		dataType: 'json',
		success: function (data) {
      //console.log(data);
			for (var i = 0, len = data.length; i < len; i++) {
				var id = (data[i].id).toString();
				arrayReturn.push({'value' : data[i].memberid, 'data' : id});
			}
		 
			//send parse data to autocomplete function
			loadSuggestions(arrayReturn);
			// console.log(countries);
			// console.log(arrayReturn);
		}
	});

	function loadSuggestions(options) {
		$('#autocomplete').autocomplete({
			lookup: options,
			onSelect: function (member) {

        // $('#itembox').css({ height: '20vh', overflow:'scroll' });
        // $('#leftpanel').css({ height: '30vh' });
        // $('#frm1').css({ height: '54vh' });
      




				$('#delivery').empty();
        $('#delivery').append(`
        <div class="bgh2 flex">
        <div class="box1"><input type="radio" required name="del" value="Take away" onClick="getPaymenttype('${member.value}'); takeaway()"> <b class="lab1a">Take away</b></div>
        <div class="box1"><input type="radio" required name="del" value="Dining" onClick="getTables('${member.value}')"> <b class="lab1a">Dining</b></div>
        <div class="box1"><input type="radio" required name="del" value="Delivery" onClick="ShowDelType('${member.value}')"> <b class="lab1a">Delivery</b></div>
        </div>`);
			}
		});
	}
  });

  const takeaway = () => {
    $('#tables').empty();
    $('#dtime').empty();
    $('#locations').empty();
    $('#dt').empty();


  }

  const hideloc = () =>  {

$('#locations').empty();
  }

  const ShowDelType = (memberid) =>  {

    $('#dt').empty();
    $('#tables').empty();
    $('#pt').empty();
    $('#dtime').empty();



    $('#dt').append(`<div class="bgh flex">
    <div class="box2"><input type="radio"  required onClick="getPaymenttype('${memberid}');hideloc()" name="dl" value="1"> <b class="lab1a">Room Services</b></div>
    <div class="box2"><input type="radio" required name="dl" value="2" onClick="getDeliverylocations('${memberid}')"> <b class="lab1a">Locations</b></div>
                     </div>`);
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
                $('#pt').append(`<div class="bgh"><b class="lab1a">Payment Type</b>
                  <div class="flex"><div class="box2"><input type="radio" onClick="getDelTime()" required name="pt" value="1"> <b class="lab1a">Cash</b></div></div>
                </div>`);
                 break;

              case 2:
                $('#pt').empty();
                $('#pt').append(`<div class="bgh"><b class="lab1a">Payment Type</b>
                  <div class="flex"><div class="box2"><input type="radio" onClick="getDelTime()" required name="pt" value="2"> <b class="lab1a">Credit</b></div></div></div>`);
                 break;
             
               default:
                $('#pt').empty();
                $('#pt').append(`<div class="bgh"><b class="lab1a">Payment Type</b>
                  <div class="flex">
                  <div class="box2"><input type="radio" onClick="getDelTime()" required name="pt" value="1"> <b class="lab1a">Cash</b></div>
                  <div class="box2"><input type="radio" onClick="getDelTime()" required name="pt" value="2"> <b class="lab1a">Credit</b></div>
                  </div></div>`);
                 break;
             }

            }
        });
  }


const getTables = (memberid) => {

  $('#pt').empty();
  $('#dtime').empty();
  $('#dt').empty();



  $.ajax({
      type: 'GET',
      url: `/pos/gettables`,
      success: function(res){
        $('#tables').empty();
        $('#locations').empty();


        $('#tables').append(`<div class="bgh flex" style="flex-wrap: wrap;" id="tdd">`)

        res.map(item => {
          if(item.status == 1){
          
            $('#tdd').append(`
              <div class="col-md-1" style="padding:2px;"  >

                <div class="form-check">
                  <input class="form-check-input" type="radio" value="${item.id}" name="table" onClick="getPaymenttype('${memberid}')" required id="flexRadioDefault2">
                </div>

                <div class="tablepic" style="background:#216d40">
                <h5>${item.name}</h5>
                <p>Seat: ${item.chair}</p>
                
                </div>
              </div>`);
          } else{ 
            $('#tdd').append(`
                <div class="col-md-1" style="padding:2px;">
                  <div class="tablepic" style="background:#9a291e">
                  <h5>${item.name}</h5>
                  <p>Seat: ${item.chair}</p>
                  </div>
                </div>`)
          }

        })

      

      }

      


  });
}
  
  
  const getOrders = () => {
          $.ajax({
          type: 'GET',
          url: '/pos/getcart',
          success: function(res){
              $('#cart').empty();

              $('#cart').append(`<div class="row" style="
    color: #e65776;
    font-size: 12px;
    text-align: left;
    font-weight: 600;
">
              <div class="col-sm-1 p0">S.N</div>
              <div class="col-sm-2 p0">Item</div>
              <div class="col-sm-1 p0">Qty</div>
              <div class="col-sm-2 p0">U.Price</div>
              <div class="col-sm-1 p0">VAT</div>
              <div class="col-sm-1 p0">Dis</div>
              <div class="col-sm-2 p0">Total</div>
              <div class="col-sm-2 p0">Action</div>
              
             
            </div>
              `)

              var subt = [];
              res.products.map(item => {

                
//console.log(item);

let totalprice = (item.price * item.pivot.quantity).toFixed(3);
let totalprice_with_discount = (totalprice - item.pivot.discount).toFixed(3);
subt.push(totalprice_with_discount);




                  $('#cart').append(
                    `
                    <div class="item">
          
          <div class="row">
            <div class="col-sm-1 price ">${item.id}</div>
            <div class="col-sm-2 price p0">${item.name}</div>
            <div class="col-sm-1 p0"><label class="qty">${item.pivot.quantity}</label></div>
            <div class="col-sm-2 price p0">${item.price}</div>
            <div class="col-sm-1 ttl" >0</div>
            <div class="col-sm-1 p0"><input value="${item.pivot.discount}" style="font-size:12px" onChange="adddiscount('${item.pivot.id}', '${item.id}');" id="itemd${item.id}" class="itemdis" type="text"></div>
            <div class="col-sm-2 ttl" >${totalprice_with_discount}</div>
            
            <div class="col-sm-2 act p0">
              <div style="display: flex">
                          
                <button  onclick="addtocart('${item.id}');" class="btn btn-circle btn-sm">
                  <i class="fas fa-plus btnc"></i>
                </button>

                <button  onclick="downcart('${item.id}');" class="btn  btn-circle btn-sm">
                  <i class="fas fa-minus btnc"></i>
                </button>

                <button style="margin-left: 2px" onclick="removecart('${item.id}');" class="btn  btn-circle btn-sm">
                  <i class="fas fa-trash btnc"></i>
                </button>

                <button  onclick="" style="background:#2f5f35; float:right" class="btn btn-circle btn-sm">
                  <i class="fas fa-plus btnc"></i>
                </button>
                
              </div>
            </div>
           
          </div>
        </div>`);
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
          console.log(res);

          $('#st').empty();
          $('#subtotal').empty();
          $('#discount').empty();
          $('#subtotal2').empty();
          $('#st').append(res.price);
          $('#subtotal').append(res.subtotal);
          $('#subtotal2').append(res.subtotal);
          $('#discount').append(res.discount);
 

            
        }
    })
  }


  
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
  
  //get subcat
const getDeliverylocations = (memberid) => {
  $('#pt').empty();
  
    $.ajax({
        type: 'GET',
        url: "/pos/locations",
        success: function(res) {
          //console.log(res);

          $('#locations').empty();
          $('#locations').append(`<div class="bgh2"><b class="lab1a">Location</b>
          <select onChange="getPaymenttype('${memberid}')" class="form-control w-full txtb" name="location" required><option>Select Locations</option>`)


          res.map(locations => {
              //console.log(subcat);
              
              $('#locations select').append('<option value="' + locations.id + '">' + locations.name + '</option>')
          })
          $('#locations').append('</select></div>')

            
        }
    })
    
}

const getDelTime = () => {

  //alert('da');
    $('#dtime').empty();
    $('#dtime').append(`<div class="bgh2"><b class="lab1a">Delivery Time</b><input name="dtime" type="datetime-local" class="form-control border-gray-400 txtb"></div>`);

    //$("#ctime").val(new Date().toJSON().slice(0,19));

}
 

 

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.2.27/jquery.autocomplete.min.js"></script>

@endsection

