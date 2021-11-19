
<?php
$mcategories = resolve('mcategories');
$menutypes = resolve('menutypes');
$addons = resolve('addons');
$promotions = resolve('promotions');
$branches = resolve('branches');

?>
@extends('admin.layouts.master')

@section('head', 'Update menu')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.css" rel="stylesheet">
<!-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.js"></script> -->

<style>
.img-thumbnail {
    padding: 0.15rem;
    background-color: #000;
    border: 1px solid #dddfeb;
    border-radius: 0rem;
    max-width: 100%;
    height: auto;
    margin-bottom: 10px;
}

.btn-circle{cursor: pointer;
    margin: -45px 10px auto 0;
    float: right;
    position: relative;
    z-index: 1;}



</style>
<style>

    select[data-multi-select-plugin] {
        display: none !important;
    }
    
    .multi-select-component {
        position: relative;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        height: auto;
        width: 100%;
        padding: 3px 8px;
        font-size: 14px;
        line-height: 1.42857143;
        padding-bottom: 0px;
        color: #555;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        -webkit-transition: border-color ease-in-out 0.15s, -webkit-box-shadow ease-in-out 0.15s;
        -o-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
        transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
    }
     
    .autocomplete-list {
        border-radius: 4px 0px 0px 4px;
    }
    
    .multi-select-component:focus-within {
        box-shadow: inset 0px 0px 0px 2px #78ABFE;
    }
    
    .multi-select-component .btn-group {
        display: none !important;
    }
    
    .multiselect-native-select .multiselect-container {
        width: 100%;
    }
    
    .selected-wrapper {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        display: inline-block;
        border: 1px solid #2196F3;
        background-color: #2196F3;
        white-space: nowrap;
        margin: 1px 5px 5px 0;
        height: 32px;
        vertical-align: top;
        cursor: default; padding: 5px 10px; color: #fff
    }
    
    .selected-wrapper .selected-label {
        max-width: 514px;
        display: inline-block;
        overflow: hidden;
        text-overflow: ellipsis;
        padding-left: 4px;
        vertical-align: top;
    }
    
    .selected-wrapper .selected-close {
        display: inline-block;
        text-decoration: none;
        font-size: 14px;
        line-height: 1.49em;
        margin-left: 5px;
        padding-bottom: 10px;
        height: 100%;
        vertical-align: top;
        padding-right: 4px;
        opacity: 0.2;
        color: #000;
        text-shadow: 0 1px 0 #fff;
        font-weight: 700;
    }
    
    .search-container {
        display: flex;
        flex-direction: row;
    }
    
    .search-container .selected-input {
        background: none;
        border: 0;
        height: 20px;
        width: 60px;
        padding: 0;
        margin-bottom: 6px;
        -webkit-box-shadow: none;
        box-shadow: none;
    }
    
    .search-container .selected-input:focus {
        outline: none;
    }
    
    .dropdown-icon.active {
        transform: rotateX(180deg)
    }
    
    .search-container .dropdown-icon {
        display: inline-block;
        padding: 10px 5px;
        position: absolute;
        top: 5px;
        right: 5px;
        width: 10px;
        height: 10px;
        border: 0 !important;
        /* needed */
        -webkit-appearance: none;
        -moz-appearance: none;
        /* SVG background image */
        background-image: url("data:image/svg+xml;charset=UTF-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2212%22%20height%3D%2212%22%20viewBox%3D%220%200%2012%2012%22%3E%3Ctitle%3Edown-arrow%3C%2Ftitle%3E%3Cg%20fill%3D%22%23818181%22%3E%3Cpath%20d%3D%22M10.293%2C3.293%2C6%2C7.586%2C1.707%2C3.293A1%2C1%2C0%2C0%2C0%2C.293%2C4.707l5%2C5a1%2C1%2C0%2C0%2C0%2C1.414%2C0l5-5a1%2C1%2C0%2C1%2C0-1.414-1.414Z%22%20fill%3D%22%23818181%22%3E%3C%2Fpath%3E%3C%2Fg%3E%3C%2Fsvg%3E");
        background-position: center;
        background-size: 10px;
        background-repeat: no-repeat;
    }
    
    .search-container ul {
        position: absolute;
        list-style: none;
        padding: 0;
        z-index: 3;
        margin-top: 39px;
        width: 100%;
        right: 0px;
        background: #fff;
        border: 1px solid #ccc;
        border-top: none;
        border-bottom: none;
        -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
        box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
    }
    
    .search-container ul :focus {
        outline: none;
    }
    
    .search-container ul li {
        display: block;
        text-align: left;
        padding: 8px 29px 2px 12px;
        border-bottom: 1px solid #ccc;
        font-size: 14px;
        min-height: 31px;
    }
    
    .search-container ul li:first-child {
        border-top: 1px solid #ccc;
        border-radius: 4px 0px 0 0;
    }
    
    .search-container ul li:last-child {
        border-radius: 4px 0px 0 0;
    }
    
    
    .search-container ul li:hover.not-cursor {
        cursor: default;
    }
    
    .search-container ul li:hover {
        color: #333;
        background-color: rgb(251, 242, 152);
        ;
        border-color: #adadad;
        cursor: pointer;
    }
    
    /* Adding scrool to select options */
    .autocomplete-list {
        max-height: 130px;
        overflow-y: auto;
    }


    .backDrop{
  background-color: #000;
  display: none;
  filter: alpha(opacity=0);
  height: 100%;
  left: 0px;
  opacity: .0;
  position: fixed;
  top: 0px;
  width: 100%;
  z-index: 50;
}

