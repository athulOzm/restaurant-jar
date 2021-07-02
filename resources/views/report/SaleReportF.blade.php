<?php 
$branches = resolve('branches');
$menutypes = resolve('menutypesforrep');
$menucat = resolve('mcategories');
?>
@extends('admin.layouts.master')

@section('head', 'Dashboard')

@section('content')


 
 

<div class="container">
    <h4 class="mb-3">Sales Report Fast Moving Items</h4>
    <form action="{{route('report.sale')}}" method="GET">
      
    <div class="row py-3" style="margin: 0; background:white; border-radius:6px">

        <div class="form-group col-md-4">
            <label for="branch_id" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                Branches:
            </label>
                <select required class="form-control w-full border-gray-400" name="branch_id">
                <option value="All">All Branches</option>

                    @foreach ($branches as $item)
                        @if (isset($_GET['branch_id']) and $item->id == $_GET['branch_id'])
                        <option selected value="{{$item->id}}">{{$item->full_name}}</option>
                        @else
                        <option value="{{$item->id}}">{{$item->full_name}}</option>
                        @endif
                    @endforeach
                </select>
        </div>
        <div class="form-group col-md-4">
            <label for="branch_id" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                Menu Type:
            </label>
                <select required class="form-control w-full border-gray-400" name="menutype_id">
                <option value="All">All Types</option>

                    @foreach ($menutypes as $item)
                        @if (isset($_GET['menutype_id']) and $item->id == $_GET['menutype_id'])
                        <option selected value="{{$item->id}}">{{$item->name}}</option>
                        @else
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endif
                    @endforeach
                </select>
        </div>


        <div class="form-group col-md-4">
            <label for="menucat_id" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                Menu Category:
            </label>
                <select required class="form-control w-full border-gray-400" name="menucat_id">
                <option value="All">All Category</option>

                    @foreach ($menucat as $item)
                        @if (isset($_GET['menucat_id']) and $item->id == $_GET['menucat_id'])
                        <option selected value="{{$item->id}}">{{$item->full_name}}</option>
                        @else
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endif
                    @endforeach
                </select>
        </div>
        <div class="form-group col-md-4">
            <label for="branch_id" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                Date From:
            </label>
            <input name="df"  step="any"  type="datetime-local" class="form-control border-gray-400 txtb">
        </div>
        <div class="form-group col-md-4">
            <label for="branch_id" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                Date To:
            </label>
            <input name="dt"  step="any" type="datetime-local" class="form-control border-gray-400 txtb">
        </div>
      
       
        <div class="col-md-2 mt-4 pt-1">
            <button class="btn btn-primary btnc1" id="pay" type="submit">View Report <i class="fas fa-arrow-right"></i></button>
        </div>
   
    </div>
</form>
<br> 
 



<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-12" style="width:100%">
            <div class="card-header py-3">
             

                {{-- <h5 style="width: 100%; font-size:13px; border-bottom:20px; color:#111" >
        
                    <span style="color: #888; font-size:15px">Total Sale <b style="color: blue">RO {{$tot}}</b> <br>
                         Token used  <b style="color: blue">{{$tord}}</b></span> </h5> --}}
                

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            <th width="30">Item</th>
                            <th width="30">Sold Qty</th>
                            <th width="30">Sold Amount</th>
                            {{-- <th width="30">In Stock</th> --}}
                            </tr>
                        </thead>

                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <th width="30">{{$item->product->name}}</th>
                                <th width="30">{{$item->quantity}}</th>
                                <th width="30">RO : {{number_format($item->price * $item->quantity, 3)}}</th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




 

  

</div>
{{-- 
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
</script> --}}

 
 


@endsection




