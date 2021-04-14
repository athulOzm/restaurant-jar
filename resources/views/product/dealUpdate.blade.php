@extends('store.layouts.master')

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
                        <h6 class="m-0 font-weight-bold text-primary">Create Deal</h6>
 
                        
                    </div>
                    <div class="card-body">





                        <form action="{{ route('store.product.put') }}" method="post" enctype='multipart/form-data'>
                            @csrf
                            @method('PUT')

                            <input type="hidden" value="{{$product->id}}" name="id">
                            <input type="hidden" value="{{$product->image}}" name="curimage">
                            <input type="hidden"  value="1000" name="coupons">


                         
                         


                            <div class="row">

                                <div class="form-group col-md-4">
                                    <label for="inputCity">Category *</label>
                                    <select id="inputState" class="form-control @error('category') is-invalid @enderror"
                                        name="category">
                                        <option selected value="{{$product->category->id}}">{{$product->category->name}}</option>
                                        @foreach(resolve('storebind')['categories'] as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>

                                    @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Please choose the Category</strong>
                                    </span>
                                    @enderror
                                </div>

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
                                    <label for="inputCity">Price </label>
                                    <input type="text" class="form-control @error('price') is-invalid @enderror"
                                        value="{{$product->price}}" name="price">
                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Enter Price eg(55.600)</strong>
                                    </span>
                                    @enderror
                                </div>

                                

                                
                            </div>

                            <div class="row">

                            <div class="form-group col-md-4">
                                    <label for="inputCity">Deal (%) *</label>
                                    <input type="text" class="form-control @error('deal') is-invalid @enderror"
                                        value="{{$product->deal}}" name="deal">
                                    @error('deal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Please enter deal (eg:15.50)%</strong>
                                    </span>
                                    @enderror
                                </div>


                                
                            <div class="form-group col-md-4">
                                    <label for="inputCity">Other Offer </label>
                                    <input type="text" class="form-control" value="{{$product->deal2}}" name="deal2">
                                     
                                </div>

                                
 

                                <!-- <div class="form-group col-md-4">
                                    <label for="inputCity">Start Date *</label>
                                    <input type="text"
                                        class="form-control datepicker sd @error('date_from') is-invalid @enderror"
                                        name="date_from"
                                         autocomplete="off" >
                                    @error('date_from')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="inputCity">End Date *</label>
                                    <input type="text"
                                        class="form-control ed datepicker  @error('date_to') is-invalid @enderror"
                                        name="date_to" autocomplete="off"  >
                                    @error('date_to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div> -->

                                <div class="form-group col-md-4">
                                    <label for="inputCity">Brand </label>
                                    <select id="inputState" class="form-control" name="brand">
                                        <option selected value="">Choose...</option>
                                        @if($product->brand_id != '')
                                        <option selected value="{{$product->brand_id}}">{{$product->brand->name}}</option>
                                    @endif

                                        @foreach(resolve('storebind')['brands'] as $brand)
                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                        @endforeach
                                    </select>
                                </div>


                            </div>


                            


                            <div class="row">


                                

                                <div class="form-group col-md-4">
                                    <label for="inputCity">Cover Image *</label>
                                    <input type="file" class="form-control-file  @error('image') is-invalid @enderror"
                                        id="exampleFormControlFile1" accept="image/x-png,image/gif,image/jpeg,image/jpg"  name="image" value="{{@old('image')}}">
                                    @error('image')
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

                                <!-- <div class="form-group col-md-3">
                                    <label for="inputCity">Location</label>
                                    <select id="inputState" class="form-control" name="location">

                                    <option selected value="">Choose...</option>

                                    @if($product->location_id != '')
                                        <option selected value="{{$product->location_id}}">{{$product->location->name}}</option>
                                    @endif

                                        @foreach(resolve('publicbind')['locations'] as $location)
                                        <option value="{{$location->id}}">{{$location->name}}</option>
                                        @endforeach
                                    </select>
                                </div> -->

                                

                            </div>

<!-- 
                            <div class="row">

                                <div class="form-group col-md-2">
                                    <label for="inputCity">Title Color</label>
                                    <input type="color" value="@if($product->color){{$product->color->title}}@else{{'#000'}}@endif" id="colorPicker" name="title">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputCity">Button Color</label>
                                    <input type="color" value="@if($product->color){{$product->color->button}}@else{{'#514095'}}@endif"  name="button">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputCity">Sub Title</label>
                                    <input type="color" value="@if($product->color){{$product->color->title2}}@else{{'#514095'}}@endif"  name="title2">
                                </div>

                            </div> -->

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="inputCity">Cover Image</label>
                                <div class="row">
                                    <div class="col-md-9">
                                    <img class="img-thumbnail " src="{{@resolve(storebind)['storepath']}}{{ $product->image}}" />
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

                                <textarea class="summernote" name="body" rows="3">
                                {{$product->body}}
                                </textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Terms & Condition</label>

                                <textarea class="summernote" name="tc" rows="3">{{$product->tc}}</textarea>
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

//datepicker
$(".datepicker").datepicker({
    minDate: 0,
    //setDate: 'today',
    dateFormat: 'yy/mm/dd'
});




$(".sd").datepicker('setDate', new Date('{{@str_replace('-', ',', $product->deal_start)}}'));
$(".ed").datepicker('setDate', new Date('{{@str_replace('-', ',', $product->deal_end)}}'));


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
        url: '/store/product/images/' + {{$product->id}},
        success: function(res){

            console.log(res)
            
            if(res == 0){

                $('#displayImages').empty();
            }
            else{
                $('#displayImages').empty();
                const imgPath = '{{@resolve(storebind)['storepath']}}';
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
        url: `/store/product/images/${img}`,
        data: {
            "id": 'hgfd',
            "_token": token,
        },
        success: function(){
            getImages();
        }
    });
}




</script>

@endsection