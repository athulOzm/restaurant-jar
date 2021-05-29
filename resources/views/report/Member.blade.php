@extends('admin.layouts.master')


@section('head', 'Dashboard')

@section('content')


 

 <style>
.txtb{min-width: 100%; width: auto}
 </style>
   

<div class="container">
   
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h2 class="h5 mb-0" style="font-weight: 700">MEMBER STATUS</h2>
        
      </div>

    <form action="{{route('report.sale.search')}}" method="POST">
        @csrf()
        @method('POST')
    <div class="row mb-3">
        
        
        <div class="col-md-3">
          <p style="
            padding: 0;
            margin: 0;
            font-size: 11px;
        ">Member ID / Name / Phone</p>
          <input type="text" name="memberid" required id="autocomplete" class="form-control w-full txtb">
        </div>
        
        <div class="col-md-4 mt-3">
            <button class="btn btn-primary btnc1" id="pay" type="submit">View Report <i class="fas fa-arrow-right"></i></button>
        </div>
   
    </div>
</form>
    <br> 
 


    {{-- <div class="row" style="background: #fff; padding:20px; border-radius: 3px">
        <div class="col-md-12 mt-5">
            <canvas id="barChartmonth" style="width: 100%"></canvas>
        </div>
    </div> --}}
    
 

 

  </div>
 


{{-- 
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.0/chart.min.js" integrity="sha512-yadYcDSJyQExcKhjKSQOkBKy2BLDoW6WnnGXCAkCoRlpHGpYuVuBqGObf3g/TdB86sSbss1AOP4YlGSb6EKQPg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

<script>
// var DEFAULT_DATASET_SIZE = 3,
//     addedCount = 0,
//     color = Chart.helpers.color;

// var chartColors = {
//     red: 'rgb(255, 99, 132)',
//     orange: 'rgb(255, 159, 64)',
//     yellow: 'rgb(255, 205, 86)',
//     green: 'rgb(75, 192, 192)',
//     blue: 'rgb(54, 162, 235)',
//     purple: 'rgb(153, 102, 255)',
//     grey: 'rgb(231,233,237)'
// };

 

 
// var barData2 = {
//     labels: @json([]),
//     datasets: [{
//         label: 'Total Orders',
//         backgroundColor: color(chartColors.red).alpha(0.5).rgbString(),
//         borderColor: chartColors.red,
//         borderWidth: 1,
//         data: @json([])
//     }, {
//         label: 'Total Amount',
//         backgroundColor: color(chartColors.blue).alpha(0.5).rgbString(),
//         borderColor: chartColors.blue,
//         borderWidth: 1,
//         data: @json([])
//     }]
// };

// var index = 11;
// var ctx = document.getElementById("barChartmonth").getContext("2d");
// var	myNewChartB = new Chart(ctx, {
//     type: 'bar',
//     data: barData2,
//     options: {
//         responsive: false,
//         maintainAspectRation: false,
//         legend: {
//             position: 'top',
//         },
//         title: {
//             display: true,
//             text: 'Bar Chart'
//         },
        
//     }
// });



$(document).ready(function(){	
    
    



    var members = [];
    $.ajax({
      url: "/pos/getmembers",
     // /pos/getmember
      async: true,
      dataType: 'json',
      success: function (data) {
        //console.log(data);
        for (var i = 0, len = data.length; i < len; i++) {
          var id = (data[i].id).toString();
          members.push({
            'value' : data[i].memberid +` - `+ data[i].phone +` - `+ data[i].name, 
            'data' : id, 
            'name' : data[i].name, 
            'pty' : data[i].payment_type_id, 
            'credit' : data[i].total_credit
            });
        }
        loadSuggestions(members);
      }
    });


    function loadSuggestions(options) {
		$('#autocomplete').autocomplete({
			lookup: options,
			onSelect: function (member) {
 
			}
		});
	}
  });

 

 
</script>

 
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.2.27/jquery.autocomplete.min.js"></script>


@endsection



