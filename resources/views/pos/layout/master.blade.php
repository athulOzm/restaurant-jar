<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>POS</title>
      <link rel="icon" id="favicon" href="{{asset('img/logo.png')}}" sizes="16x16">
      <meta name="csrf-token" content="{{ csrf_token() }}">
    
      <!-- Custom fonts for this template-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"   />
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,500,600,900" rel="stylesheet">
      <!-- Custom styles for this template-->
      <link href="{{asset('dashboard/css/sb-admin-2.min.css')}}" rel="stylesheet">
      
      <style>
          body{height: 100vh; background: #f4f5fa}
         #wrapper #content-wrapper {
         background-color: #f4f5fa; min-height: 100vh
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
    padding: .4rem 0 0.3rem;
    flex-shrink: 0;
    background: #fff;
    border-top: 1px solid #e7e7e7;
}

         .cart {
          font-family: Arial, Helvetica, sans-serif;
          border-collapse: collapse;
          width: 100%;
          }
          .cart td, .cart th {
          padding: 9px 8px
          }
          .cart tr:nth-child(even){background-color:#fafafa}
          .cart tr:hover {background-color: #efe7e7;}
          .cart th {
            padding: 15px 8px;
          text-align: left;
          background-color: #fff;
          color: black; font-weight: 600; font-size: 14px
          }
          .cart td {   color:#444; font-weight: 600; font-size: 12px}
          .pc1 {
          margin: 0;
          font-size: 14px;
          color: #484747;
          font-weight: 500;
          width: 100%;
          line-height: 22px;
          }


 

#exTab2 ul li{padding: 0px 2px 1px; 
font-weight: 700; 
font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji"}

.nav-tabs {
    border-bottom: 0px solid #e7e7e7;
 
    border-radius: 6px; background: #e5e9f1
}

#exTab2 ul li a {
    color: #696767;
    padding: 10px 20px;
    line-height: 25px;
    text-decoration: none;
    font-weight: 400;
}
#exTab2 ul li.active a {
    color: #000;
}

.tab-content>.active{border-left: 0px solid #e7e7e7; padding: 10px}

#exTab2 ul li {
     padding: 10px; border-radius: 3px; margin: 10px
  
    
}
#exTab2 ul li.active {
    background: #ffffff;box-shadow: 0 .10rem 0.45rem 0 rgba(58,59,69,.15)!important
  
    
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

.itembox{width: 170px; margin:5px;border: 1px solid #b9bdc3; cursor: pointer;
    border-top: none; overflow: hidden; font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji" }
.itembox h6{font-weight: 600;
    color: #000;
    text-align: center;
    
    line-height: 20px;
    padding: 6px 0px 0;
    font-size: 0.9rem; 
    font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji"}

    .itembox h5 {
    font-size: 15px;
    font-weight: 400;
    background: #00000091;
    padding: 3px 8px;
    color: #fff;
    margin: 0;
    position: absolute;
    border-bottom-right-radius: 6px;
}
.lab1 {
    font-size: 22px;
    color: #f4f5fa;
    font-weight: 200;
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
.item{line-height: 27px; margin: 15px 0; padding-right: 20px}
.item h3 {
    font-size: 15px;
    color: #e6ebf3;
}
.btn-circle.btn-sm, .btn-group-sm>.btn-circle.btn {
    font-size: 15px;
    margin: 0 2px;
    background: #363e54;
    border-radius: 4px;
}
.item .price {
    font-size: 15px;
    color: #bac2d6;
}
.item .qty {
    font-size: 14px;
    color: #abb6c7;
    background: #1b1f32;
    padding: 0px 10px;
    border-radius: 6px;
    
}
.item .ttl {
    font-size: 14px;
    color: #e6ebf3; font-weight: 600
}
.txtb {
    background: #475067;
    border: 0;
    border-radius: 3px;
    color: #a0b3d0;
}
.itembox img {
    width: 100%;
    height: 90px;
}
.btnc1 {
    height: auto;
    background: #e65776;
    border-color: #e65776;
    float: right;
    margin: 10px;
    padding: 8px 50px;
}
.p10{padding: 3px 10px}
#pt input{font-size: 22px}
.autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
	.autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
	.autocomplete-selected { background: #F0F0F0; }
	.autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
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
    padding: 15px 30px;
}
      </style>
   </head>
   <body id="page-top">
      <!-- Page Wrapper -->
      <div id="wrapper">
         <!-- Content Wrapper -->
         <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content" style="min-height: 95vh">
               <!-- Topbar -->
               @include('pos.layout.nav')
              
               <!-- Begin Page Content -->
               <div class="container-fluid" style="padding-left:0 ">
                

                    @yield('content')

                  
               </div>
               <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->





 
         </div>
         <!-- End of Content Wrapper -->
      </div>
      <!-- End of Page Wrapper -->
      <!-- Bootstrap core JavaScript-->
      <script src="{{asset('dashboard/vendor/jquery/jquery.min.js')}}"></script>

    

      {{-- <script src="{{asset('dashboard/js/jQuery.print.js')}}"></script> --}}
      {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script> --}}
      <!-- Core plugin JavaScript-->
      {{-- <script src="{{asset('dashboard/vendor/jquery-easing/jquery.easing.min.js')}}"></script> --}}
      @yield('script')
     
      <!-- Custom scripts for all pages-->
      {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> --}}
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    
      
   </body>
   
</html>