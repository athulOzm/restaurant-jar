@extends('pos.layout.master')

<?php 
$menutypes = resolve('menutypesforpos');
?>

@section('content')
<div class="row">

  <div class="col-sm-5">
    <div class="card  shadow-xs my-1" id="leftpanel" style="height: 60vh; overflow:hidden">
      <div id="itembox" style="height: 50vh">
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


    <div class="card  shadow-xs mt-2" id="frm1" style="height: 24vh">
      <form action="{{route('pos.checkout')}}" method="POST">
        @csrf

        <div class="row">
          <div class="col-sm-10">
            <div class="p10">

              <div class="p10">
                <b class="lab1">Member ID</b>
                <input type="text" name="memberid" required id="autocomplete" class="form-control w-full border-gray-400">
              </div>
  
              <div class="p10" id="delivery"></div>
              <div class="p10 flex" style="display: flex;flex-wrap: wrap;" id="tables"></div>
              <div class="p10" id="dt"></div>
              <div class="p10" id="locations"></div>
              <div class="p10" id="pt"></div>
              <div class="p10" id="dtime"></div>

            </div>
            


          </div>
          <div class="col-sm-2">
            <input type="submit" class="btn btn-primary btnc1" value="PAY" id="pay" style="width: 100%">
          </div>

        </div>
      </form>
    
    </div>


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
                    <h5><span style="font-size: 10px">RO</span> {{$product->price}}</h5>
                    @if ($product->cover != null)
                  
                    <img width="100%" src="{{env('IMAGE_PATH')}}{{ $product->cover}}">

                    @else
                    <img width="100%" src="{{asset('img/dummy_img.jpg')}}">
                    @endif

                    <h6>{{$product->name}}</h6>
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

        $('#itembox').css({ height: '20vh', overflow:'scroll' });
        $('#leftpanel').css({ height: '30vh' });
        $('#frm1').css({ height: '54vh' });
        $('#pay').css({ height: '54vh' });




				$('#delivery').empty();
        $('#delivery').append(`
        <input type="radio" required name="del" value="Take away" onClick="getPaymenttype(${member.value}); takeaway()"> <b class="lab1">Take away</b>
        <input type="radio" required name="del" value="Dining" onClick="getTables(${member.value})"> <b class="lab1">Dining</b>
        <input type="radio" required name="del" value="Delivery" onClick="ShowDelType(${member.value})"> <b class="lab1">Delivery</b>`);
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



    $('#dt').append(`<input type="radio"  required onClick="getPaymenttype(${memberid});hideloc()" name="dl" value="1"> <b class="lab1">Room Services</b>
                     <input type="radio" required name="dl" value="2" onClick="getDeliverylocations(${memberid})"> <b class="lab1">Locations</b>`);
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
                $('#pt').append(`<b class="lab2">Payment Type</b><input type="radio" onClick="getDelTime()" required name="pt" value="1"> <b class="lab1">Cash</b>`);
                 break;

              case 2:
                $('#pt').empty();
                $('#pt').append(`<b class="lab2">Payment Type</b><input type="radio" onClick="getDelTime()" required name="pt" value="2"> <b class="lab1">Card</b>`);
                 break;
             
               default:
                $('#pt').empty();
                $('#pt').append(`<b class="lab2">Payment Type</b><input type="radio" onClick="getDelTime()" required name="pt" value="1"> <b class="lab1">Cash</b>
                <input type="radio" onClick="getDelTime()" required name="pt" value="2"> <b class="lab1">Card</b>`);
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
                  <input class="form-check-input" type="radio" value="${item.id}" name="table" onClick="getPaymenttype(${memberid})" required id="flexRadioDefault2">
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
              $('#total').append('RO '+sum); 
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
          $('#locations').append(`<select onChange="getPaymenttype(${memberid})" class="form-control w-full border-gray-400" name="location" required><option>Select Locations</option>`)


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
    $('#dtime').append(`<b class="lab1">Delivery Time</b><input name="dtime" type="datetime-local" class="form-control w-full border-gray-400">`);

    //$("#ctime").val(new Date().toJSON().slice(0,19));

}
 

 

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.2.27/jquery.autocomplete.min.js"></script>

@endsection

