@extends('pos.layout.master')

<?php 
$menutypes = resolve('menutypesforpos');
$waiter = resolve('waiter');
$allmenus = resolve('allmenus');
$mcategories = resolve('mcategories');
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

<form action="{{route('pos.checkout')}}" method="POST">
  @csrf

 


<div class="row">

 



  <div class="col-sm-6 p0" style="background: #2c3346;">
    


      
 



      <div class="card  shadow-xs my-1" id="leftpanel" style="padding: 0 0px 0 20px">
        


        <div class="row" style="
    background: #1b1f32;
    margin-right: 2px;
    border-bottom: 1px solid #353e56; padding-bottom:5px
">

          <div class="col-md-6 my-2">
            <p class="lab1a" >Token ID: <b style="font-size: 18px; color:#e65776">{{ Session::get('token')->id}}</b></p>
          </div>

          <div class="col-md-6 my-2">
            <p class="lab1a">Date:  <b>{{Carbon\Carbon::now()->isoFormat('LLLL') }}</b></p>
          </div>
          
    
          <div class="col-md-6">
            <p class="lab1a">MISS ID</p>
            <input type="text" name="memberid" readonly required id="autocomplete2a" style="background: #1c1f32;
            border: 0;
            padding: 0;" class="form-control w-full txtb">
          </div>
    
          <div class="col-md-6">
            <p class="lab1a">Member Name</p>
            <input type="text" name="memberid_name" readonly style="background: #1c1f32;
            border: 0;
            padding: 0;" required id="autocomplete2" class="form-control w-full txtb">
          </div>

          

       

          <div class="col-md-6">
            
          </div>

          

        </div>




        <div id="itembox" class="scro" style="height:calc(100vh - 425px); margin-top:10px; overflow:hidden;  overflow-y: scroll;">
          <div class="cart"  style="width:99%" id="cart">
          </div>
        </div>
      </div>

    
      <div class="bgh tar" style="padding-bottom: 3px;padding-top: 15px;min-height:230px; ">
        <div class="row">
          {{-- <div class="col-md-7">
        
              <div class="bgh p0" style="text-align: left">
                <b class="lab1a">Special Note</b>
                <div class="flex">
                  <textarea class="form-control w-full txtb" name="sn" style="background: #424a63; color:#fff; height:80px; margin-bottom:6px"></textarea>
                </div>
              </div>
         
          </div> --}}

          <div class="col-md-12">
            <div class="row" style="font-size: 14px">
                <div class="col-sm-5">Sub Total:</div>
                <div class="col-sm-7" ><label id="st"  style="font-weight: 600;color:#fff"></label></div>
                <div class="col-sm-5">VAT:</div>
                <div class="col-sm-7" ><label id="vat"  style="font-weight: 600;">0.000</label></div>
                <div class="col-sm-5">Discount:</div>
                <div class="col-sm-7" ><label id="discount" style="font-weight: 600;">0.000</label></div>
            </div>
          </div>
 
        </div>
        
        <div class="row totalamd tar">
          <div class="col-sm-5"><b class="lab1"></b></div>
          <div class="col-sm-7" style="color:#e65776; line-height:20px; padding-left:25px"><label class="total" id="subtotal" style="font-weight: 600;font-size: 30px;"></label></div>
        </div>

        <div class="row">
          <div class="col-sm-5">
            <button class="btn btn-primary btnc2" type="button"  onclick='printDiv();'><i class="fas fa-print"></i> Print</button>
          </div>
          
          <div class="col-sm-4">
            <select required="" class="form-control mt-2" name="category_id" id="category_id">
              
                                              <option value="1">Cash</option>
                                              <option value="2">Credit</option>
              
                                      </select>
          </div>
          {{-- <div class="col-sm-2">
            <button class="btn btn-primary btnc2" style="
            background: #6e89e4;
            border: 1px solid #6e89e4;" onclick="actcancel({{ Session::get('token')->id}})" type="button" ><i class="fas fa-retweet"></i> Cancel</button>
          </div> --}}

          {{-- <div class="col-sm-3">
            <button class="btn btn-primary btnc2" style="
            background: #6c759c;
    border: 1px solid #424962;" id="salesreturn" type="button" ><i class="fas fa-retweet"></i> Sales Return</button>
          </div> --}}

          {{-- <div class="col-sm-3">
            <button class="btn btn-primary btnc2" style="
            background: #00BCD4;
    border: 1px solid #03A9F4;" onclick="showsettlement()" type="button" ><i class="fas fa-sign-out-alt"></i> Settlement</button>
          </div> --}}

          <div class="col-sm-3 pull-right right">
            <button class="btn btn-primary btnc1" id="pay" type="button" style="padding: 8px 0; width:100%">Refund <i class="fas fa-arrow-right"></i></button>
          </div>
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

      

      


    </div>



  <div class="col-sm-6 mt-4">
    <div class="card  shadow-xs mt-1" >

      
 





      <div id="exTab2">
        
        <ul class="nav nav-pills" id="pills-tab" role="tablist">
          <li class="nav-item" style="width: 40%">
            <input type="text" class="form-control orderser" id="sermenus" placeholder="Search Menu" style="margin: 7px 3px;
            width: 96%;
            font-size: 14px;
            padding: 20px 15px;">
          </li>

          <li class="nav-item">
            <a class="nav-link active" id="all" data-toggle="pill" href="#pall" role="tab" aria-controls="all" aria-selected="true">All Menu</a>
          </li>

          @foreach ($menutypes as $menutype)
          <?php $nub = 1; ?>
            <li class="nav-item">
              <a class="nav-link " id="{{$menutype->id}}" data-toggle="pill" href="#p{{$menutype->id}}" role="tab" aria-controls="{{$menutype->id}}" aria-selected="true">{{$menutype->name}}</a>
            </li>
            <?php 
            $nub = 2;
            ?>
          @endforeach
        </ul>


        <div class="tab-content scro2" style="min-height:calc(100vh - 130px);height:calc(100vh - 130px);overflow-y:scroll">


        <div class="tab-content" id="pills-tabContent">


















          <div class="tab-pane fade show active" id="pall" role="tabpanel" aria-labelledby="all">


            <div class="row">

              <div class="col-10 p0">
                <div class="tab-content" id="v-pills-tabContent">
                  
                  
                  <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <div style="display: flex;flex-wrap: wrap;">
                      @forelse ($allmenus as $product)
                        <div class="card itembox" onclick="addtocart({{$product->id}});" 
                        style="background: url('@if($product->cover != null){{env('IMAGE_PATH')}}{{ $product->cover}} @else {{asset('img/dummy_img.jpg')}}@endif');
                        min-height:110px;
            background-size: 100% 100%;">
                          <h5 ><span style="font-size: 10px">RO</span> {{$product->price}}</h5>
                          

                          <h6 class="itemtitle">{{$product->name}}</h6>
                        </div>
                      @empty
                        No menu found!
                      @endforelse
                    </div> 
                  </div>

                  @foreach ($mcategories as $cat)
                    <div class="tab-pane fade" id="v-pills-{{$cat->id}}" role="tabpanel" aria-labelledby="v-pills-profile-tab{{$cat->id}}">
                      <div style="display: flex;flex-wrap: wrap;">
                      @forelse ($cat->products as $product)
                        <div class="card itembox" onclick="addtocart({{$product->id}});" 
                        style="background: url('@if($product->cover != null){{env('IMAGE_PATH')}}{{ $product->cover}} @else {{asset('img/dummy_img.jpg')}}@endif');
                        min-height:110px;
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


              <div class="col-2 p0">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                  <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">All</a>

                  @foreach ($mcategories as $cat)
                  
                  <a class="nav-link" id="v-pills-profile-tab{{$cat->id}}" data-toggle="pill" href="#v-pills-{{$cat->id}}" role="tab" aria-controls="v-pills-profile" aria-selected="false">{{$cat->name}}</a>

                @endforeach

                
                </div>
              </div>
              
            </div>
          

          </div>


















          @foreach ($menutypes as $menutype)
            
            <div class="tab-pane fade" id="p{{$menutype->id}}" role="tabpanel" aria-labelledby="{{$menutype->id}}">


              <div class="row">

                <div class="col-10 p0">
                  <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                      
                      <div style="display: flex;flex-wrap: wrap;">
                        @forelse ($menutype->products as $product)
                          <div class="card itembox" onclick="addtocart({{$product->id}});" 
                          style="background: url('@if($product->cover != null){{env('IMAGE_PATH')}}{{ $product->cover}} @else {{asset('img/dummy_img.jpg')}}@endif');
                          min-height:110px;
              background-size: 100% 100%;">
                            <h5 ><span style="font-size: 10px">RO</span> {{$product->price}}</h5>
                            

                            <h6 class="itemtitle">{{$product->name}}</h6>
                          </div>
                        @empty
                          No menu found!
                        @endforelse
                      </div> 

                    </div>

                    @foreach ($menutype->categories() as $cat)

                      <div class="tab-pane fade" id="v-pills-{{$cat->id}}" role="tabpanel" aria-labelledby="v-pills-profile-tab{{$cat->id}}">
                        <div style="display: flex;flex-wrap: wrap;">
                        @forelse ($cat->productsbytype($menutype->id) as $product)
                          <div class="card itembox" onclick="addtocart({{$product->id}});" 
                          style="background: url('@if($product->cover != null){{env('IMAGE_PATH')}}{{ $product->cover}} @else {{asset('img/dummy_img.jpg')}}@endif');
                          min-height:110px;
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


                <div class="col-2 p0">
                  <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">All</a>

                    @foreach ($menutype->categories() as $cat)
                    
                    <a class="nav-link" id="v-pills-profile-tab{{$cat->id}}" data-toggle="pill" href="#v-pills-{{$cat->id}}" role="tab" aria-controls="v-pills-profile" aria-selected="false">{{$cat->name}}</a>

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



