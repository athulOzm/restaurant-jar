<style>
  .table td, .table th {
    padding: 0px 10px 0px 10px!important;
    vertical-align: middle;
    font-size: 14px;
    color: #222; line-height: 26px
}
input[type=search]{
   -moz-appearance: none;/* older firefox */
   -webkit-appearance: none; /* safari, chrome, edge and ie mobile */
   appearance: none; /* rest */
}

#dataTable_filter input, #dataTable2_filter input, #dataTable3_filter input, #dataTable4_filter input {
    background: #fff;
    position: absolute;
    border: 2px solid #4e72df;
    padding: 10px 0;
    height: 40px;
    width: 95%;
}

#dataTable{color: #333}
.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #c1c1c1;
    line-height: 44px;
    background: #bbb;
    box-shadow: none;
}

.btn-info {
    color: #fff;
    background-color: #36b9cc;
    border-color: #36b9cc;
    padding: 2px 10px;
    font-size: 14px;
}
.table td, .table th{line-height: 37px!important}
#dataTable, #dataTable2, #dataTable3, #dataTable4{border:2px solid #bbb;}
#exTabsale2 ul li a{line-height: 40px}
.pagination li a{line-height: 15px!important}
</style>


<div id="exTabsale2"  style="color: #222">	
    <ul  class="nav nav-pills pill2">
      <li class="active">
        <a  href="#1aa" data-toggle="tab">ADMIN</a>
      </li>
      <li><a href="#2aa" data-toggle="tab">APPS</a>
      </li>
      <li><a href="#3aa" data-toggle="tab">TABLET</a></li>
  
        
    </ul>

    <div class="tab-content clearfix">
      <div class="tab-pane active" id="1aa">
        @include('pos.partials.Admin')
      </div>
      <div class="tab-pane" id="2aa">
        @include('pos.partials.Apps')
      </div>
      <div class="tab-pane" id="3aa">
        @include('pos.partials.Tablet')
      </div>
    
        
    </div>
   </div>