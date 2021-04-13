@extends('admin.layouts.master')

@section('head', 'Admin | Reviews')

@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">


<div class="pull-right" style="height: 70vh;">
    <div class="card-body p-0">
        <div class="row">

     

            <div class="col-md-12">
                <div class="card shadow mb-12" style="width:100%">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">All Reviews </h6> 
                        

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="10">Rev.Id</th>
                                        <th  width="30">Rating</th>
                                        <th  width="30">Name</th>
                                        <th >Product</th>
                                        <th >Email</th>
                                        <th>Comment</th>
                                        <th  width="30">Status</th>
                                        <th width="30">Activate</th>
                                    <th width="30">Delete</th>
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($reviews as $review)

                                    <tr  >
                                        <td>{{$review->id}}</td>
                                        <td>{{$review->stars}}</td>
                                        <td>{{$review->name}}</td>
                                        <td> <a target="_blank" href="{{route('product', $review->product->slug)}}">{{$review->product->name}}</a> </td>
                                        <td>{{$review->email}}</td>
                                        <td>{{$review->review}}</td>
                                        <td> 
                                        @if($review->status == true)
                                        Active
                                        @else
                                        Pending
                                        @endif
                                        </td>
                                            <th>
                                    <a onclick="deleteCon('delfrm{{$review->id}}');" class="btn btn-info  btn-circle btn-sm "><i
                                            class="fas fa-pencil-alt"></i></a>
                                    <form id="delfrm{{$review->id}}" action="{{route('admin.reviewupd')}}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="id" value="{{$review->id}}">
                                    </form>
                                </th>


                                <th>
                                    <a onclick="deleteCon('delfrmd{{$review->id}}');" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                                    <form id="delfrmd{{$review->id}}" action="{{route('admin.review')}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{$review->id}}">
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
        </div>
    </div>
    </div></div>

@endsection


@section('script')

<script>
$(document).ready(function() {
    $('#dataTable2').DataTable( {
        "order": [[ 0, "desc" ]]
    } );
} );
</script>

@endsection