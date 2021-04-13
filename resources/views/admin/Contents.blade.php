@extends('admin.layouts.master')

@section('head', 'Contents')


@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">


<div class="pull-right" style="height: 70vh;">
    <div class="card-body p-0">
        <div class="row">

     

            <div class="col-md-12">
                <div class="card shadow mb-12" style="width:100%">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">All Pages </h6> 

                        <a href="{{ route('admin.content.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm " style="float:right;margin-right:20px">
          <i class="fas fa-fw fa-user fa-sm text-white-50"></i> Create New</a>
                        

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                      
                                        <th >Title</th>


                                     <th width="100">View</th>
                                     <th width="30">Update</th>
                                    <th width="30">Delete</th>
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($pages as $page)

                                    <tr  >
                                        
                                        <td>{{$page->title}}</td>
                                        <td> <a target="_blank" href="{{route('page',$page->slug)}}">View Page</a>  </td>
                                        <th><a href="{{route('admin.content.update', $page->id)}}" class="btn btn-info  btn-circle btn-sm "> <i class="fas fa-pencil-alt"></i></a></th>
                                            


                                <th>

                                @if($page->status)
                                    <a onclick="deleteCon('delfrmd{{$page->id}}');" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                                    <form id="delfrmd{{$page->id}}" action="{{route('admin.content')}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{$page->id}}">
                                    </form>

                                    @endif
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