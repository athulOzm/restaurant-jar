<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable5" width="100%" cellspacing="0">
            <thead>
                <tr>
               


                <th width="30">Vehicle No</th>
                <th width="30">Receipt Id</th>
                <th width="30">User</th>
                <th width="30">Order Source</th>
                

                <th width="30">Total Amount</th>
             

                <th width="230">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($orders as $order)

                @if ($order->reqfrom == 3)
                <tr>
                         
                    <td>{{$order->vn}}</td>

                    <td>{{$order->branch->code}}{{$order->invoice->id}}</td>
                   
                    <td>@if ($order->user)
                        {{$order->user->name}}
                    @endif</td>
                    <td>{{$order->getReqByAttribute()}}</td>
                    <td>{{$order->gettotalprice()['subtotal']}}</td>
                   
    
                    
            <th style="font-size: 9px">
                <a target="_blank" href="{{route('pos.view', $order->id)}}" class="btn btn-info"> <i class="fas fa-eye"></i> View</a>
    {{-- <a target="_blank" href="{{route('pos.print.order', $order->id)}}" class="btn btn-info"> <i class="fas fa-print"></i> Reprint</a> --}}
    <a href="{{route('pos.update', $order->id)}}" class="btn btn-success btn-sm"> <i class="fas fa-clone"></i> Confirm & Pay</a>
    <a href="{{route('pos.update', $order->id)}}" class="btn btn-warning btn-sm"> <i class="fas fa-pen-square"></i> Edit</a>
    <a href="{{route('pos.clone', $order->id)}}" class="btn btn-info"> <i class="fas fa-clone"></i> Copy</a>
    
    
                <a onclick="deleteCon('delfrmt{{$order->id}}');" class="btn btn-sm btn-danger "><i class="fas fa-trash"></i> Cancel</a>
                
                <form id="delfrmt{{$order->id}}" action="{{route('order.destroy')}}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="{{$order->id}}">
                </form>
    
            </th>
                
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>