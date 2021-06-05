@extends('admin.layouts.master')

@section('head', 'Menu Types')

@section('content')






<!-- Begin Page Content -->
<div class="container-fluid">


    <div class="pull-right" style="height: 70vh;">
        <div class="card-body p-0">
            <div class="row">
    
         
    
                





                <div class="col-md-6">
                    <div class="card shadow mb-12" style="width:100%">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Generate barcode</h6> 
                            
    
                        </div>
                        <div class="card-body">
                            <div class="table-responsive" style="min-height: 250px">

                                <form class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8" method="POST" action="{{ route('barcode.menu.generate') }}">
                                    @csrf
                                    @method('POST')
                
                                    <div class="form-group">
                                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                                            Name:
                                        </label>
                                        <select class="form-control  selectpicker" data-live-search="true">
                                            @foreach ($menus as $menu)
                                                <option data-tokens="{{$menu->id}}">{{$menu->name}}</option>
                                            @endforeach
                                            
                                          
                                          </select>
                                          
                                          
                                    </div>


    
                                    
    
                                    
                                    <button type="submit"  
                                    class="btn1 btn-primary btn">
                                    Generate barcode
                                    </button>


                
                                    
                                    
                
                                    
                                </form>

                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-md-6">
                    <div class="card shadow mb-12" style="width:100%">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Barcode</h6>
                        </div>
                        <div class="card-body">
                            <h4>{{$menu->name}}</h4>
                            <h5>{{$menu->price}}</h5>


                        <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($menu->id.'-'.$menu->name.'-'.$menu->price, 'C39', 2, 77)}}" alt="barcode" />



                        </div>
                    </div>
                </div>





            </div>
        </div>

    </div>

</div>


 <script>
     $('.selectpicker').selectpicker();
 </script>
    
    @endsection


    @section('script')

    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>

@endsection