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
          body{flex:1; background: #f4f5fa; overflow: hidden;}
       
         .topbar .nav-item .nav-link {
         height: 2.375rem;
         padding: 0 .75rem;
         }
         .topbar {
         height: 50px;
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

.itembox{width: 140px; margin:5px;border: 1px solid #b9bdc3; cursor: pointer;
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
    background: #ee6280;
    padding: 3px 8px;
    color: #fff;
    margin: 0;
    position: absolute;
    border-bottom-right-radius: 6px;
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
.box3 {
    padding: 7px 20px;
    background: #2c3346;
    margin-right: 20px; margin-top: 4px
}
.box1 input[type=radio]{ margin-right: 10px}

.flex{display: flex}
.lab1 {
    font-size: 20px;
    color: #f4f5fa;
    font-weight: 200; 
}
.lab1a {
    font-size: 16px;
    color: #f4f5fa;
    font-weight: 600; line
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
    line-height: 25px;
    margin: 0px 0;
    padding-right: 15px;
    padding: 8px 0 ;
    border: 1px solid #343c52; border-top: none; background: #2a3042
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
    color: #bac2d6;
}
.item .qty {
    font-size: 13px;
    color: #abb6c7;
    background: #1b1f32;
    padding: 0px 10px;
    border-radius: 6px;
    
}
.itemdis {
    max-width: 100%;
    margin-right: 5px;
    background: #8790a5;
    border: none;
    border-radius: 3px;
    height: 26px;
}
.item .ttl {
    font-size: 13px;
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
    margin: 10px 0;
    padding: 8px 40px;
    
}
.btnc2 {
    height: auto;
    background: #b6bece;
    border-color: #b6bece;
    margin: 10px 0;
    padding: 8px 30px;color: #333
    
}
.tar{text-align: right}
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

.bgh2 {
    background: #2c3346;
    padding: 15px 30px;
}

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
  width: 10px;
  background-color: #2c3346;
}

.scro::-webkit-scrollbar-thumb
{
  background-color: #000000;
  border: 0px solid #555555;
}



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

.box{
 border: 2px solid #e7e7e7;
  
  display: none;
  min-height: 400px;
  left: 50%;
  margin-left: -400px;
  opacity: 0;
  position: fixed;
  top: 4%;
  z-index: 51; width: 800px;
  
  -moz-border-radius: 2px;
  -webkit-border-radius: 2px;
  border-radius: 2px; background: #1a1f32; padding-bottom: 20px;overflow-y: scroll;
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
    background: #000000ba;
    border-radius: 6px;
    margin: 10px;
    margin-top: 110px;
    color: white!important;
    font-size: 12px!important;
}

.clear{
  clear: both;
}
.cf{padding-left:0; padding-right:15px; height:calc(100vh - 40px)}
.totalamd{border-top:1px solid #2c3346;padding: 15px 0px 10px 0;border-bottom: 1px solid #2c3346;}
.itemtitlebar {
    color: #e65776;
    font-size: 12px;
    text-align: left;
    font-weight: 600;
    background: #1a1f32;
    padding: 5px 0;
    border-top: 1px solid #363e54;
}
      </style>
   </head>
   <body id="page-top">
      <!-- Page Wrapper -->
      <div id="wrapper">
         <!-- Content Wrapper -->
         <div id="content-wrapper" class="d-flex flex-column scro3">
            <!-- Main Content -->
            <div id="content">
               <!-- Topbar -->
               @include('pos.layout.nav')
              
               <!-- Begin Page Content -->
               <div class="container-fluid cf">
                

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