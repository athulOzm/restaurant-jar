
@extends('admin.layouts.master')

@section('head', 'Users')

@section('content')






<!-- Begin Page Content -->
<div class="container-fluid">


    <div class="pull-right" style="height: 70vh;">
        <div class="card-body p-0">
            <div class="row">
    
         
  
                    <div class="card shadow mb-12" style="width:100%">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Users <a  href="{{ route('user.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm " style="float:right"><i class="fas fa-fw fa-table fa-sm text-white-50"></i> Create New</a>  
                            </h6> 
                            
    
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                      
                                            <th class="text-left text-blue-900">Full Name</th>
                                            <th class="text-left text-blue-900">Branch</th>
                                            <th class="text-left text-blue-900">Email/ Username</th>
                                           
                                            <th class="text-left text-blue-900" width="60">Action</th>
                                        
    
                                        </tr>
                                    </thead>
   
                                    <tbody>
                                        @forelse ($users as $user)
                                        <tr>
                                      
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->branch->full_name}}</td>
                                            <td>{{$user->email}}</td>
                                         
                                           
                                        

                                         

                                                <th><a href="{{route('user.edit', $user)}}" class="btn btn-secondary  btn-circle btn-sm "> <i
                                                    class="fas fa-pencil-alt"></i></a> 
                                            
                                            <button style="margin-left: 10px"  onclick="deleteCon('delfrm{{$user->id}}');" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></button> 
                                                <form id="delfrm{{$user->id}}" method="POST" action="{{ route('user.delete') }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id" value="{{$user->id}}">
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