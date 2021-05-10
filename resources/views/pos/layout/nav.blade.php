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