<div class="sales_return" style="max-height: 90vh; overflow-x:hidden; padding:0">

  <div class="row">
    <div class="bgh2 setle" style="background: #424962">Sales Return</div>
  </div>

  <div class="row" style="padding:30px">
    <form action="{{route('pos.refund.gettoken')}}" method="POST">
      @csrf()
      @method('POST')
      <p class="lab1a" style="color: #1b1f32">Token ID</p>
      <input required type="text" name="token_id" class="form-control w-full txt" id="">
      <button class="btn btn-primary btnc1" id="pay" type="submit" style="padding: 8px 0; width:100%; background:#6c759c; border:1px solid #424962">Go <i class="fas fa-arrow-right"></i></button>
    </form>
  </div>
</div>


@endsection




@section('script')

<script type="text/javascript">



function printDiv() 
{

  var divToPrint=document.getElementById('itembox');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);

}



$(document).ready(() => {

  //set time
  var dtimee = $('#dtimee').val();
  if(dtimee == ''){
    $('#dtimee').val('2021-05-29T00:00:00')
  }

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
    $(".backDrop, .box, .box2, .sales_return, .boxsett3").animate({"opacity": "0"}, 300, function(){
    $(".backDrop, .box, .box2, .sales_return, .boxsett3").css("display", "none");
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
          console.log(res);
          $('#settle_total').empty();
          $('#settle_total_cash').empty();
          $('#settle_total_credit').empty();
          //$('#settle_total_cashindrower').empty();

          $('#settle_total').append(res.st);
          $('#settle_total_cash').append(res.cash);
          $('#settle_total_credit').append(res.credit);
          //$('#settle_total_cashindrower').append(res.drawer);
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
          'value' : data[i].memberid +` - `+ data[i].phone +` - `+ data[i].name, 
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
        $('#totcrename').empty();
        $('#totcre').val(member.credit);
        $('#totcrename').append(member.name);
        var res2 = member.value.split(" - ");

        switch (member.pty) {
          case 1:
            var pty = 'Cash';
            break;

          case 2:
            var pty = 'Credit';
            break;
        
          default:
            var pty = 'Cash / Credit';
            break;
        }

        $('#autocomplete2').val(res2[2] + ` (${pty})`);

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
    
    var res = $('#autocomplete').val().split(" - ");

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
            <div class="box1a"><input type="radio" required name="del" value="Take away" onClick="getPaymenttype('${data}'); takeaway()"> <b class="lab1a">Take away</b></div>
            <div class="box1a"><input type="radio" required name="del" value="Dinein" onClick="getTables('${data}')"> <b class="lab1a">Dinein</b></div>
            <div class="box1a"><input type="radio" required name="del" value="Delivery" onClick="ShowDelType('${data}')"> <b class="lab1a">Delivery</b></div>
            </div>`);
          }
          else{

            $('#delivery').empty();
            $('#dt').empty();
            $('#tables').empty();
            $('#pt').empty();
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
            <div class="box1a"><input type="radio" required name="del" value="Take away" onClick="getPaymenttype('${res.id}'); takeaway()"> <b class="lab1a">Take away</b></div>
            <div class="box1a"><input type="radio" required name="del" value="Dinein" onClick="getTables('${res.id}')"> <b class="lab1a">Dinein</b></div>
            <div class="box1a"><input type="radio" required name="del" value="Delivery" onClick="ShowDelType('${res.id}')"> <b class="lab1a">Delivery</b></div>
            </div>`);
          }
          else{

            $('#delivery').empty();
            $('#dt').empty();
            $('#tables').empty();
            $('#pt').empty();
            $('#alert').empty();
            $('#alert').append(`<div class="alert flex">${res.msg}</div>`);
            $('#pay').prop('disabled', true);
            //alert(res.msg);
          }

        }
    });
  }

  const takeaway = () => {
    $('#tables').empty();
    //$('#dtime').empty();
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
    /////$('#dtime').empty();

    $('#dt').append(`<div class="bgh flex p0">
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
                $('#pt').append(`<div class="bgh p0 mt-2"><b class="lab1a">Payment Type</b>
                  <div class="flex"><div class="box3"><input type="radio" onClick="getDelTime()" required name="pt" value="1"> <b class="lab1a">Cash</b></div></div>
                </div>`);
                 break;

              case 2:
                $('#pt').empty();
                $('#pt').append(`<div class="bgh p0 mt-2"><b class="lab1a">Payment Type</b>
                  <div class="flex"><div class="box3"><input id="crepay" type="radio" onClick="getDelTime()" required name="pt" value="2"> <b class="lab1a">Credit</b></div></div></div>`);
                 break;
             
               default:
                $('#pt').empty();
                $('#pt').append(`<div class="bgh p0 mt-2"><b class="lab1a">Payment Type </b>
                  <div class="flex">
                  <div class="box3"><input type="radio" onClick="getDelTime()" required name="pt" value="1"> <b class="lab1a">Cash</b></div>
                  <div class="box3"><input type="radio" onClick="getDelTime()" id="crepay" required name="pt" value="2"> <b class="lab1a">Credit</b></div>
                  </div></div>`);
                 break;
             }

            }
        });
  }


const getTables = (memberid) => {

  $('#pt').empty();
  //$('#dtime').empty();
  $('#dt').empty();

  $.ajax({
      type: 'GET',
      url: `/pos/gettables`,
      success: function(res){
        $('#tables').empty();
        $('#locations').empty();

        $('#tables').append(`<div>
                    <div class="bgh p0 mt-2">
                      <b class="lab1a">Waiter</b>
                      <div class="flex">
                        <select required="" name="waiter" class="form-control mb-3" name="rank_id" id="rank_id" style="
    background: #2c3346;
    color: #fff;
    font-size: 13px;border:1px solid #2c3346
">
                            <option value="">Select Waiter</option>

                            @foreach ($waiter as $waiter)
                            <option value="{{$waiter->id}}">{{$waiter->name}}</option>
                            @endforeach

                
                                                    
                          </select>


                      </div>
                    </div>
                    
                  </div>
                  
                  <b class="lab1a">Tables</b>
                  `)



        $('#tables').append(`<div class="bgh flex p0" style="flex-wrap: wrap;" id="tdd">`)

        res.map(item => {
          if(item.status == 1){
          
            $('#tdd').append(`
              <div class="col-md-2" style="padding:2px;"  >

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
                <div class="col-md-2" style="padding:2px;">
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

              $('#cart').append(`<div class="row itemtitlebar" style="width:calc(100% + 12px)">
                <div class="col-sm-1 " style="padding-left:25px">N</div>
                <div class="col-sm-2 p0">Item</div>
                <div class="col-sm-2 ">Qty</div>
                <div class="col-sm-2 p0">U.Price</div>
                <div class="col-sm-1 ">VAT</div>
                <div class="col-sm-1 ">Dis</div>
                <div class="col-sm-2 ">Total</div>
                <div class="col-sm-1" style="font-size:9px">Addon</div>
              </div>
              `)

              var subt = [];
              console.log(res);

              $('#autocomplete2a').val(res.user.memberid);
              $('#autocomplete2').val(res.user.name);
              $('#subtotal').empty();
              $('#subtotal').append(res.refund_balance);

              
              res.orderproducts.map(item => {
 


              if(item.available_addons != ''){
                var btn = `<button type="button"  onclick="showaddon('${item.id}', '${item.product.id}')" value="${item.product.id}" style="background:#3f59ad;float:right;width: 50px;color: #fff;margin-right:15px; font-size:11px" class="btn btn-circle btn-sm">
                   Addon
                </button>`
              }
              else {
                var btn = ''
              }

                  $('#cart').append(
                    `<div class="item">
          <div class="row">
            <div class="col-sm-1 price " style="padding-left:25px">${item.id}</div>
            <div class="col-sm-2 price p0">${item.product.name} </div>
            <div class="col-sm-2 p0">

              <div style="display: flex">
                          
                          <button type="button" onclick="addtocart('${item.product.id}');" class="btn btn-circle btn-sm">
                            <i class="fas fa-plus btnc"></i>
                          </button>

                          <label class="qty">${item.quantity}</label>
          
                          <button  type="button" onclick="downcart('${item.product.id}');" class="btn  btn-circle btn-sm">
                            <i class="fas fa-minus btnc"></i>
                          </button>

                        </div>
            
            
            
            </div>
            <div class="col-sm-2 price p0">${item.product.price}</div>
            <div class="col-sm-1 ttl p0" >${item.tax}</div>
            <div class="col-sm-1 p0"><input value="${item.discount}" style="font-size:14px" onChange="adddiscount('${item.id}', '${item.product.id}');" id="itemd${item.product.id}" class="itemdis" type="text"></div>
            <div class="col-sm-2 ttl " >${item.sub_price}</div>
            
            <div class="col-sm-1 act p0">
              <div style="display: flex">
   
                ${btn}

                
                
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
          //$('#subtotal').empty();
          $('#discount').empty();
          //$('#subtotal2').val(null);

          $('#st').append(res.price);
          $('#vat').append(res.tax);
          //$('#subtotal').append(res.subtotal);
          //$('#subtotal2').val(res.subtotal);
          $('#discount').append(res.discount);
 
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

            
            // var res = $('#autocomplete').val().split(" - ");
            // if(res[0] != ''){
            //   cartcontinuebymid(res[0]);
            // }
            $('#crepay').prop('checked', false);
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
  
  //get subcat
const getDeliverylocations = (memberid) => {
  $('#pt').empty();
  
    $.ajax({
        type: 'GET',
        url: "/pos/locations",
        success: function(res) {
          //console.log(res);

          $('#locations').empty();
          $('#locations').append(`<div class="bgh2 mt-3"><b class="lab1a">Location</b>
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

//alert('asdf');

    //var avcre = $('#subtotal2').val();
    var ccre = $('#totcre').val();
    $('#vallimit').empty();

    if(avcre < ccre){

    
    } else{
      $('#crepay').prop('checked', false);
      $('#vallimit').append('Credit Limit Exced!');
    }
    //alert(avcre);
    // $('#dtime').append(`<div class="bgh2"><b class="lab1a">Delivery Time</b><input name="dtime" type="datetime-local" class="form-control border-gray-400 txtb"></div>`);

    // $("#ctime").val(new Date().toJSON().slice(0,19));

}
 

 

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.2.27/jquery.autocomplete.min.js"></script>

@endsection
