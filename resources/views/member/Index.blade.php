 
@extends('admin.layouts.master')

@section('head', 'Members')

@section('content')






<!-- Begin Page Content -->
<div class="container-fluid">


    <div class="pull-right" style="height: 70vh;">
        <div class="card-body p-0">
            <div class="row">
    
         
  
                    <div class="card shadow mb-12" style="width:100%">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Members <a  href="{{ route('member.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm " style="float:right"><i class="fas fa-fw fa-table fa-sm text-white-50"></i> Create New</a></h6> 
                            
    
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-left text-blue-900">Military ID</th>
                                            <th class="text-left text-blue-900">Name</th>
                                            <th class="text-left text-blue-900">Email</th>
                                            <th class="text-left text-blue-900">Phone</th>
                                            <th class="text-left text-blue-900">Position</th>
                                            <th class="text-left text-blue-900" width="30">Update</th>
                                            <th class="text-left text-blue-900" width="30">Delete</th>
    
                                        </tr>
                                    </thead>
    
                                    <tbody>
                                        @forelse ($members as $member)
                                        <tr>
                                            <td>{{$member->memberid}}</td>
                                            <td>{{$member->name}}</td>
                                            <td>{{$member->email}}</td>
                                            <td>{{$member->phone}}</td>
                                            <td>{{$member->position}}</td>
                                         

                                                <th><a href="" class="btn btn-info  btn-circle btn-sm "> <i
                                                    class="fas fa-pencil-alt"></i></a></th>
                                            
                                            <td> <button onclick="document.getElementById({{$member->id}}).submit();" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></button> 
                                                <form id="{{$member->id}}" method="POST" action="{{ route('member.delete') }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id" value="{{$member->id}}">
                                                </form>
                                            
                                            </td>
    
                                        </tr>
                                        @empty
                                            <tr><td>No found</td></tr>
                                        @endforelse
     
                                        
                                     
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
        





            </div>




            </div>
        </div>

    </div>

</div>


 
    
    @endsection