@extends('pos.layout.master')

<?php 
$menutypes = resolve('menutypesforpos');
$addons = resolve('addons');
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
</style>
<div class="row">

 



  <div class="col-sm-6 p0" style="background: #2c3346; ">
    <form action="{{route('pos.checkout')}}" method="POST">
      @csrf
    


      <div class="card  shadow-xs my-1" id="leftpanel" style="padding:10px; padding-left:32px; padding-right:10px">
        <b class="lab1">Order List</b>
        <label class="lab3">{{ Carbon\Carbon::now()->isoFormat('LLLL') }}</label>



        <div id="itembox" class="scro" style="height:calc(100vh - 373px); margin-top:10px; overflow:hidden;  overflow-y: scroll;">
          <div class="cart"  style="width:100%" id="cart">
          </div>
        </div>
      </div>

    
      <div class="bgh tar" style="padding-bottom: 3px;padding-top: 14px;min-height:230px">
        <div class="row">
          <div class="col-sm-5">Sub Total:</div>
          <div class="col-sm-7" ><label id="st"  style="font-weight: 600;"></label></div>
          <div class="col-sm-5">VAT:</div>
          <div class="col-sm-7" ><label id="vat"  style="font-weight: 600;">0.000</label></div>
          <div class="col-sm-5">Discount:</div>
          <div class="col-sm-7" ><label id="discount" style="font-weight: 600;">0.000</label></div>
        </div>
        
        <div class="row totalamd tar">
          <div class="col-sm-5"><b class="lab1">Total Amount:</b></div>
          <div class="col-sm-7" style="color: #ef6380; line-height:20px; padding-left:25px">OMR <label class="total" id="subtotal" style="font-weight: 600;font-size: 30px;"></label></div>
        </div>

        <div class="row">
          <div class="col-sm-5">
            <button class="btn btn-primary btnc2" type="button"><i class="fas fa-print"></i> Print</button>
          </div>
          <div class="col-sm-7">
            <button class="btn btn-primary btnc1" id="pay" type="button">Pay Now <i class="fas fa-arrow-right"></i></button>
          </div>
        </div>
    

      </div>

      <div class="backDrop"></div>
        <div class="box scro" style="max-height: 90vh">
          <div class="p0">
            <div class="bgh" style="display: flex">
              <div class="col-sm-8">
                <b class="lab1a">Member ID / Phone / Name</b>
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
                <div class="col-sm-4 p0">Item</div>
                <div class="col-sm-2 p0">Qty</div>
                <div class="col-sm-2 p0">U.Price</div>
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
    
    </form>
  </div>



  <div class="col-sm-6 mt-4">
    <div class="card  shadow-xs mt-1" >
      <div id="exTab2"  >	
        <ul class="nav nav-tabs">


