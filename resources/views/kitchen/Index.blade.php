 
<?php $branches = resolve('branches');?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>kitchen</title>
 
  <link rel="icon" id="favicon" href="{{asset('img/logo.png')}}" sizes="16x16">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Custom fonts for this template-->
 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"   />
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{asset('dashboard/css/sb-admin-2.min.css')}}" rel="stylesheet">

  <style>
#wrapper #content-wrapper {
    background-color: #e9eef7
    
}
    .topbar .nav-item .nav-link {
        height: 2.375rem;
      
        padding: 0 .75rem;
    }
    .topbar {
    height: 3.375rem;
}
.text-gray-600 {
    color: #242425!important;
    font-size: 15px;
}

footer.sticky-footer {
    padding: 1rem 0;
    flex-shrink: 0;
}
.card-header {
    padding: .55rem 1rem;}

.pc1 div b{
  font-weight: 500;
  color: #000;
  font-size: 13px;
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
</head>

<body id="page-top">
  <audio id="xyz" src="/s.mp3" preload="auto" allow="autoplay"></audio>

    <!-- Page Wrapper -->
    <div id="wrapper">
  
      
  
      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">
  
        <!-- Main Content -->
        <div id="content" style="min-height: 100vh">
  
          <!-- Topbar -->
          <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
  
            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
              <i class="fa fa-bars"></i>
            </button>
  
            
           


            <a href="/"> <img src="{{asset('img/cooking.png')}}" width="30" alt=""> </a>

            <h3 class="h4 mb-1 mt-1 text-gray-900" style="
    text-transform: uppercase;
    margin-left:10px;
    font-weight: 900;
    font-size: 22px;
    padding-top: 3px;
"> KITCHEN</h3>


<div class="form-group bpic">
  
  <select onchange="switchBranch()" id="branch_id" class="form-control w-full border-gray-400" name="branch_id">
      <option value="{{ Session::get('branch')->id}}" selected> {{ Session::get('branch')->name}}</option>
      @foreach ($branches as $item)
      <option value="{{$item->id}}">{{$item->full_name}}</option>
      @endforeach
  </select>
</div>


{{-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
  <div class="input-group">
    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
    <div class="input-group-append">
      <button class="btn btn-primary" type="button">
        <i class="fas fa-search fa-sm"></i>
      </button>
    </div>
  </div>
</form>  --}}
  
            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
  
              <!-- Nav Item - Search Dropdown (Visible Only XS) -->
              <li class="nav-item dropdown no-arrow d-sm-none">
                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-search fa-fw"></i>
                </a>

                
                <!-- Dropdown - Messages -->
                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                  <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                      <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                      <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                          <i class="fas fa-search fa-sm"></i>
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </li>


              {{-- <button onclick="getOrders()" class="btn btn-primary">Refresh</button>
              <div class="topbar-divider d-none d-sm-block"></div> --}}
  
              <!-- Nav Item - User Information -->

              

              <li class="nav-item">
                <a href="/">
                <i class="fas fa-bars" style="
                    font-size: 27px;
                    color: #555;
                    margin: 4px 15px 0 10px;
                "></i></a>
              </li>

                <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small"></span>
                  <i class="fas fa-user" style="
                    font-size: 22px;
                    color: #4e72df;
                "></i>
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                  <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                  </a>
                  {{-- <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                  </a> --}}
               
                  <div class="dropdown-divider"></div>
                   
                    
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> 
                      <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>{{ __('Logout') }} </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf </form>
                
                </div>
              </li>
  
            </ul>
  
          </nav>
          <!-- End of Topbar -->

          <style>
            
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
 
  padding: 8px; border: 1px solid #dee2e6 !important
}

/* #customers tr:nth-child(even){background-color: #e7e7e7;}

#customers tr:hover {background-color: #e7e7e7;} */

#customers th {
  padding-top: 7px;
  padding-bottom: 7px;
  text-align: left;
  background-color: #fff;
  color: black; font-weight: 400; font-size: 14px
}
#customers td {  background-color: #ebeef6;color: black; font-weight: 400; font-size: 14px}
.pc1 {
    margin: 0;
    font-size: 12px;
    color: #425eb5;
    font-weight: 600;
    width: 100%;
    line-height: 25px;
}
</style>
           
  
  <!-- Begin Page Content -->
  <div class="container-fluid">

    <div class="row" id="displayorders"></div>
    
  </div>
 
