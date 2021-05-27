@extends('admin.layouts.master')


@section('head', 'Dashboard')

@section('content')


 

 
   

<div class="container">
    <h4 class="mb-3">Sales Report</h4>

    <div class="row mb-3">
        <div class="col-md-3">
            <input name="dtime" id="dtimee" step="any" type="datetime-local" onchange="getlimitbydate()" class="form-control border-gray-400 txtb">
        </div>
        <div class="col-md-3">
            <input name="dtime" id="dtimee" step="any" type="datetime-local" onchange="getlimitbydate()" class="form-control border-gray-400 txtb">
        </div>
        <div class="col-md-6">
            <button class="btn btn-primary btnc1" id="pay" type="button">View Report <i class="fas fa-arrow-right"></i></button>
        </div>
    </div>

    <br> <br>



    <div class="row" style="background: #fff; padding:20px; border-radius: 3px">
        <h5 style="width: 100%">Sales Last 30 Days</h5>
        <div class="col-md-8">
            <canvas id="barChartb" style="width: 100%"></canvas>
        </div>
    
        <div class="col-md-4">
            <h5 style="width: 100%">Source</h5>

            <canvas id="cer1" style="width: 600px"></canvas>
        </div>
    </div>

    <br> <br>


    <div class="row" style="background: #fff; padding:20px; border-radius: 3px">
        <h5 style="width: 100%">Sales Current Financial Year</h5>
        <div class="col-md-8">
            <canvas id="barChart" style="width: 100%"></canvas>
        </div>
    
        <div class="col-md-4">
            <h5 style="width: 100%">Source</h5>

            <canvas id="cer2" style="width: 600px"></canvas>
        </div>
    </div>


    


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

function randomScalingFactor() {
    return Math.round(Math.random() * 960);
}

var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

var barData = {
    labels: ["January", "February", "March", "April", "May", "June", "July", "Aug", "Sep", "Oct", "Nov", "Dec"],
    datasets: [{
        label: 'Credit Payment',
        backgroundColor: color(chartColors.red).alpha(0.5).rgbString(),
        borderColor: chartColors.red,
        borderWidth: 1,
        data: [
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor()
        ]
    }, {
        label: 'Cash Payment',
        backgroundColor: color(chartColors.blue).alpha(0.5).rgbString(),
        borderColor: chartColors.blue,
        borderWidth: 1,
        data: [
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor()
        ]
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


























var days = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

var barData2 = {
    labels: ["Jan 1","Jan 2","Jan 3","Jan 4","Jan 5","Jan 6","Jan 7","Jan 8","Jan 9","Jan 10","Jan 11"],
    datasets: [{
        label: 'Credit Payment',
        backgroundColor: color(chartColors.red).alpha(0.5).rgbString(),
        borderColor: chartColors.red,
        borderWidth: 1,
        data: [
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor()
        ]
    }, {
        label: 'Cash Payment',
        backgroundColor: color(chartColors.blue).alpha(0.5).rgbString(),
        borderColor: chartColors.blue,
        borderWidth: 1,
        data: [
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor()
        ]
    }]
};

var index = 11;
var ctx = document.getElementById("barChartb").getContext("2d");
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











const data = {
  labels: [
    'Admin',
    'Mobile',
    'Divices'
   
  ],
  datasets: [{
    label: 'My First Dataset',
    data: [11, 16, 7],
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

 
var index = 11;
var ctx = document.getElementById("cer2").getContext("2d");
var	myNewChartB = new Chart(ctx, {
    type: 'polarArea',
  data: data,
  options: {}
});
</script>

 
 


@endsection