<li style="margin: 0; padding:15px 10px">
    <input type="text" class="form-control" placeholder="Search Menu" style="width: 240px"/>
  </li>


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
        
        <div class="tab-content scro2" style="min-height:calc(100vh - 170px);height:calc(100vh - 170px);overflow-y:scroll">
 <div class="catwraper" style="display: flex">

    <div class="cat" style="
      width: 60px;
      overflow: hidden;
      height: auto; margin-right:10px
    ">
      <img src="/img/dummy_img.jpg" width="100%" style="
      border-radius: 50%;
      border: 2px solid #fff;
      overflow: hidden;
      margin-bottom: 5px;
  ">
      <h6 style="
      text-align: center;
      font-size: 12px;
      font-weight: 600;
      color: #333;
  ">Category</h6>
    </div>


    <div class="cat" style="
      width: 60px;
      overflow: hidden;
      height: auto;margin-right:10px
    ">
      <img src="/img/dummy_img.jpg" width="100%" style="
      border-radius: 50%;
      border: 2px solid #fff;
      overflow: hidden;
      margin-bottom: 5px;
  ">
      <h6 style="
      text-align: center;
      font-size: 12px;
      font-weight: 600;
      color: #333;
  ">Two</h6>
    </div>

    <div class="cat" style="
      width: 60px;
      overflow: hidden;
      height: auto;margin-right:10px
    ">
      <img src="/img/dummy_img.jpg" width="100%" style="
      border-radius: 50%;
      border: 2px solid #fff;
      overflow: hidden;
      margin-bottom: 5px;
  ">
      <h6 style="
      text-align: center;
      font-size: 12px;
      font-weight: 600;
      color: #333;
  ">Cat Three</h6>
    </div>




  </div>
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
        $(".backDrop, .box, .box2").animate({"opacity": "0"}, 300, function(){
        $(".backDrop, .box, .box2").css("display", "none");
        });
      }
  });


  //lightbox addon
  const showaddon = (pitem)=>{

    $('#addonwrap').empty();

    @foreach ($addons as $item)
      $('#addonwrap').append(`<div class="col-md-6"  onclick="addtocartaddon('{{$item->id}}', '${pitem}');" >
        <div style="
            color: #fff;
            font-size: 13px;
            text-align: center;
            font-weight: 600;
            padding: 10px 0 5px;
            border: 1px solid #363e54;
            margin-top: 5px; cursor:pointer
        ">
          {{$item->name}}
        </div></div>`);
    @endforeach

    getaddon(pitem);

    $(".backDrop").animate({"opacity": ".80"}, 300);
    $(".box2").animate({"opacity": "1.0"}, 300);
    $(".backDrop, .box2").css("display", "block");
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
				arrayReturn.push({'value' : data[i].memberid +` - `+ data[i].phone +` - `+ data[i].name, 'data' : id});
			}
			//send parse data to autocomplete function
			loadSuggestions(arrayReturn);
		}
	});

	function loadSuggestions(options) {
		$('#autocomplete').autocomplete({
			lookup: options,
			onSelect: function (member) {

        //console.log(member);

        $.ajax({
            type: 'GET',
            url: `/pos/creditstatus/${member.data}`,
            success: function(res){
              //console.log(res.msg);

              if(res.msg == 'ok'){
                $('#delivery').empty();
                $('#delivery').append(`
                <div class="bgh2 flex">
                <div class="box1"><input type="radio" required name="del" value="Take away" onClick="getPaymenttype('${member.data}'); takeaway()"> <b class="lab1a">Take away</b></div>
                <div class="box1"><input type="radio" required name="del" value="Dining" onClick="getTables('${member.data}')"> <b class="lab1a">Dining</b></div>
                <div class="box1"><input type="radio" required name="del" value="Delivery" onClick="ShowDelType('${member.data}')"> <b class="lab1a">Delivery</b></div>
                </div>`);
              }
              else{

                $('#delivery').empty();
                $('#dt').empty();
    $('#tables').empty();
    $('#pt').empty();
    $('#dtime').empty();
                $('#delivery').append(`
                <div class="bgh2 flex">${res.msg}</div>`);
              }

            }
        });


				


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
    <div class="box3"><input type="radio"  required onClick="getPaymenttype('${memberid}');hideloc()" name="dl" value="1"> <b class="lab1a">Room Services</b></div>
    <div class="box3"><input type="radio" required name="dl" value="2" onClick="getDeliverylocations('${memberid}')"> <b class="lab1a">Locations</b></div>
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
                  <div class="flex"><div class="box3"><input type="radio" onClick="getDelTime()" required name="pt" value="1"> <b class="lab1a">Cash</b></div></div>
                </div>`);
                 break;

              case 2:
                $('#pt').empty();
                $('#pt').append(`<div class="bgh"><b class="lab1a">Payment Type</b>
                  <div class="flex"><div class="box3"><input type="radio" onClick="getDelTime()" required name="pt" value="2"> <b class="lab1a">Credit</b></div></div></div>`);
                 break;
             
               default:
                $('#pt').empty();
                $('#pt').append(`<div class="bgh"><b class="lab1a">Payment Type</b>
                  <div class="flex">
                  <div class="box3"><input type="radio" onClick="getDelTime()" required name="pt" value="1"> <b class="lab1a">Cash</b></div>
                  <div class="box3"><input type="radio" onClick="getDelTime()" required name="pt" value="2"> <b class="lab1a">Credit</b></div>
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

            //console.log(res);
              $('#cart').empty();

              $('#cart').append(`<div class="row itemtitlebar">
                <div class="col-sm-1 " style="padding-left:25px">S.N</div>
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
              res.orderproducts.map(item => {

              if(item.addon_total == '0.000'){
                var addont = ''
              } else {
                var addont = ' + ' + item.addon_total;
              }

                  $('#cart').append(
                    `<div class="item">
          <div class="row">
            <div class="col-sm-1 price " style="padding-left:25px">${item.id}</div>
            <div class="col-sm-2 price p0">${item.product.name} </div>
            <div class="col-sm-1 p0"><label class="qty">${item.quantity}</label></div>
            <div class="col-sm-2 price p0">${item.product.price}</div>
            <div class="col-sm-1 ttl p0" >${item.tax}</div>
            <div class="col-sm-1 p0"><input value="${item.discount}" style="font-size:15px" onChange="adddiscount('${item.id}', '${item.product.id}');" id="itemd${item.product.id}" class="itemdis" type="text"></div>
            <div class="col-sm-2 ttl" >${item.price_total_with_tax}${addont}</div>
            
            <div class="col-sm-2 act p0">
              <div style="display: flex">
                          
                <button type="button" onclick="addtocart('${item.product.id}');" class="btn btn-circle btn-sm">
                  <i class="fas fa-plus btnc"></i>
                </button>

                <button  type="button" onclick="downcart('${item.product.id}');" class="btn  btn-circle btn-sm">
                  <i class="fas fa-minus btnc"></i>
                </button>

                <button type="button" style="margin-left: 2px" onclick="removecart('${item.product.id}');" class="btn  btn-circle btn-sm">
                  <i class="fas fa-trash btnc"></i>
                </button>

                <button type="button"  onclick="showaddon('${item.id}')" value="${item.product.id}" style="background:#2f5f35; float:right" class="btn btn-circle btn-sm">
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
          //console.log(res);

          $('#st').empty();
          $('#vat').empty();
          $('#subtotal').empty();
          $('#discount').empty();
          $('#subtotal2').empty();

          $('#st').append(res.price);
          $('#vat').append(res.tax);
          $('#subtotal').append(res.subtotal);
          $('#subtotal2').append(res.subtotal);
          $('#discount').append(res.discount);
 
        }
    })
  }


  // addtocart main items
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
         console.log(res);
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

