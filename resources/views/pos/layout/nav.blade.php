<nav class="navbar navbar-expand navbar-light bg-white topbar shadow static-top">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
    </button>

    @if (auth()->user()->type == 1)
    <a href="/"> <img src="{{asset('img/marsa.png')}}" width="30" alt=""> </a>

@endif
 
    <h3 class="h4 mb-1 mt-1 text-gray-900" style="
       text-transform: uppercase;
       margin-left:10px;
       font-weight: 900;
       font-size: 22px;
       padding-top: 3px;
       "> POS</h3>

 
@if (auth()->user()->type == 1)
<div class="form-group bpic" style="width: 400px; float: right; margin-left:15px">
     
  <select onchange="switchBranch()" id="branch_id" class="form-control w-full border-gray-400" name="branch_id">
       
      @foreach ($branches as $item)


      <option value="{{$item->id}}" @if(Session::get('branch')->id == $item->id) selected @endif>{{$item->name}}</option>
      @endforeach
  </select>
</div>
@endif

  
 

       <div id="alert"></div>

       
 
    <ul class="navbar-nav ml-auto">
       <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        

       


       

      <div class="p5">
        <button class="nav-link btn btn-primary btnc2 btnn1"    id="salesreturn" type="button" > <span class="mr-2 d-none d-lg-inline">Sales Return</span></button>
      </div>

{{-- 
       <div class="topbar-divider d-none d-sm-block"></div> --}}
       <!-- Nav Item - User Information -->
      

        

       <button class="nav-link btn btn-primary btnc2 btnn1"   id="pay"  role="button"   aria-expanded="false">
         <span class="mr-2 d-none d-lg-inline">Sales Log</span>
       </button>

      

       <div class=" p5">
        <button class="nav-link btn btn-primary btnc2 btnn1"   onclick="showsettlement()" type="button" ><i class="fas fa-sign-out-alt"></i>  <span class="mr-2 d-none d-lg-inline">Settlement</span></button>
      </div>
       
     

       
    
       
      @if (auth()->user()->type == 1)
 
       <li class="nav-item">
         <a href="/">
         <i class="fas fa-bars" style="
             font-size: 27px;
             color: #555;
             margin: 4px 15px 0 10px;
         "></i></a>
       </li>

       @endif

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





