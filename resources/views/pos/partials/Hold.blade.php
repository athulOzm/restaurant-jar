<?php 
$saleslog = resolve('saleslog');
 
?>
 
 


<style>
  .table td, .table th {
    padding: 0px 5px 0px 5px!important;
    vertical-align: middle;
    font-size: 14px;
    color: #222;
}
input[type=search]{
   -moz-appearance: none;/* older firefox */
   -webkit-appearance: none; /* safari, chrome, edge and ie mobile */
   appearance: none; /* rest */
}

#dataTable_filter input {
    background: #fff;
    position: absolute;
    border: 2px solid #4e72df;
    padding: 10px 0;
    height: 40px;
    width: 90%;
}

#dataTable{color: #333}
</style>

    
 


<div class="col-md-12">
    <div class="card mb-12" style="width:100%">
     
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bsaleed" id="dataTable2" width="100%" cellspacing="0">
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
                    @foreach($saleslog->ordersPosted()->where('status', 2)->get() as $sale)
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



