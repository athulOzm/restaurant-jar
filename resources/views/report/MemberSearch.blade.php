@extends('admin.layouts.master')


@section('head', 'Dashboard')

@section('content')


 

 <style>
.txtb{min-width: 100%; width: auto}
.la{padding: 0;
            margin: 0;
            font-size: 11px;
        }
        .pt1{border-top:1px solid #e7e7e7; padding: 8px}
.tar{font-weight: bold; text-align: right}
        .bootstrap-select>.dropdown-toggle{background: white; border: 1px solid #777}

        .table-bordered th, .table-bordered td {
    border: 1px solid #f1e8e8;
    font-size: 12px;
    font-weight: 400;
    line-height: 17px;
    color: #222;
}

#dataTable .btn{font-size: .7rem; padding: 2px 4px}
 </style>
   

<div class="container">
   
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h2 class="h5 mb-0" style="font-weight: 700">MEMBER REPORT (ENQUIRY)</h2>
        
      </div>

    <form action="{{route('report.member.search')}}" method="POST">
        @csrf()
        @method('POST')
    <div class="row mb-3">
        
        
        <div class="col-md-3">
          <p class="la">Miss ID</p>

          <select name="memberid" class="form-control  selectpicker" data-live-search="true" style="background: #fff">
            @foreach ($users as $user)
                <option data-tokens="{{$user->id}}">{{$user->memberid}}</option>
            @endforeach
            
            
          </select>
 
        </div>

      

        <div class="col-md-3">
          <p class="la">Date From</p>

          <input name="df"  step="any"    type="datetime-local" class="form-control border-gray-400 txtb">
      </div>
      <div class="col-md-3">
        <p class="la">Date To</p>

          <input name="dt"  step="any"   type="datetime-local" class="form-control border-gray-400 txtb">
      </div>

      <div class="form-group col-md-3">
        <p class="la">
            Payment Type:
        </p>
        <select  class="form-control " name="payment_type_id" id="paymenttype">
            <option value="">All</option>


                                            <option value="1">Card</option>
                                            <option value="2">Credit</option>
                                     
            
                                    
        </select>
    </div>

    <div class="form-group col-md-3">
      <p class="la">
          Delivery Type:
      </p>
      <select  class="form-control " name="delivery_type" id="paymenttype">
          <option value="">All</option>


                                          <option value="Dinein">Dinein</option>
                                          <option value="Takeaway">Takeaway</option>
                                          <option value="Delivery">Delivery</option>
          
                                  
      </select>
  </div>

  <div class="form-group col-md-3">
    <p class="la">
        Delivery Location:
    </p>
    <select  class="form-control " name="payment_type_id" id="paymenttype">
        <option value="">All</option>


                                        <option value="1">Pool 1</option>
                                        <option value="2">Pool 2</option>
                                        <option value="3">Guarden </option>
        
                                
    </select>
</div>


        
        <div class="col-md-3 mt-3">
            <button class="btn btn-primary btnc1" id="pay" type="submit">View Report <i class="fas fa-arrow-right"></i></button>
        </div>
   
    </div>
</form>
    
    <hr>

    @if (isset($tot_ord))

<div class="row">
    


    <div class="col-md-8">
        <div class="card shadow mb-12" style="width:100%">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Receipt</h6> 
                

            </div>
            <div class="card-body">
                <div class="table-responsive" style="font-size: .8rem">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                           


                            <th width="30">Member ID</th>
                            <th width="30">Receipt Id</th>
                          
                            <th width="30">Amount Total</th>
                         

                            <th width="30">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach($rec as $order)
                            <tr>
                                 
                                <td>@if ($order->user)
                                    {{$order->user->memberid}}
                                @endif</td>
                                <td>RE-{{$order->id}}</td>
                           
                               
                                <td>{{$order->gettotalprice()['subtotal']}}</td>
                               

                                
                        <th style="font-size: 10px">
                <a target="_blank" href="{{route('pos.print.a4', $order->id)}}" class="btn btn-info"> <i class="fas fa-print"></i> Print</a>
                <a target="_blank" href="{{route('pos.view', $order->id)}}" class="btn btn-info"> <i class="fas fa-eye"></i> View Attachment</a>
                

           

                        </th>
                            
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-4">
        <div class="card shadow mb-12" style="width:100%">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Member Details</h6>
            </div>
            <div class="card-body">
                <div class="row pt1">
                    <div class="col-md-6">Name</div>
                    <div class="col-md-6 tar">{{$user->name}}</div>
                </div>
                <div class="row pt1">
                    <div class="col-md-6">Member ID</div>
                    <div class="col-md-6 tar">{{$user->memberid}}</div>
                </div>
                <div class="row pt1">
                    <div class="col-md-6">Total Credit Amount</div>
                    <div class="col-md-6 tar">{{$user->getCreditAmount()}}</div>
                </div>
                <div class="row pt1">
                    <div class="col-md-6">Total Credit Balance</div>
                    <div class="col-md-6 tar">{{number_format($user->limit - $user->getCreditAmount(), 3)}}</div>
                </div>
               
            </div>
        </div>
    </div>


    
 

</div>

    @endif

    


    {{-- <div class="row" style="background: #fff; padding:20px; border-radius: 3px">
        <div class="col-md-12 mt-5">
            <canvas id="barChartmonth" style="width: 100%"></canvas>
        </div>
    </div> --}}
    
 

 

  </div>

  <script>
    $('.selectpicker').selectpicker();
</script>

@endsection


@section('script')
 
 <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

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



// $(document).ready(function(){	
    
    



//   var menus = [];
// 	$.ajax({
// 		url: "/pos/getmenus",
// 		async: true,
// 		dataType: 'json',
// 		success: function (data) {
//       //console.log(data);
// 			for (var i = 0, len = data.length; i < len; i++) {
// 				var id = (data[i].id).toString();
    
//         if(data[i].name_ar === 'null'){
//           menus.push({'value' : data[i].name, 'data' : id});

				
//         } else{menus.push({'value' : data[i].name +  ` | ` + data[i].name_ar, 'data' : id});}

// 			}
// 			//send parse data to autocomplete function
// 			loadmenuss(menus);
// 		}

// 	});

//   function loadmenuss(options) {
// 		$('#sermenus').autocomplete({
// 			lookup: options,
// 			onSelect: function (menu) {

//         //console.log(menu);
//         //addtocart(menu.data);
//         $('#sermenus').val('');

//       }
//   });

//   }


//   });

 

 
</script>

 
{{--  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.2.27/jquery.autocomplete.min.js"></script> --}}


@endsection




