@extends('admin.layouts.master')
@section('head', 'Agents')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

 

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Agents</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Created</th>
           
          </tr>
        </thead>
        <!-- <tfoot>
          <tr>
          <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Created</th>
        
          </tr>
        </tfoot> -->
        <tbody>

        @foreach($agents as $agent)
        <tr>
            <td> <a href=""> {{$agent->name}}</a></td>
            <td>{{$agent->email}}</td>
            <td>{{$agent->phone}}</td>
            <td>@if($agent->status == true) Active @else Desabled @endif </td>
            <td>{{$agent->dateCreated()}}</td>
           
          </tr>


@endforeach


        

          
          
        </tbody>
      </table>
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->




@endsection