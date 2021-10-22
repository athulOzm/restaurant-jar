<?php 
$saleslog = resolve('saleslog2');
 
?>
 
 



    
 


<div class="col-md-12">
    <div class="card mb-12" style="width:100%">
     
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bsaleed" id="dataTable3" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Order From</th>
                            <th>Vehicle No</th>
                            <th>Table</th>
                            
                           
                            <th>TOTAL</th>
                            <th style="width: 40%">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($saleslog as $sale)
                        <tr>
                            <td>{{$sale->updated_at}}</td>
                            <td>{{$sale->reqFrom->name}}</td>
                    
                           
                            <td>{{$sale->vn}}</td>
                            <td> @if ($sale->table)
                                {{$sale->table->name}} ({{$sale->table->chair}})
                            @endif </td>

                            
                      
                            
                            <td>{{$sale->gettotalprice()['subtotal']}}</td>
                           
                           
                           
                            
                    <td>
                        <a target="_blank" href="{{route('pos.view', $sale->id)}}" class="btn btn-info"> <i class="fas fa-eye"></i> View</a>

                        <a   href="{{route('pos.print.order', $sale->id)}}" class="btn btn-info"> <i class="fas fa-print"></i> Reprint</a>
                        {{-- <a href="" class="btn btn-info"> <i class="fas fa-clone"></i> Clone</a> --}}
                        <a href="{{route('pos.update', $sale->id)}}" class="btn btn-info"> <i class="fas fa-pen-square"></i> Edit & Pay</a>

                        <a onclick="deleteCon('delord{{$sale->id}}');" class="btn btn-danger "><i class="fas fa-trash"></i></a>
                        <form id="delord{{$sale->id}}" action="{{route('order.destroy')}}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{$sale->id}}">
                        </form>

                    </td>
                        
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



