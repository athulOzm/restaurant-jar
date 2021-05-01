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
          body{height: 100vh; background: #ededed}
         #wrapper #content-wrapper {
         background-color: #ededed; min-height: 100vh
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
    border-bottom: 1px solid #e7e7e7;
    background: #f5f5f5;
}

#exTab2 ul li a{color: #444; padding: 20px 30px;
    line-height: 50px; text-decoration: none}
#exTab2 ul li.active a {
    color: #3f6cb1;
}

.tab-content>.active{border-left: 1px solid #e7e7e7; padding: 20px}


#exTab2 ul li.active {
    background: #ffffff;
    margin-bottom: -1px;
    border: 1px solid #e7e7e7;
    border-bottom: 1px solid #fff;
    border-top-right-radius: 6px;
    border-top-left-radius: 6px;
    padding: 0px 2px 1px;
    
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

.btnc{font-size: 15px; font-weight: bold; color: #3f6cb1;}

.itembox{width: 140px; margin:5px;border: 1px solid #b9bdc3; cursor: pointer;
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
    background: #3f6cb1;
    padding: 3px 8px;
    color: #fff;
    margin: 0;
}
.lab1{
    font-size: 14px;
    color: #444; font-weight: 600; width: 100%
}
.lab2{
    font-size: 14px;
    color: #444; font-weight: 600; width: 100%; display: block
}
.itembox img {
    width: 100%;
    height: 90px;
}
.btnc1{width: 100%;height: 24vh;border-top-left-radius: 0;border-bottom-left-radius: 0;background: #3f6cb1;}
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
      </style>
   </head>
   <body id="page-top">
      <!-- Page Wrapper -->
      <div id="wrapper">
         <!-- Content Wrapper -->
         <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content" style="min-height: 93vh">
               <!-- Topbar -->
               @include('pos.layout.nav')
              
               <!-- Begin Page Content -->
               <div class="container-fluid">
                

                    @yield('content')

                  
               </div>
               <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->








            <!-- Footer -->
            @include('pos.layout.footer')
            <!-- End of Footer -->
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