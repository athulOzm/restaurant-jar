@extends('admin.layouts.master')


@section('head', 'Dashboard')

@section('content')


 

 <style>
.txtb{min-width: 100%; width: auto}
 </style>
   

<div class="container">
   
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h2 class="h5 mb-0" style="font-weight: 700">SEARCH RESULT FOR Settlement</h2>
        
      </div>

    <form action="{{route('report.settlement.search')}}" method="POST">
        @csrf()
        @method('POST')
    <div class="row mb-3">
        
        <div class="col-md-3">
            <input name="df"  step="any" required  type="datetime-local" class="form-control border-gray-400 txtb">
        </div>
        <div class="col-md-3">
            <input name="dt"  step="any" required type="datetime-local" class="form-control border-gray-400 txtb">
        </div>
        <div class="col-md-4">
            <button class="btn btn-primary btnc1" id="pay" type="submit">View Report <i class="fas fa-arrow-right"></i></button>
        </div>
   
    </div>
</form>
    <br> 
    
    <div class="row">
        <div class="col-md-12"><h5 style="width: 100%; font-size:13px; border-bottom:20px; color:#111" >
            Search result from <u>{{$date_from}}</u> to <u>{{$date_from}}</u> <br><br> 
            <span style="color: #888; font-size:20px"> Total Settlement <b style="color: blue">RO {{$tot}}</b> & 
                <b style="color: blue">{{$tord}}</b> Token used </span> </h5></div>
    </div>



    <div class="row" style="background: #fff; padding:20px; border-radius: 3px">
        <div class="col-md-12 mt-5">
            <canvas id="barChartmonth" style="width: 100%"></canvas>
        </div>
    </div>
    

    <div class="row" >
        <div class="col-md-4 mt-5" style="background: #fff;style="padding-bottom: 40px"">
            <h5 style="width: 100%; line-height:90px; text-align:center">Service Type</h5>
            <canvas id="cer1" ></canvas>
        </div>
        <div class="col-md-4 mt-5" style="background: #fff;style="padding-bottom: 40px"">
            <h5 style="width: 100%; line-height:90px; text-align:center">Payment Type (OMR)</h5>
            <canvas id="cer2" ></canvas>
        </div>
        <div class="col-md-4 mt-5" style="background: #fff;style="padding-bottom: 40px"">
            <h5 style="width: 100%; line-height:90px; text-align:center">Order Source</h5>
            <canvas id="cer3"></canvas>
        </div>
    </div>

    <br> <br>

 

  </div>
 



<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.0/chart.min.js" integrity="sha512-yadYcDSJyQExcKhjKSQOkBKy2BLDoW6WnnGXCAkCoRlpHGpYuVuBqGObf3g/TdB86sSbss1AOP4YlGSb6EKQPg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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









//------------service type

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
var index = 11;
var ctx = document.getElementById("cer1").getContext("2d");
var	myNewChartB = new Chart(ctx, {
    type: 'polarArea',
  data: data,
  options: {}
});


//----------- Payment status

const data2 = {
  labels: [
    'Total Debit',
    'Total Credit'
  ],
  datasets: [{
    label: 'My First Dataset',
    data: [498, 343],
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
var ctx = document.getElementById("cer2").getContext("2d");
var	myNewChartB = new Chart(ctx, {
  type: 'polarArea',
  data: data2,
  options: {}
});


//----------- order source

const data3 = {
  labels: [
    'Admin POS',
    'Divice One',
    'Member Apps'
  ],
  datasets: [{
    label: 'My First Dataset',
    data: [{{$tord}}, 0, 0],
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
var ctx = document.getElementById("cer3").getContext("2d");
var	myNewChartB = new Chart(ctx, {
  type: 'polarArea',
  data: data3,
  options: {}
});
 
</script>

 
 


@endsection




