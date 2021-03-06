<?php 
$branches = resolve('branches');
?>
@extends('admin.layouts.master')


@section('head', 'Dashboard')

@section('content')


 

 <style>
.txtb{min-width: 100%; width: auto}
 </style>
   



   @if (auth()->user()->type == 1)
   <div class="form-group bpic" style="width: 400px; float: right; margin-left:15px">
     
     <select onchange="switchBranch()" id="branch_id" class="form-control w-full border-gray-400" name="branch_id">
          
         @foreach ($branches as $item)


         <option value="{{$item->id}}" @if(Session::get('branch')->id == $item->id) selected @endif>{{$item->name}}</option>
         @endforeach
     </select>
   </div>
   @endif

<div class="container">

    



   <div class="col-md-12">



    <div class="row" style="background: #fff; padding:20px">
        <h5 style="width: 100%;  " > Todays Sales </h5>
        <h5 style="width: 100%; font-size:13px; border-bottom:20px; color:#111" >
            
            <span style="color: #888; font-size:15px">Total Sale <b style="color: blue">RO {{$daytot}}</b>  </span> </h5>
    </div>
    
    
        <div class="row" style="background: #fff; padding:20px; border-radius: 3px">
            
        

            <div class="col-md-8">
                <div class="card mb-12" style="width:100%">
                    <div class="card-header py-3">Top Sale Items</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dtable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                    <th width="30">Item</th>
                                    <th width="30">Sold Qty</th>
                                    <th width="30">Sold Amount</th>
                                    {{-- <th width="30">In Stock</th> --}}
                                    </tr>
                                </thead>
        
                                <tbody>
                                @foreach($topitem as $item)
                                    <tr>
                                        <th width="30">{{$item->product->name}}<p style="float: right; margin-bottom:0">{{$item->product->name_ar}}</p></th>
                                        <th width="30">{{$item->quantity_sum}}</th>
                                        <th width="30">{{$item->price_sum}}</th>
                                      
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

          
            </div>

          
        
            <div class="col-md-4">
                {{-- <h5 style="width: 100%">Source</h5> --}}
    
                <canvas id="cer1a" style="width: 600px"></canvas>

                <div class="card" style="width:100%">
                    
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dtable" width="100%" cellspacing="0">
                               
        
                                <tbody>
                               
                                    <tr>
                                        <th width="30">Take Away</th>
                                        <th width="30">{{$ta0}}</th>
                                    </tr>
                                    <tr>
                                        <th width="30">Dinein</th>
                                        <th width="30">{{$di0}}</th>
                                    </tr>
                                    <tr>
                                        <th width="30">Delivery</th>
                                        <th width="30">{{$de0}}</th>
                                    </tr>
                          
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <br> <br>






    
<div class="row" style="background: #fff; padding:20px">
    <h5 style="width: 100%;  " > Last 30 Days Sales </h5>
    <h5 style="width: 100%; font-size:13px; border-bottom:20px; color:#111" >
        
        <span style="color: #888; font-size:15px">Total Sale <b style="color: blue">RO {{$tot}}</b>  </span> </h5>
</div>


    <div class="row" style="background: #fff; padding:20px; border-radius: 3px">
        
        <div class="col-md-8">
            <canvas id="barChartmonth" style="width: 100%"></canvas>
        </div>
    
        <div class="col-md-4">
            {{-- <h5 style="width: 100%">Source</h5> --}}

            <canvas id="cer1" style="width: 600px"></canvas>
        </div>
    </div>

    <br> <br>











    <div class="row" style="background: #fff; padding:20px">
        <h5 style="width: 100%">Sales Current Financial Year</h5>
    
        <h5 style="width: 100%; font-size:13px; border-bottom:20px; color:#111" >
            
            <span style="color: #888; font-size:15px">Total Sale <b style="color: blue">RO {{$tot2}}</b> </span> </h5>
    </div>
    <div class="row" style="background: #fff; padding:20px; border-radius: 3px">
        
        <div class="col-md-8">
            <canvas id="barChart" style="width: 100%"></canvas>
        </div>
    
        <div class="col-md-4">
            {{-- <h5 style="width: 100%">Source</h5> --}}
            <canvas id="cer2" style="width: 600px"></canvas>
        </div>
    </div>

    <br> <br> 

</div>
  </div>
 



