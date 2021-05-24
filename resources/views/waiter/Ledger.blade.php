
@extends('admin.layouts.master')

@section('head', 'Members - Ledger')

@section('content')






<!-- Begin Page Content -->
<div class="container-fluid">


    <div class="pull-right" style="height: 70vh;">
        <div class="card-body p-0">
            <div class="row">
    
         
  
                    <div class="card shadow mb-12" style="width:100%">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Ledger - Members</h6> 
                            
    
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-left text-blue-900">Member ID</th>
                                            <th class="text-left text-blue-900">Military ID</th>
                                            <th class="text-left text-blue-900">Full Name</th>
                                            <th class="text-left text-blue-900">Email</th>
                                            <th class="text-left text-blue-900">Phone Number</th>
                                            <th class="text-left text-blue-900">Rank</th>
                                            
                                            <th class="text-left text-blue-900">Balance Amount</th>
                                          
                                        
    
                                        </tr>
                                    </thead>
   
                                    <tbody>
                                        @forelse ($members as $member)
                                        <tr>
                                            <td>{{$member->id}}</td>
                                            <td>{{$member->memberid}}</td>
                                            <td>{{$member->name}}</td>
                                            <td>{{$member->email}}</td>
                                            <td>{{$member->phone}}</td>
                                            <td>
                                                @if ($member->rank_id != null)
                                                {{$member->getrank()->name}}
                                                @endif
                                                </td>
                                            <td>{{$member->getCreditAmount()}}</td>
 
    
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