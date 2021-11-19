
<?php
 
$mcategories = resolve('pmcategories');
$units = resolve('units');
 

?>

@extends('admin.layouts.master')

@section('head', 'Add product')

@section('content')



<!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<link href="{{asset('dashboard/vendor/summernote/summernote.min.css')}}" rel="stylesheet">
<!-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.js"></script> -->

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
    font-size: 13px;
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
    transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;font-weight: 400
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
</style>
<div class="container" style="height: 90vh;">
    <div class="card-body p-0">
        <div class="row">



            <div class="col-md-12">
                <div class="card shadow mb-12" style="width:100%">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Add Product</h6>


                    </div>
                    <div class="card-body">





                        <form action="{{ route('material.store') }}" method="post" enctype='multipart/form-data'>

                        <input type="hidden"  value="1000" name="coupons">
                            @csrf

                            <input type="hidden" name="subcat" value="">



                            <div class="row">

                                <div class="form-group col-md-4">
                                    <label for="inputCity">Product Name *</label>
                                    <input type="text" value="{{@old('name')}}"
                                        class="form-control @error('name') is-invalid @enderror" name="name">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                               


                                
                                <div class="form-group col-md-4">
                                    <label for="inputCity">Price (RO)</label>
                                    <input type="text" class="form-control @error('price') is-invalid @enderror"
                                        value="{{@old('price')}}" name="price">
                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Enter Price eg(5.600)</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group  col-md-4">
                                    <label for="inputCity">
                                        VAT (%)
                                    </label>
                                    <input id="vat" type="text"
                                        class="form-control w-full border-gray-400 @error('vat') border-red-500 @enderror" name="vat"
                                        value="" required  autofocus>
            
                                        @error('vat')
                                        <p class="text-red-500 text-xs italic mt-4">
                                            {{ $message }}
                                        </p>
                                        @enderror
                                </div>

                                {{-- <div class="form-group col-md-4">
                                    <label for="inputCity">Stock Available </label>
                                    <input type="text" class="form-control @error('qty') is-invalid @enderror"
                                        value="{{@old('qty')}}" name="qty">
                                    @error('qty')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Enter Stock Available</strong>
                                    </span>
                                    @enderror
                                </div> --}}
  

                            

                                <div class="form-group col-md-4">
                                  <label for="parant" class="block  text-sm font-bold mb-2 sm:mb-4 ">
                                      Category
                                  </label>
                                  <select  
                                      required 
                                      class="form-control w-full border-gray-400" 
                                      name="cat"
                                      id="category"
                                  >

                                  <option value="">Select Category</option>

                             
                                      @foreach ($mcategories as $item)
                                      <option 
                                      
                                      @if (old('cat') == $item->id)
                                          selected
                                      @endif
                                      
                                      value="{{$item->id}}">{{$item->name}}</option>
                                      @endforeach
                                      
                                  </select>
                              </div>

                              <div class="form-group col-md-4">
                                  <label for="parant" class="block  text-sm font-bold mb-2 sm:mb-4 ">
                                      Sub Category
                                  </label>
                                  <select id="subcat" class="form-control w-full border-gray-400" name="subcat">
                             
                                     
                                      <option value="">Sub Category </option>
                                    
                                      
                                  </select>
                              </div>

                              <div class="form-group col-md-4">
                                <label for="inputCity">Image</label>
                                <input type="file" class="form-control-file  @error('cover') is-invalid @enderror"
                                    id="exampleFormControlFile1" accept="image/x-png,image/gif,image/jpeg,image/jpg"  name="cover" value="{{@old('cover')}}">
                                @error('cover')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>


                                
                            </div>


                            <div class="row">
                              

                             

                            <div class="form-group col-md-4">
                                  <label for="unit" class="block  text-sm font-bold mb-2 sm:mb-4 ">
                                      Unit
                                  </label>
                                  <select  
                                      required 
                                      class="form-control w-full border-gray-400" 
                                      name="unit_id"
                                      id="unit_id"
                                  >

                                  

                             
                                      @foreach ($units as $item)
                                      <option 
                                      
                                      @if (old('unit_id') == $item->id)
                                          selected
                                      @endif
                                      
                                      value="{{$item->id}}">{{$item->unit_name}}</option>
                                      @endforeach
                                      
                                  </select>
                              </div>


                              <div class="form-group col-md-4">
                                <label for="punit_id" class="block  text-sm font-bold mb-2 sm:mb-4 ">
                                    Purchase Unit
                                </label>
                                <select  
                                    required 
                                    class="form-control w-full border-gray-400" 
                                    name="punit_id"
                                    id="punit_id"
                                >

                                <option value="">Choose Purchase Unit</option>

                           
                                    @foreach ($units as $item)
                                    <option 
                                    
                                    @if (old('cat') == $item->id)
                                        selected
                                    @endif
                                    
                                    value="{{$item->id}}">{{$item->unit_name}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
 

                                


                                

                           

                             
                     
                                


                          
 
                            </div>


                            


 
 
                      
                         

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Description</label>
                                <textarea class="summernote" name="body" rows="3">{{@old('body')}}</textarea>
                            </div>

                            
 
 

                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>





                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection







@section('script')
 
<script type="text/javascript">
//text editor
$('.summernote').summernote({
    tabsize: 2,
    height: 200
});
//get subcat
$('#category').change(function() {
    var category = this.value;
    if (this.value) {
        $.ajax({
            type: 'GET',
            url: "/pgetsubcategory/" + category,
            success: function(res) {
                if (res.length == 0) {
                    
                    $('#subcat').empty();
                    $('#subcat').append('<option value="">No Sub category found</option>')
                } else {
                    $('#subcat').empty();
                    $('#subcat').append('<option value="">Select Sub Category</option>')
                    res.map(subcat => {
                        //console.log(subcat);
                        
                        $('#subcat').append('<option value="' + subcat.id + '">' + subcat.name + '</option>')
                    })
                }
            }
        })
    }
});
 

 

 
</script>

@endsection