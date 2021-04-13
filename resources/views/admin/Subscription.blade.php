@extends('admin.layouts.master')


@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">


<div class="pull-right" style="height: 70vh;">
    <div class="card-body p-0">
        <div class="row">

     

            <div class="col-md-6">
                <div class="card shadow mb-12" style="width:100%">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">All Content </h6> 

                        <a href="/admin/content/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm " style="float:right;margin-right:20px">
          <i class="fas fa-fw fa-user fa-sm text-white-50"></i> Create New</a>
                        

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th width="30">Delete</th>
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($profiles as $profile)

                                    <tr>
                                        <th>{{$profile->name}}</th>
                                        <th>{{$profile->email}}</th>
                                        <th>{{$profile->phone}}</th>
                                        <th>
                                            <a onclick="deleteCon('delfrmd{{$profile->id}}');" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                                            <form id="delfrmd{{$profile->id}}" action="{{route('admin.subscription')}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id" value="{{$profile->id}}">
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


            <div class="col-md-6">
            <textarea class="form-control" name="" id="" cols="30" rows="10">@foreach($profiles as $profile) {{$profile->email}}, @endforeach</textarea>
            </div>






        </div>
    </div>
    </div></div>

@endsection