<nav class="navbar navbar-expand navbar-light bg-white topbar shadow static-top">
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

       <div id="alert"></div>
 
    <ul class="navbar-nav ml-auto">
       <!-- Nav Item - Search Dropdown (Visible Only XS) -->
       <li class="nav-item dropdown no-arrow ">
          
          
       </li>
       <div class="topbar-divider d-none d-sm-block"></div>
       <!-- Nav Item - User Information -->
       @if (auth()->user()->type == 1)
       <a class="nav-link  " href="/"  role="button"   aria-expanded="false">
         <span class="mr-2 d-none d-lg-inline text-gray-600 small">Dashboard</span>
         </a>
       @endif
       

       <li class="nav-item dropdown no-arrow">
          <a class="nav-link  " href="#"  onclick="document.getElementById('logout-form').submit();" role="button"  aria-expanded="false">
          <span class="mr-2 d-none d-lg-inline text-gray-600 small">Logout</span>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf </form>
       </li>
    </ul>
 </nav>
 <!-- End of Topbar -->