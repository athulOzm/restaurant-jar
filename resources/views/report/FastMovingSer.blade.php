@extends('admin.layouts.master')


@section('head', 'Dashboard')

@section('content')


 

 <style>
.txtb{min-width: 100%; width: auto}
 </style>
   

<div class="container">
   
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h2 class="h5 mb-0" style="font-weight: 700">FAST MOVING ITEMS - SEARCH RESULT</h2>
        
      </div>

    <form action="{{route('report.sale.search')}}" method="POST">
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
 

    <div class="row" style="background: #fff; padding:20px; border-radius: 3px">
        <div class="col-md-12 mt-5">
            <canvas id="barChartmonth" style="width: 100%"></canvas>
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

 

 
var barData = {
    labels: @json($product_id),
    datasets: [{
        label: 'Menu Item',
        backgroundColor: color(chartColors.red).alpha(0.5).rgbString(),
        borderColor: chartColors.red,
        borderWidth: 1,
        data: @json($product_count)
    }]
};

var index = 11;
var ctx = document.getElementById("barChartmonth").getContext("2d");
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
 
</script>

 
 


@endsection




