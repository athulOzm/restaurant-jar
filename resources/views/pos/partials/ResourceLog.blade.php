<style>

 
 

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
      border-radius: 3px; padding: 0px 
}
#exTab2 ul li.active {
    background: #ffffff;box-shadow: 0 .10rem 0.45rem 0 rgba(58,59,69,.15)!important 
}

 
 
#exTabsale2 ul li a {
    padding: 10px 13px;
    line-height: 35px;
    text-decoration: none;
    font-weight: 400;
    font-size: 15px;
    color: #404040;
}
#exTabsale2 ul li.active a {
    color: #000;
}

.tab-content>.active{border-left: 0px solid #fff; padding: 10px}

#exTabsale2 ul li {
      border-radius: 0px; padding: 3px 
}
#exTabsale2 ul li.active {
    background: #ffffff;
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


/*  
#dataTable_filter input, #dataTable2_filter input, #dataTable3_filter input, #dataTable4_filter input {
    background: #fff;
    position: absolute;
    border: 2px solid #4e72df;
    padding: 10px 0;
    height: 40px;
    width: 95%;
} */

#dataTable{color: #333}
 



</style>


<div id="exTabsale2"  style="color: #222">	
    <ul  class="nav nav-pills pill2">
      <li class="active">
        <a  href="#4aa" data-toggle="tab">All Source</a>
      </li>

      <li>
        <a  href="#1aa" data-toggle="tab">ADMIN</a>
      </li>
      
      {{-- <li><a href="#2aa" data-toggle="tab">APPS</a>
      </li> --}}
      <li><a href="#3aa" data-toggle="tab">TABLET</a></li>
  
        
    </ul>

    <div class="tab-content clearfix">
      <div class="tab-pane active" id="4aa">
        @include('pos.partials.All')
      </div>
      <div class="tab-pane" id="1aa">
        @include('pos.partials.Admin')
      </div>
      {{-- <div class="tab-pane" id="2aa">
        @include('pos.partials.Apps')
      </div> --}}
      <div class="tab-pane" id="3aa">
        @include('pos.partials.Tablet')
      </div>
    
        
    </div>
   </div>