.pricelog{
 
 display: none;
 left: 50%;
 opacity: 0;
 position: fixed;
 top: 4%;
 z-index: 51; width: 500px; overflow: hidden; margin-left: -250px;  
 
 -moz-border-radius: 6px;
 -webkit-border-radius: 6px;
 border-radius: 6px; background: none; padding-bottom: 20px;overflow-y: scroll; 
}
    </style>
<div class="container" style="height: 90vh;">
    <div class="card-body p-0">
        <div class="row">



            <div class="col-md-4">
                <div class="card shadow mb-12" style="width:100%">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Add Stock</h6>
 
                    </div>
                    <div class="card-body">
                        <form action="{{ route('stock.menu.store') }}" method="post" enctype='multipart/form-data'>
                            @csrf
                            @method('POST')

                            <input type="hidden" value="{{$product->id}}" name="id">
                            <input type="hidden" value="{{$product->cover}}" name="curimage">

                            <div class="row">
        
                                <div class="form-group col-md-6">
                                    <label for="inputCity">Menu Name </label>
                                    <input type="text" value="{{$product->name}}"
                                        class="form-control @error('name') is-invalid @enderror" readonly name="name">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                  <label for="inputCity">Current Stock</label>
                                  <input type="text" value="{{$product->stock_available}}"
                                      class="form-control @error('name') is-invalid @enderror" readonly name="stoc">
                                  @error('name')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror
                              </div>

                            </div>

                             

                                <div class="form-group">
                                  <label for="inputCity">Add Stock </label>
                                  <input type="text" class="form-control @error('qty') is-invalid @enderror"
                                      value="" name="qty">
                                  @error('qty')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>Enter Price eg(5.50/ 50)</strong>
                                  </span>
                                  @enderror
                              </div>


                              <div class="form-group">
                                <label for="inputCity">Note </label>
                                <input type="text" class="form-control @error('body') is-invalid @enderror"
                                    value="" name="body">
                               
                            </div>
 
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                    </div>
                </div>
            </div>


            <div class="col-md-8">
              <div class="card shadow mb-12" style="width:100%">
                  <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary">Stock Log</h6>

                  </div>
                  <div class="card-body">
                    <div class="table-responsive">

                      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                          <thead>
                              <tr>
                                <th class="text-left text-blue-900">Date</th>
                                <th>Quantity Added</th>
                                <th>Quantity Reduced</th>
                                <th>Note</th>
                             
                                  
          
                              </tr>
                          </thead>
          
                          <tbody>
                              @forelse ($product->menustocks as $stock)
                              <tr>
                                  <td>{{$stock->created_at}}</td>
                                 
                                  <td>@if ($stock->qty_added == '0.0') - @else  {{$stock->qty_added}} @endif </td>

                                  <td>@if ($stock->qty_reduced == '0.0') - @else  {{$stock->qty_reduced}} @endif </td>

                                  <td>{{$stock->body}}</td>

                                   
          
                              </tr>
                              @empty
                                  <tr><td>No Stock history.</td></tr>
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

{{-- <div class="backDrop"></div>

<div class="pricelog">

  <div class="card shadow mb-12" style="width:100%">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Price Log</h6> 
        

    </div>
    <div class="card-body">
        
    </div>
</div> --}}


</div>

@endsection










@section('script')



 

@endsection