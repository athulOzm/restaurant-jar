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
                       


                        <th width="30">Member ID</th>
                        <th width="30">Receipt Id</th>
                        <th width="30">User</th>
                        <th width="30">Ord. Source</th>
                        

                        <th width="30">Amount Total</th>
                     

                        <th width="30">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($saleslog->ordersPosted()->where('status', 4)->get() as $sale)
                        <tr>
                            <td>{{$sale->user->memberid}}</td>
                            <td>{{$sale->id}}</td>
                            <td>{{$sale->user->name}}</td>
                            <td>{{$sale->getReqByAttribute()}}</td>
                            <td>{{$sale->gettotalprice()['subtotal']}}</td>
                           

                            
                    <th>
                        <a href="" class="btn btn-info    "> <i
                            class="fas fa-pencil-alt"></i></a>

                        <a onclick="deleteCon('delfrm{{$sale->id}}');" class="btn btn-danger "><i class="fas fa-trash"></i></a>
                        <form id="delfrm{{$sale->id}}" action="" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{$sale->id}}">
                        </form>

                    </th>
                        
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



