<?php 
$saleslog = resolve('saleslog4');
 
?>
 
 



    
 


<div class="col-md-12">
    <div class="card mb-12" style="width:100%">
     
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bsaleed" id="dataTable4" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                       

                         
                            <th>Date</th>
                            <th>Id</th>
                           
                            <th>Customer ID</th>
                            
                            <th>TOTAL</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($saleslog as $sale)
                        <tr>
                      
                            <td>{{$sale->updated_at}}</td>
                            <td>{{$sale->id}}</td>
                           
                            <td>@if ($sale->user)
                                {{$sale->user->memberid}}
                            @endif</td>
                            
                      
                            
                            <td>{{$sale->gettotalprice()['subtotal']}}</td>
                           
                           
                            

                            
                    <td>
                        <a target="_blank" href="{{route('pos.view', $sale->id)}}" class="btn btn-info"> <i class="fas fa-eye"></i> View</a>
                        <a target="_blank" href="{{route('pos.print', $sale->id)}}" class="btn btn-info"> <i class="fas fa-print"></i> Reprint</a>
                        {{-- <a href="{{route('pos.clone', $sale->id)}}" class="btn btn-info"> <i class="fas fa-clone"></i> Clone</a>
                        <a href="{{route('pos.update', $sale->id)}}" class="btn btn-info"> <i class="fas fa-pen-square"></i> Edit</a> --}}

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



