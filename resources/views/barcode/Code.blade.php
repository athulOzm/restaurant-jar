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
                                        <select name="barcode" class="form-control  selectpicker" data-live-search="true">
                                            @foreach ($menus as $menu)
                                                <option data-tokens="{{$menu->id}}">{{$menu->name}}</option>
                                            @endforeach
                                            
                                          
                                          </select>
                                          
                                          
                                    </div>

                                    <div class="form-group">
                                        <label for="item_limit" class="block  text-sm font-bold mb-2 sm:mb-4 ">
                                            Quantity:
                                        </label>
                                        <input id="item_limit" type="text" class="form-control " name="qty" value="1" autofocus="">
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
                    <div class="card shadow mb-12" style="width:100%" >
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Barcode 

                                <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm print-link" style="float:right"><i class="fas fa-fw fa-print fa-sm text-white-50 "></i> Print</button>
                            </h6>
                        </div>
                        <div class="card-body" id="ele2" style="width: 86mm; text-align:center">
                            


                        <img width="256mm" src="data:image/png;base64,{{DNS1D::getBarcodePNG($men->name.'-'.number_format($men->promotion_price * $qty, 3), 'C39', 1, 60)}}" alt="barcode" />

                        <h4 style="width: 100%; text-align:center; letter-spacing:3px" class="p0">34567896543456</h4>

                        <h5 style="width: 100%; text-align:center">{{$men->name}} | RO: {{number_format($men->promotion_price * $qty, 3)}}</h5>

 


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




<script src="{{asset('dashboard/js/jQuery.print.min.js')}}"></script>
        <script type='text/javascript'>
        //<![CDATA[
        jQuery(function($) { 'use strict';
            $('.print-link').on('click', function() {
                //Print ele2 with default options
                $.print("#ele2");
            });
            // $("#ele4").find('button').on('click', function() {
            //     //Print ele4 with custom options
            //     $("#ele4").print({
            //         //Use Global styles
            //         globalStyles : false,
            //         //Add link with attrbute media=print
            //         mediaPrint : false,
            //         //Custom stylesheet
            //         stylesheet : "http://fonts.googleapis.com/css?family=Inconsolata",
            //         //Print in a hidden iframe
            //         iframe : false,
            //         //Don't print this
            //         noPrintSelector : ".avoid-this",
            //         //Add this at top
            //         prepend : "Hello World!!!<br/>",
            //         //Add this on bottom
            //         append : "<span><br/>Buh Bye!</span>",
            //         //Log to console when printing is done via a deffered callback
            //         deferred: $.Deferred().done(function() { console.log('Printing done', arguments); })
            //     });
            // });
            // Fork https://github.com/sathvikp/jQuery.print for the full list of options
        });
        //]]>
        </script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    
     
    


@endsection