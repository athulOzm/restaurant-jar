@extends('admin.layouts.master')


@section('head', 'Categories')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">

        <div class="col-md-6">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">locations</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                 
                                    <th width="30">Delete</th>


                                </tr>
                            </thead>

                            @foreach(resolve('publicbind')['locations'] as $location)
                            <tr>
                                <th>{{ $location->name }}</th>
                       
                          
                           
                                <th>
                                    <a onclick="deleteCon('delfrm{{$location->slug}}');" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                                    <form id="delfrm{{$location->slug}}" action="{{route('admin.location.delete')}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{$location->id}}">
                                    </form>
                                </th>
                            </tr>

                            @endforeach

                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>




        <div class="col-md-6">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Add New location</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.location.post')}}" aria-label="Register"
                        enctype="multipart/form-data">

                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
 






                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
</div>
<!-- /.container-fluid -->




@endsection