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
      <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;700&display=swap" rel="stylesheet">
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
.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    
    background-color: #e65776;color: #fff!important;
}
.nav-pills .nav-link {
    border-radius: 3px;
    font-size: 13px;color: #1b1f32
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

.nav-pills{
    border-bottom: 0px solid #e7e7e7;
 
    border-radius: 6px; background: #e5e9f1
}

#exTab2 ul li a {
    color: #1b1f32;
    padding: 10px 13px;
    line-height: 35px;
    text-decoration: none;
    font-weight: 400;color: #1b1f32
}
#exTab2 ul li.active a {
    color: #000;
}

.tab-content>.active{border-left: 0px solid #e7e7e7; padding: 10px}

#exTab2 ul li {
      border-radius: 3px; padding: 3px
  
    
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

.itembox{width: 120px; margin:5px;border: 1px solid #b9bdc3; cursor: pointer;
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
    background: #4e72df;
    padding: 3px 8px;
    color: #fff;
    margin: 0;
    position: absolute;
    border-bottom-right-radius: 6px;
}
.smtxt {
    width: 25px;
    background: transparent;
    border: 0;
    text-align: center;
    color: white;
}
.itembox h4 {
    font-size: 13px;
    font-weight: 400;
    background: #e65776;
    padding: 3px 8px;
    color: #fff;
    margin: 0;
    position: absolute;
    border-bottom-left-radius: 6px;
    right: 0;
    line-height: 18px;
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
/* .box3 {
    padding: 7px 20px;
    background: #2c3346;
    margin-right: 20px; margin-top: 4px
} */

.box3 {
    padding: 3px 0px;
    background: #2c3346;
    margin-right: 5px;
    margin-top: 2px;
    width: 100%;
    border-radius: 3px; cursor: pointer; margin-bottom: 0
}
.box3 input {opacity: .5; margin-left: 15px}
.box1 input[type=radio]{ margin-right: 10px}

.flex{display: flex}
.lab1 {
    font-size: 20px;
    color: #f4f5fa;
    font-weight: 200; 
}
.lab1a {
    font-size: 12px;
    color: #acb5ca;
    font-weight: 600;
    display: inline-block;
    margin-left: 0;
    margin-bottom: 1px;
}

.lab1b {
    font-size: 12px;
    color:#758098;
    font-weight: 400;
    display: inline-block;
    margin-left: 0;
    margin-bottom: 1px;
}
 
.lab1a b{
    font-size: 14px;
    color: #7c8498;
    font-weight: 500!important; display: inline-block
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
    font-size: 15px;
    color: #abb6c7;
    background: #1b1f32;
    padding: 0px 10px;
    border-radius: 6px;
    line-height: 28px;
    margin: 0 3px;
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
    background: #424962;
    border: 0;
    border-radius: 3px;
    color:#e65776; font-size: 14px; height: 31px;
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
    padding: 8px 20px;font-size: 14px
    
}
.btnc2 {
    height: auto;
    background: #b6bece;
    border-color: #b6bece;
    margin: 10px 0;
    padding: 8px 0px;
    color: #1b1f32;
    width: 100%;font-size: 14px
}
.tar{text-align: right}
.p10{padding: 3px 10px}
#pt input{font-size: 22px}
.autocomplete-suggestions {
    border-bottom: 1px solid #999;
    background: #fff;
    overflow: auto;
    color: #111;
    font-size: 14px;
}
	.autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
	.autocomplete-selected { background: #F0F0F0; }
	.autocomplete-suggestions strong { font-weight: normal; color: #e65776; }
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

.bgh2a {
    background: #2c3346;
    padding: 5px 10px;
}
.oc {
    font-size: 24px;
    color: #fff;
    border: 1px solid #475066;
    padding: 3px 10px;
    width: 100%;
    background: #475066;
    border-radius: 3px;
    line-height: 27px;
}
.oc2 {
    font-size: 14px;
    color: #fff;
    border: 1px solid #475066;
    padding: 3px 10px;
    width: 100%;
    background: #475066;
    border-radius: 3px;
    line-height: 27px;
}
.box1a {
    padding: 9px 0px 0px;
    background: #1b1f32;
    
    margin-top: 30px;
    border-radius: 3px;
    text-align: center;
    display: flex;
    align-items: center; margin-right: 10px; line-height: 13px
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
  width: 1px;
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
.sales_return{
 border:1px solid #424962;
  padding: 20px;
  display: none;
   
  left: 50%;
  margin-left: -170px;
  opacity: 0;
  position: fixed;
  top: 50%;
  z-index: 51; width: 350px; margin-top: -150px;
  
  -moz-border-radius: 2px;
  -webkit-border-radius: 2px;
  border-radius: 2px; background: #fff; overflow-y: scroll; padding-bottom: 20px
}

.boxsett3{
 border: 1px solid #656f9e;
  padding: 0;
  display: none;
   
  left: 50%;
  margin-left: -260px;
  opacity: 0;
  position: fixed;
  top: 4%;
  z-index: 51; width: 500px;
  
  -moz-border-radius: 2px;
  -webkit-border-radius: 2px;
  border-radius: 2px; background: #fff; padding-bottom: 0px;overflow-y: scroll;padding: 0px;
}
.setle {
    width: 100%;
    text-align: center;
    color: #fff;
    text-transform: uppercase;
}

.sitem {
    background: #fff;
    padding: 10px;
    color: #333;
    border-bottom: 1px solid #e7e7e7;font-size: 13px
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
    background: #f8f9fc;
    border-radius: 6px;
    margin: 6px;
    margin-top: 90px;
    color: black!important;
    font-size: 12px!important;
}

.clear{
  clear: both;
}
.cf{padding-left:0; padding-right:15px; height:calc(100vh - 0px)}
.totalamd{border-top:1px solid #2c3346;padding: 15px 0px 10px 0;border-bottom: 1px solid #2c3346;}
.itemtitlebar {
    color: #4e72df;
    font-size: 12px;
    text-align: left;
    font-weight: 400;
    background: #1a1f32;
    padding: 5px 0;
    border-top: 1px solid #363e54;
}

.btn-circle.btn-sm, .btn-group-sm>.btn-circle.btn {
   
    width: 1.4rem;
   
}
.alert {
    padding: 8px 20px;margin: 0;
    margin-left: 30px;
    border-radius: 6px;
    color: #fff;
    font-size: 14px;
    background: #e65776;
    border: 1px solid #bd1a3d;
}
/* .orderser {
    width: 100%;
    border: 1px solid #9ba5b7;
    border-radius: 3px;
    font-weight: 300;
    color: #000;
    font-size: 14px;
    background: #ffffff;
    margin: 10px 0;
} */
      </style>
   </head>
   <body id="page-top">
      <!-- Page Wrapper -->
      <div id="wrapper">
         <!-- Content Wrapper -->
         <div id="content-wrapper" class="d-flex flex-column scro3">
            <!-- Main Content -->
            <div id="content">
               
              
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
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
      <!-- Core plugin JavaScript-->
      {{-- <script src="{{asset('dashboard/vendor/jquery-easing/jquery.easing.min.js')}}"></script> --}}
      @yield('script')
     
      <!-- Custom scripts for all pages-->
      {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> --}}
      {{-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> --}}

    
      
   </body>
   
</html>