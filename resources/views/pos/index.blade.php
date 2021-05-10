@extends('pos.layout.master')

<?php 
$menutypes = resolve('menutypesforpos');
?>

@section('content')
<div class="row">

 



  <div class="col-sm-4 p0" style="background: #2c3346; padding:0; height: 94vh;">
    <form action="{{route('pos.checkout')}}" method="POST">
      @csrf
    <div class="bgh">
      <b class="lab1">Member ID</b>
      <input type="text" name="memberid" required id="autocomplete" class="form-control w-full txtb">
    </div>


    <div class="card  shadow-xs my-1" id="leftpanel" style="padding:10px; padding-left:32px; padding-right:10px">
      <b class="lab1">Order List</b>
      <label class="lab3">{{ Carbon\Carbon::now()->isoFormat('LLLL') }}</label>



      <div id="itembox" class="scro" style="height: 44vh; margin-top:10px; overflow:hidden;  overflow-y: scroll;">
        <div class="cart"  style="width:100%" id="cart">
        </div>
      </div>
    </div>

    <div style="height: 22vh"> 
      <div class="bgh" style="padding-bottom: 3px;padding-top: 14px;">
        <div class="row">
          <div class="col-sm-7">Sub Total:</div>
          <div class="col-sm-5" ><label class="total" style="font-weight: 600;"></label></div>
          <div class="col-sm-7">Tax:</div>
          <div class="col-sm-5" ><label style="font-weight: 600;">0.000</label></div>
        </div>
        
      </div>

      <div class="bgh" style="border-top:1px solid #2c3346; padding:15px 20px 10px">
        <div class="row">
          <div class="col-sm-7"><b class="lab1">Total:</b></div>
          <div class="col-sm-5" style="color: #ef6380; line-height:20px">OMR <label class="total" style="font-weight: 600;font-size: 30px;"></label></div>
        </div>
      </div>

      <div class="col-sm-12">

  <div class="backDrop"></div>
  
  <div class="box">
   


    <div class="p0">
      {{-- <div class="p10">
        <b class="lab1">Member ID</b>
        <input type="text" name="memberid" required id="autocomplete" class="form-control w-full border-gray-400">
      </div> --}}
      <div class="bgh2" id="delivery"></div>
      <div class="bgh" id="pt"></div>
      <div class="bgh flex" style="display: flex;flex-wrap: wrap;" id="tables"></div>
      <div class="bgh2" id="dt"></div>
      <div class="bgh" id="locations"></div>
      
      <div class="bgh" id="dtime"></div>

      <button class="btn btn-primary btnc1"   type="submit" style="
      position: absolute;
      bottom: 0;
      right: 0;
  ">Submit Order <i class="fas fa-arrow-right"></i></button>

    </div>
    
    



  </div>
     
        
        <button class="btn btn-primary btnc1" id="pay" type="button">Pay Now <i class="fas fa-arrow-right"></i></button>
        
      </div>


     

      

    </div>


 
 

  </form>

  </div>














  

  <div class="col-sm-8 mt-4">
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
                  min-height:170px;
    background-size: 100% 100%;">
                    <h5 ><span style="font-size: 10px">RO</span> {{$product->price}}</h5>
                     

                    <h6 style="background: #00000069;
                    border-radius: 6px;
                    margin: 10px;margin-top:130px; color:white">{{$product->name}}</h6>
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
      getOrders();

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
        <input type="radio" required name="del" value="Take away" onClick="getPaymenttype('${member.value}'); takeaway()"> <b class="lab1a">Take away</b>
        <input type="radio" required name="del" value="Dining" onClick="getTables('${member.value}')"> <b class="lab1a">Dining</b>
        <input type="radio" required name="del" value="Delivery" onClick="ShowDelType('${member.value}')"> <b class="lab1a">Delivery</b>`);
			}
		});
	}
  });

  const takeaway = () => {
    $('#tables').empty();
    $('#dtime').empty();

  }

  const hideloc = () =>  {

$('#locations').empty();
  }

  const ShowDelType = (memberid) =>  {

    $('#dt').empty();
    $('#tables').empty();
    $('#pt').empty();
    $('#dtime').empty();



    $('#dt').append(`<input type="radio"  required onClick="getPaymenttype('${memberid}');hideloc()" name="dl" value="1"> <b class="lab1a">Room Services</b>
                     <input type="radio" required name="dl" value="2" onClick="getDeliverylocations('${memberid}')"> <b class="lab1a">Locations</b>`);
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
                $('#pt').append(`<b class="lab2">Payment Type</b><input type="radio" onClick="getDelTime()" required name="pt" value="1"> <b class="lab1a">Cash</b>`);
                 break;

              case 2:
                $('#pt').empty();
                $('#pt').append(`<b class="lab2">Payment Type</b><input type="radio" onClick="getDelTime()" required name="pt" value="2"> <b class="lab1a">Card</b>`);
                 break;
             
               default:
                $('#pt').empty();
                $('#pt').append(`<b class="lab2">Payment Type</b><input type="radio" onClick="getDelTime()" required name="pt" value="1"> <b class="lab1a">Cash</b>
                <input type="radio" onClick="getDelTime()" required name="pt" value="2"> <b class="lab1a">Card</b>`);
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

        $('#tables').append(`<b class="lab1">Choose Table</b>`)

        res.map(item => {
          if(item.status == 1){
          
            $('#tables').append(`
              <div class="col-md-2" style="padding:2px;"  >

                <div class="form-check">
                  <input class="form-check-input" type="radio" value="${item.id}" name="table" onClick="getPaymenttype('${memberid}')" required id="flexRadioDefault2">
                </div>

                <div class="tablepic" style="background:#216d40">
                <h5>${item.name}</h5>
                <p>Chair: ${item.chair}</p>
                
                </div>
              </div>`);
          
          
          } else{ 
          $('#tables').append(`
              <div class="col-md-2" style="padding:2px;">
                <div class="tablepic" style="background:#9a291e">
                <h5>${item.name}</h5>
                <p>Chair: ${item.chair}</p>
                </div>
              </div>`);}

          
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
              var sum = null;
              res.products.map(item => {

                sum += item.price * item.pivot.quantity;

                  $('#cart').append(
                    `
                    <div class="item">
          <h3>${item.name}</h3>
          <div class="row">
            <div class="col-sm-4 price">${item.price}</div>
            <div class="col-sm-2"><label class="qty">${item.pivot.quantity}</label></div>
            <div class="col-sm-3 ttl">${item.price * item.pivot.quantity}</div>
            <div class="col-sm-3 act">
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
              </div>
            </div>
          </div>
        </div>`);
              });

              $('.total').empty();
              $('.total').append(sum); 
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
const getDeliverylocations = (memberid) => {
  $('#pt').empty();
  
    $.ajax({
        type: 'GET',
        url: "/pos/locations",
        success: function(res) {
          //console.log(res);

          $('#locations').empty();
          $('#locations').append(`<select onChange="getPaymenttype('${memberid}')" class="form-control w-full border-gray-400" name="location" required><option>Select Locations</option>`)


          res.map(locations => {
              //console.log(subcat);
              
              $('#locations select').append('<option value="' + locations.id + '">' + locations.name + '</option>')
          })
          $('#locations').append('</select>')

            
        }
    })
    
}

const getDelTime = () => {

  //alert('da');
    $('#dtime').empty();
    $('#dtime').append(`<b class="lab1a">Delivery Time</b><input name="dtime" type="datetime-local" class="form-control w-full border-gray-400">`);

    //$("#ctime").val(new Date().toJSON().slice(0,19));

}
 

 

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.2.27/jquery.autocomplete.min.js"></script>

@endsection