{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.0/chart.min.js"></script> --}}
<script src="{{asset('dashboard/vendor/chart.js/Chart.min.js')}}"></script>


<script>
var DEFAULT_DATASET_SIZE = 3,
    addedCount = 0,
    color = Chart.helpers.color;

var chartColors = {
    red: 'rgb(255, 99, 132)',
    orange: 'rgb(255, 159, 64)',
    yellow: 'rgb(255, 205, 86)',
    green: 'rgb(75, 192, 192)',
    blue: 'rgb(54, 162, 235)',
    purple: 'rgb(153, 102, 255)',
    grey: 'rgb(231,233,237)'
};

function randomScalingFactor() {
    return Math.round(Math.random() * 960);
}

//var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

var barData = {
    labels: @json($month),
    datasets: [{
        label: 'Total Order',
        backgroundColor: color(chartColors.red).alpha(0.5).rgbString(),
        borderColor: chartColors.red,
        borderWidth: 1,
        data: @json($month_order)
    }, {
        label: 'Total Amount',
        backgroundColor: color(chartColors.blue).alpha(0.5).rgbString(),
        borderColor: chartColors.blue,
        borderWidth: 1,
        data: @json($days_total2)
    }]
};

var index = 11;
var ctx = document.getElementById("barChart").getContext("2d");
var	myNewChartB = new Chart(ctx, {
    type: 'bar',
    data: barData,
    options: {
        responsive: false,
        maintainAspectRation: false,
        legend: {
            position: 'top',
        },
        title: {
            display: true,
            text: 'Bar Chart'
        },
        
    }
});


 
var barData2 = {
    labels: @json($days),
    datasets: [{
        label: 'Total Orders',
        backgroundColor: color(chartColors.red).alpha(0.5).rgbString(),
        borderColor: chartColors.red,
        borderWidth: 1,
        data: @json($days_order)
    }, {
        label: 'Total Amount',
        backgroundColor: color(chartColors.blue).alpha(0.5).rgbString(),
        borderColor: chartColors.blue,
        borderWidth: 1,
        data: @json($days_total)
    }]
};

var index = 11;
var ctx = document.getElementById("barChartmonth").getContext("2d");
var	myNewChartB = new Chart(ctx, {
    type: 'bar',
    data: barData2,
    options: {
        responsive: true,
        maintainAspectRation: true,
        legend: {
            position: 'top',
        },
        title: {
            display: true,
            text: 'Bar Chart'
        },
        
    }
});








const data0 = {
  labels: [
    'Take Away',
    'Dinein',
    'Delivery'
  ],
  datasets: [{
    label: 'My First Dataset',
    data: [{{$ta0}}, {{$di0}}, {{$de0}}],
    backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(75, 192, 192)',
      'rgb(255, 205, 86)',
      'rgb(201, 203, 207)',
      'rgb(54, 162, 235)'
    ]
  }]
};


const data = {
  labels: [
    'Take Away',
    'Dinein',
    'Delivery'
  ],
  datasets: [{
    label: 'My First Dataset',
    data: [{{$ta1}}, {{$di1}}, {{$de1}}],
    backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(75, 192, 192)',
      'rgb(255, 205, 86)',
      'rgb(201, 203, 207)',
      'rgb(54, 162, 235)'
    ]
  }]
};

const data2 = {
  labels: [
    'Take Away',
    'Dinein',
    'Delivery'
  ],
  datasets: [{
    label: 'My First Dataset',
    data: [{{$ta2}}, {{$di2}}, {{$de2}}],
    backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(75, 192, 192)',
      'rgb(255, 205, 86)',
      'rgb(201, 203, 207)',
      'rgb(54, 162, 235)'
    ]
  }]
};

var index = 11;
var ctx = document.getElementById("cer1a").getContext("2d");
var	myNewChartB = new Chart(ctx, {
    type: 'polarArea',
  data: data0,
  options: {}
});

var index = 11;
var ctx = document.getElementById("cer1").getContext("2d");
var	myNewChartB = new Chart(ctx, {
    type: 'polarArea',
  data: data,
  options: {}
});

 
var index = 11;
var ctx = document.getElementById("cer2").getContext("2d");
var	myNewChartB = new Chart(ctx, {
    type: 'polarArea',
  data: data2,
  options: {}
});


 //swich branch
 const switchBranch = () => {

var token = $("meta[name='csrf-token']").attr("content");
$.ajax({
    type: 'POST',
    url: `/switchbranch`,
    data: {
        "branch_id": $('#branch_id').val(),
        "_token": token,
    },
    success: function(res){
    location.reload();  
    }
});
}


</script>

 
 


@endsection




