<?php 
$saleslog = resolve('saleslog');
 
?>
 
 



    
 


<div class="col-md-12">
    <div class="card mb-12" style="width:100%">
     
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bsaleed" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                       


                        
                        <th>Id /هوية شخصية</th>
                        <th>Receipt No / رقم الإيصال</th>
                        <th >User Name</th>
                        <th>Date / تاريخ</th>
                      
                        

                        <th>TOTAL / مجموع</th>
                     

                        <th>Action / عمل </th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($saleslog->ordersPosted()->where('status', 3)->get() as $sale)
                        <tr>
                            <td>{{$sale->id}}</td>
                            <td>RE-{{$sale->id}}</td>
                            <td>{{$sale->user->memberid}}</td>
                            <td>{{$sale->updated_at}}</td>
                      
                            
                            <td>{{$sale->gettotalprice()['subtotal']}}</td>
                           
                           
                            

                            
                    <td>
                        <a href="" class="btn btn-info"> <i class="fas fa-eye"></i> View</a>
                        <a target="_blank" href="{{route('pos.print', $sale->id)}}" class="btn btn-info"> <i class="fas fa-print"></i> Print</a>
                        <a href="" class="btn btn-info"> <i class="fas fa-expand-arrows-alt"></i> Move Order</a>
                        <a href="{{route('pos.update', $sale->id)}}" class="btn btn-info"> <i class="fas fa-pen-square"></i> Edit & Pay</a>

                        {{-- <a onclick="deleteCon('delfrm{{$sale->id}}');" class="btn btn-danger "><i class="fas fa-trash"></i></a>
                        <form id="delfrm{{$sale->id}}" action="" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{$sale->id}}">
                        </form> --}}

                    </td>
                        
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



