
@extends('admin.layouts.master')

@section('head', 'Edit Member')

@section('content')



 

<div class="container" style="height: 90vh;">
    <div class="card-body p-0">
        <div class="row">



            <div class="col-md-12">
                <div class="card shadow mb-12">

                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Membership</h6>
                    </div>

                    <div class="card-body">
                        <h3>{{$user->name}}</h3>
                        <p style="margin: 0">Renewel Date : <b>
                            {{ Carbon\Carbon::parse($user->renewal_at)->format('d M Y') }}


                         
                        
                        </b></p>
                        <p>Miss ID : <b>{{$user->memberid}}</b></p>

                        <form action="{{route('member.renewnow')}}" method="post">
                            @csrf()
                            @method('PATCH')
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <div class="row">
                                <div class="col-md-4">
                                    <select required="" class="form-control " name="category_id" id="category_id">
                                        <option value="1">Credit</option>
                                        <option selected="" value="2">Cash</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn1 btn btn-primary">Renew Now</button>
                                </div>
                            </div>
                        </form>

                        <br> <br>
                        
                    </div>

                  
 
        </div>
   
 






            </div>
        </div>

    </div>

</div>


 
    
    @endsection

