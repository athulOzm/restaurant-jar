<x-Layoutpos>
    
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
          font-size: 14px;
          color: #484747;
          font-weight: 500;
          width: 100%;
          line-height: 22px;
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
               <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                  <!-- Sidebar Toggle (Topbar) -->
                  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                  <i class="fa fa-bars"></i>
                  </button>
                  <img src="{{asset('img/cooking.png')}}" width="30" alt=""> 
                  <h3 class="h4 mb-1 mt-1 text-gray-900" style="
                     text-transform: uppercase;
                     margin-left:10px;
                     font-weight: 900;
                     font-size: 22px;
                     padding-top: 3px;
                     "> POS</h3>
               
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
                     <div class="topbar-divider d-none d-sm-block"></div>
                     <!-- Nav Item - User Information -->
                     <a class="nav-link  " href="/"  role="button"   aria-expanded="false">
                     <span class="mr-2 d-none d-lg-inline text-gray-600 small">Dashboard</span>
                     </a>
                     <li class="nav-item dropdown no-arrow">
                        <a class="nav-link  " href="/logout" role="button"  aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">Logout</span>
                        </a>
                     </li>
                  </ul>
               </nav>
               <!-- End of Topbar -->
              
               <!-- Begin Page Content -->
               <div class="container-fluid">
                  <div class="row" id="displayorders">

                    {{$slot}}

                  </div>
               </div>
               <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->








            <!-- Footer -->
            <footer class="sticky-footer bg-white">
               <div class="container my-auto">
                  <div class="copyright text-center my-auto">
                     <span>Copyright &copy; 2021</span>
                  </div>
               </div>
            </footer>
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
      <script type="text/javascript">
         //display Images
         $(document).ready(() => {
            // getOrders();
         });
         
         
         const getOrders = () => {
                 $.ajax({
                 type: 'GET',
                 url: '/kitchen/getorders',
                 success: function(res){
         
                     console.log(res)
                     
                     if(res == 0){
         
                         $('#displayorders').empty();
                     }
                     else{
                         $('#displayorders').empty();
                         //const imgPath = '{{env('IMAGE_PATH')}}';
                         res.map(order => {
                             $('#displayorders').append()
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
     
      <!-- Custom scripts for all pages-->
      {{-- <script src="{{asset('dashboard/js/sb-admin-2.min.js')}}"></script> --}}
   </body>
</html> </x-Layoutpos>