<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" id="favicon" href="{{asset('img/logo.png')}}" sizes="16x16">


  <title>@yield('head')</title>



  <!-- Custom fonts for this template-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"   />
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <link href="{{asset('dashboard/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{asset('dashboard/css/sb-admin-2.css')}}" rel="stylesheet">


  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">

  <script src="{{asset('dashboard/vendor/jquery/jquery.min.js')}}"></script>

<style>
      label {
    display: inline-block;
    margin-bottom: 0.5rem;
    font-weight: 700;
    font-size: 13px;
    color: #000!important;
}
 
</style>
</head>

<body id="page-top">

@if(Session('message'))
<div class="msgbox sucbox" > {{ Session('message') }} </div>
@endif
                  
           


  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex " href="{{ route('home')}}">
         RESTAURANT
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard 
      <li class="nav-item active">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Admin Dashboard</span></a>
      </li>-->

      <!-- Divider -->
      <hr class="sidebar-divider">

      


      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages1" aria-expanded="true" aria-controls="collapsePages33">
          <i class="fas fa-fw fa-folder"></i>
          <span>Menus</span>
        </a>
        <div id="collapsePages1" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
       
            <a class="collapse-item" href="{{route('product.index')}}">All Menus</a>
            <a class="collapse-item" href="{{route('product.create')}}">Add Menu</a>
            <a class="collapse-item" href="{{route('menutype.index')}}">Menu Types</a>
            <a class="collapse-item" href="{{route('addon.index')}}">Addon</a>

            <a class="collapse-item" href="{{route('category.index')}}">Categories</a>
       
    
          </div>
        </div>
      </li>

     

       

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages7" aria-expanded="true" aria-controls="collapsePages33">
          <i class="fas fa-fw fa-folder"></i>
          <span>Members</span>
        </a>
        <div id="collapsePages7" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
       
            <a class="collapse-item" href="{{route('member.index')}}">All Members</a>
            <a class="collapse-item" href="{{route('member.create')}}">Add New Member</a>
            <a class="collapse-item" href="{{route('member.rank.index')}}">Member Ranks</a>
    
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages15" aria-expanded="true" aria-controls="collapsePages33">
          <i class="fas fa-fw fa-folder"></i>
          <span>POS</span>
        </a>
        <div id="collapsePages15" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
       
            <a class="collapse-item" href="{{route('pos')}}">POS</a>
            <a class="collapse-item" href="{{route('order.all')}}">Orders History</a>
            <a class="collapse-item" href="{{route('pos.paymenttype.index')}}">Payment Type</a>
            <a class="collapse-item" href="{{route('pos.table.index')}}">Tables</a>
            <a class="collapse-item" href="{{route('pos.deliverylocation.index')}}">Delivery Locations</a>
    
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages16" aria-expanded="true" aria-controls="collapsePages33">
          <i class="fas fa-fw fa-folder"></i>
          <span>KITCHEN DISPLAY</span>
        </a>
        <div id="collapsePages16" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
       
            <a class="collapse-item" href="{{route('kitchen')}}">Kitchen Display</a>
    
          </div>
        </div>
      </li>


      {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages15" aria-expanded="true" aria-controls="collapsePages33">
          <i class="fas fa-fw fa-folder"></i>
          <span>KDS</span>
        </a>
        <div id="collapsePages15" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
       
            <a class="collapse-item" href="{{route('order.active')}}">Pending</a>
            <a class="collapse-item" href="{{route('order.delivered')}}">Delivered</a>
            


    
          </div>
        </div>
      </li>  --}}
   
 
      
      

  

      




  
    
    
   
 



 

 

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search  
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form> -->

          <div >
          {{-- <a href="/admin/product/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm " style="margin-right:20px"><i class="fas fa-fw fa-folder fa-sm text-white-50"></i> Create Deal</a>

<a href="/admin/agent/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm " style="float:right;margin-right:20px">
<i class="fas fa-fw fa-user fa-sm text-white-50"></i> Create Agent</a> --}}


          </div>

          

 

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

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">0</span>
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Alerts Center
                </h6>
          
                
              </div>
            </li>

            

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                <i class="fas fa-user"></i>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <!-- <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
              -->
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('Logout') }} </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf </form>
              
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <!-- <h1 class="h3 mb-0 text-gray-800">@yield('head')</h1>
             -->
          </div>

          <!-- Content Row -->
          <div class="row">

         

   
            <!-- <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Agents</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">000</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

        
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Stores</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">000</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->


            @yield('content')

     

          
          
          
          

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

   

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
 
  <!-- Core plugin JavaScript-->
  <script src="{{asset('dashboard/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{asset('dashboard/js/sb-admin-2.min.js')}}"></script>

  <!-- Page level plugins -->
  <script src="{{asset('dashboard/vendor/chart.js/Chart.min.js')}}"></script>

  <!-- Page level plugins -->
  <script src="{{asset('dashboard/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('dashboard/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>


<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.js"></script>
  <!-- Page level custom scripts -->
  <!-- <script src="{{asset('dashboard/js/demo/chart-area-demo.js')}}"></script>
  <script src="{{asset('dashboard/js/demo/chart-pie-demo.js')}}"></script> -->

  <!-- Page level custom scripts -->
  <script src="{{asset('dashboard/js/demo/datatables-demo.js')}}"></script>



 
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>

  <script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js" integrity="sha256-JklDYODbg0X+8sPiKkcFURb5z7RvlNMIaE3RA2z97vw=" crossorigin="anonymous"></script>

@yield('script')

<script>
function deleteCon($frm, $msg = "Are you sure?"){
    if(confirm($msg)) {
        event.preventDefault();
        document.getElementById($frm).submit();
    } 
}

setTimeout(() => {
  const elems = document.querySelectorAll('.msgbox');
  var index = 0, length = elems.length;
    for ( ; index < length; index++) {
        elems[index].style.transition = "opacity 0.5s linear 0s";
        elems[index].style.opacity = 0;
    }


}, 5000);

</script>
</body>

</html>

                
 
             


              