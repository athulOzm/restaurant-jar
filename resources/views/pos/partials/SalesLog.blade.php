<style>
  .table td, .table th {
    padding: 0px 5px 0px 5px!important;
    vertical-align: middle;
    font-size: 14px;
    color: #222;
}
input[type=search]{
   -moz-appearance: none;/* older firefox */
   -webkit-appearance: none; /* safari, chrome, edge and ie mobile */
   appearance: none; /* rest */
}

#dataTable_filter input, #dataTable2_filter input, #dataTable3_filter input {
    background: #fff;
    position: absolute;
    border: 2px solid #4e72df;
    padding: 10px 0;
    height: 40px;
    width: 90%;
}

#dataTable{color: #333}
</style>


<div id="exTabsale" >	
    <ul  class="nav nav-pills pill2">
      <li class="active">
        <a  href="#1a" data-toggle="tab">Sales Log</a>
      </li>
      <li><a href="#2a" data-toggle="tab">Hold Items</a>
      </li>
      <li><a href="#3a" data-toggle="tab">Open Tokens</a>
      </li>
        
    </ul>

    <div class="tab-content clearfix">
      <div class="tab-pane active" id="1a">
        @include('pos.partials.Sales')
      </div>
      <div class="tab-pane" id="2a">
        @include('pos.partials.Hold')
      </div>
      <div class="tab-pane" id="3a">
        @include('pos.partials.Open')
      </div>
        
    </div>
   </div>