</div>
        <!-- End of Main Content -->
  
        <!-- Footer -->
        {{-- <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright &copy; 2021</span>
            </div>
          </div>
        </footer> --}}
        <!-- End of Footer -->
  
      </div>
      <!-- End of Content Wrapper -->
  
    </div>
    <!-- End of Page Wrapper -->
  
 

  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('dashboard/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('dashboard/js/jQuery.print.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset('dashboard/vendor/jquery-easing/jquery.easing.min.js')}}"></script>




  <script type="text/javascript">


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

    //display Images
    $(document).ready(() => {
        getOrders();
    });
    
    
    const getOrders = () => {
            $.ajax({
            type: 'GET',
            url: '/kitchen/getorders',
            success: function(res){
    
                
                if(res == 0){
    
                    $('#displayorders').empty();
                }
                else{
                    $('#displayorders').empty();
                    //const imgPath = '{{env('IMAGE_PATH')}}';
                    res.map(order => {

                //console.log(order)


                      if(order.delivery_type == "Dinein"){
                     
                        var loc = '(Table : ' + order.table.name + ' )';
                      }

                      if(order.delivery_type == "Delivery"){

                        if(order.location == null){

                          var loc = `Room No ${order.user.room_address}, ${order.user.location}`;
                        } else {
                          var loc = `(${order.location.name})`;
                        }
                      }

                      switch (order.delivery_type) {
                        case "Take away":
                          var loc = ''
                        default:
                          break;
                      }


                        $('#displayorders').append(`



                        
                        <div class="col-md-4">
    <div class="card shadow mb-4">
        <div class="card-header py-1">
            <div class="row">
                <div class="col-sm-7">
                    <h6 class="m-0 mt-2 font-weight-normal text-primary">Member ID : <b>${order.user.memberid}</b></h6>
                    <p class="pc1">Name: <span style="color:#000; font-weight:600">${order.user.name}</span></p>
                    
                </div>
                <div class="col-sm-5"> <button onClick="orderReady('${order.id}')" class="btn btn-success btn-sm right" style="float: right; margin-top:10px">ORDER READY</button> </div>
                
            </div>
          
        </div>
        <div class="card-body" style="padding: 15px; padding-top:5px" id="ele${order.id}">

          <div class="row flex-row py-2 m-0" >
           
              <div class="pc1 row"><div class="col-md-4">Order Time:</div> <div class="col-md-8"><b>${order.updated_at}</b></div></div>
              <div class="pc1 row"><div class="col-md-4">Delivery/ Pickup:</div> <div class="col-md-8"><b>${order.delivery_time}</b></div></div>
              <div class="pc1 row"><div class="col-md-4">Service Type:</div> <div class="col-md-8"><b>${order.delivery_type} ${loc}</b></div></div>
              <div class="pc1 row"><div class="col-md-4">Order Source:</div> <div class="col-md-8"><b>${order.req_by}</b></div></div>
              <div class="pc1 row"><div class="col-md-4">Special Note:</div> <div class="col-md-8"><b>${order.sn}</b></div></div>

 

              
              
            

             
              
            
          </div>
          <div class="row bg-primary py-2 mb-0" style="color: white; font-weight:400">
            <div class="col-sm-6">Order Token: <b>#${order.id}</b></div>
            <div class="col-sm-6" style="text-align: right"> </div>
          </div>

          <div class="row" style="margin-top: -4px!important">
          <table id="customers" style="width:100%;margin-top: -23px;">
                <tr>
                  <th>P.ID</th>
                  <th>Items</th>
                  <th width="30">Qty</th>
                 
                </tr>
                ${
                  order.products.map(product => {
                    return `<tr>
                    <td>${product.id}</td>
                    <td>${product.name}</td>
                    <td>${product.pivot.quantity}</td>
                  
                  </tr>`;
                  })
                }
              </table>
              
        </div>
      </div>
      </div>
</div>
                        
                      `)
                    })
                }
            }
        });
    };
    
    const orderReady = (order) => {
    
        var token = $("meta[name='csrf-token']").attr("content");
        $.ajax({
            type: 'PATCH',
            url: `/kitchen/orderready/${order}`,
            data: {
                "id": 'hgfd',
                "_token": token,
            },
            success: function(){
                getOrders();
            }
        });
    }
    
    //get subcat
    $('#category').change(function() {
        var category = this.value;
        if (this.value) {
            $.ajax({
                type: 'GET',
                url: "/getsubcategory/" + category,
                success: function(res) {
                    if (res.length == 0) {
                        
                        $('#subcat').empty();
                        $('#subcat').append('<option value="">No Sub category found</option>')
                    } else {
                        $('#subcat').empty();
                        res.map(subcat => {
                            //console.log(subcat);
                            
                            $('#subcat').append('<option value="' + subcat.id + '">' + subcat.name + '</option>')
                        })
                    }
                }
            })
        }
    });




    
    
    
    </script>


 
        <script type='text/javascript'>
        //<![CDATA[
        jQuery(function($) { 'use strict';
            $("#ele1").find('.print-link').on('click', function() {
                //Print ele2 with default options
                $.print("#ele2");
            });
            $("#ele2").find('button').on('click', function() {
                //Print ele4 with custom options
                $("#ele2").print({
                    //Use Global styles
                    globalStyles : false,
                    //Add link with attrbute media=print
                    mediaPrint : false,
                    //Custom stylesheet
                    stylesheet : "http://fonts.googleapis.com/css?family=Inconsolata",
                    //Print in a hidden iframe
                    iframe : false,
                    //Don't print this
                    noPrintSelector : ".avoid-this",
                    //Add this at top
                    prepend : "Hello World!!!<br/>",
                    //Add this on bottom
                    append : "<span><br/>Buh Bye!</span>",
                    //Log to console when printing is done via a deffered callback
                    deferred: $.Deferred().done(function() { console.log('Printing done', arguments); })
                });
            });
            // Fork https://github.com/sathvikp/jQuery.print for the full list of options
        });
        //]]>
        </script>





<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('bc1abadba15b9f19bac2', {
      cluster: 'ap2'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('App\\Events\\Checkout', function(data) {
      
      
        document.getElementById('xyz').play();
        getOrders();



      
    });
  </script>




  <!-- Custom scripts for all pages-->
  <script src="{{asset('dashboard/js/sb-admin-2.min.js')}}"></script>

</body>

</html>
