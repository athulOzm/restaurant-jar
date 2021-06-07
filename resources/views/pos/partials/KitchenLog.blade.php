<?php 
$saleslog = resolve('saleslog');
 
?>
 
 



    
 


<div class="col-md-12">
    <div class="card mb-12" style="width:100%">
     
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bsaleed" id="dataTable2" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Receipt No</th>
                            <th>Member ID</th>
                            <th>Date</th>
                            <th>TOTAL</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($saleslog->ordersPosted()->where('status', 3)->orWhere('status', 4)->get() as $sale)
                        <tr>
                            <td>{{$sale->id}}</td>
                            <td>RE-{{$sale->id}}</td>
                            <td>@if ($sale->user)
                                {{$sale->user->memberid}}
                            @endif</td>
                            <td>{{$sale->updated_at}}</td>
                      
                            
                            <td>{{$sale->gettotalprice()['subtotal']}}</td>
                           
                           
                            

                            
                    <td>
<b>                        @if ($sale->made)
                            Ready to Deliver
                        @else
                            Prograssing
                        @endif

                         
                    </b>

                    </td>
                        
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



