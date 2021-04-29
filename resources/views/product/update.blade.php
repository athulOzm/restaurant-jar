
<?php
$mcategories = resolve('mcategories');
$menutypes = resolve('menutypes');

?>
@extends('admin.layouts.master')

@section('head', 'create deal')

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
<div class="container" style="height: 90vh;">
    <div class="card-body p-0">
        <div class="row">



            <div class="col-md-12">
                <div class="card shadow mb-12" style="width:100%">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Update Product</h6>
 
                        
                    </div>
                    <div class="card-body">





                        <form action="{{ route('product.update') }}" method="post" enctype='multipart/form-data'>
                            @csrf
                            @method('PATCH')

                            <input type="hidden" value="{{$product->id}}" name="id">
                            <input type="hidden" value="{{$product->cover}}" name="curimage">
                      


                         
                         


                            <div class="row">

                                


                                <div class="form-group col-md-4">
                                    <label for="inputCity">Product Name *</label>
                                    <input type="text" value="{{$product->name}}"
                                        class="form-control @error('name') is-invalid @enderror" name="name">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

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
                               
                                        @foreach ($mcategories as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
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

                                

                                

                                

                                
                            </div>

                       


                            <div class="row">

                                <div class="form-group col-md-4">
                                    <label for="inputCity">Price </label>
                                    <input type="text" class="form-control @error('price') is-invalid @enderror"
                                        value="{{$product->price}}" name="price">
                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Enter Price eg(55.60)</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="inputCity">Quantity </label>
                                    <input type="text" class="form-control @error('qty') is-invalid @enderror"
                                        value="{{$product->getAvailableQty()}}" name="qty">
                                    @error('qty')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Enter Price eg(55.60)</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="inputCity">Menu Type  </label>
                                     
                                    <label class="flex flex-col items-center mt-3">

                                        @foreach($menutypes as $type)
                                        <div>
                                            <input type="checkbox" class="form-checkbox h-5 w-5 text-gray-600" value="{{$type->id}}" name="type[]">
                                            <span class="ml-2 text-gray-700">{{$type->name}}</span>
                                        </div>
                                        @endforeach

                                        
                                    </label>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputCity">Status  </label>
                                     
                                    <label class="flex flex-row items-center mt-3">

                                     
                                        <div>
                                            <input type="radio" class="form-checkbox h-5 w-5 text-gray-600" value="1" @if($product->status) checked @endif  name="status">
                                            <span class="ml-2 text-gray-700">Enabled</span>
                                        </div>

                                        <div>
                                            <input type="radio" class="form-checkbox h-5 w-5 text-gray-600" value="0" @if(!$product->status) checked @endif name="status">
                                            <span class="ml-2 text-gray-700">Desabled</span>
                                        </div>
                                  

                                        
                                    </label>
                                </div>

                            </div>

                            <div class="row">

                                


                                

                                <div class="form-group col-md-4">
                                    <label for="inputCity">Cover Image *</label>
                                    <input type="file" class="form-control-file  @error('cover') is-invalid @enderror"
                                        id="exampleFormControlFile1" accept="image/x-png,image/gif,image/jpeg,image/jpg"  name="cover" value="{{@old('cover')}}">
                                    @error('cover')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="inputCity">Gallery Images</label>
                                    <input type="file" class="form-control-file  @error('images') is-invalid @enderror"
                                        id="exampleFormControlFile1" multiple  accept="image/x-png,image/gif,image/jpeg,image/jpg"  name="images[]" value="{{@old('images')}}">
                                    @error('images')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>

                             

                                

                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="inputCity">Cover Image</label>
                                <div class="row">
                                    <div class="col-md-9">
                                        @if ($product->cover != null)
                                    <img class="img-thumbnail " src="{{env('IMAGE_PATH')}}{{ $product->cover}}" />
                                    @endif
                                    </div>
                                </div>
                                    </div>
                                    <div class="col-md-6">
                                    <label for="inputCity">Gallery Images</label>
                                <div class="row" id="displayImages"></div>
                                    </div>

                                </div>
                                

                                

                            </div>


                      
                         

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Description</label>

                                <textarea class="summernote" name="body" rows="3">{{@old('body')}}</textarea>
                            </div>
 

                            <button type="submit" class="btn btn-primary">Update</button>
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

// //datepicker
// $(".datepicker").datepicker({
//     minDate: 0,
//     //setDate: 'today',
//     dateFormat: 'yy/mm/dd'
// });




// $(".sd").datepicker('setDate', new Date('{{@str_replace('-', ',', $product->deal_start)}}'));
// $(".ed").datepicker('setDate', new Date('{{@str_replace('-', ',', $product->deal_end)}}'));


//text editor
$('.summernote').summernote({
    tabsize: 2,
    height: 200
});


//display Images
$(document).ready(() => {
    getImages();
});


const getImages = () => {
        $.ajax({
        type: 'GET',
        url: '/product/images/' + {{$product->id}},
        success: function(res){

            console.log(res)
            
            if(res == 0){

                $('#displayImages').empty();
            }
            else{
                $('#displayImages').empty();
                const imgPath = '{{env('IMAGE_PATH')}}';
                res.map(image => {
                    $('#displayImages').append(`<div class="col-md-3">
                    <img class="img-thumbnail" src="${imgPath + image.name}">
                    <buton class="btn btn-danger btn-circle btn-sm" onClick="removeImg(${image.id})"><i class="fas fa-trash"></i></buton>
                    </div>`);
                })
            }
        }
    });
};

const removeImg = (img) => {

    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        type: 'DELETE',
        url: `/product/images/${img}`,
        data: {
            "id": 'hgfd',
            "_token": token,
        },
        success: function(){
            getImages();
        }
    });
}

//get subcat
$('#category').change(function() {
    var category = this.value;
    if (this.value) {
        $.ajax({
            type: 'GET',
            url: "/getsubcategory/" + category,
            success: function(res) {
                if (res.length == 0) {
                    
                    $('#subcat').empty();
                    $('#subcat').append('<option value="">No Sub category found</option>')
                } else {
                    $('#subcat').empty();
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