
<?php
$mcategories = resolve('mcategories');
$menutypes = resolve('menutypes');

?>

@extends('admin.layouts.master')

@section('head', 'create Product')

@section('content')



<!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.css" rel="stylesheet">
<!-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.js"></script> -->


<div class="container" style="height: 90vh;">
    <div class="card-body p-0">
        <div class="row">



            <div class="col-md-12">
                <div class="card shadow mb-12" style="width:100%">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Create Product</h6>


                    </div>
                    <div class="card-body">





                        <form action="{{ route('product.store') }}" method="post" enctype='multipart/form-data'>

                        <input type="hidden"  value="1000" name="coupons">
                            @csrf



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

                                <div class="form-group col-md-2">
                                    <label for="inputCity">Price </label>
                                    <input type="text" class="form-control @error('price') is-invalid @enderror"
                                        value="{{@old('price')}}" name="price">
                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Enter Price eg(55.60)</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="parant" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                                        Category
                                    </label>
                                    <select  required class="form-control w-full border-gray-400" name="parant">
                               
                                        @foreach ($mcategories as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="parant" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 ">
                                        Sub Category
                                    </label>
                                    <select  required class="form-control w-full border-gray-400" name="parant">
                               
                                       
                                        <option >select </option>
                                      
                                        
                                    </select>
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

                                <div class="form-group col-md-4">
                                    <label for="inputCity">Menu Type  </label>
                                     
                                    <label class="flex flex-col items-center mt-3">

                                        @foreach($menutypes as $type)
                                        <div>
                                            <input type="checkbox" class="form-checkbox h-5 w-5 text-gray-600" value="{{$type->id}}" name="cat[]">
                                            <span class="ml-2 text-gray-700">{{$type->name}}</span>
                                        </div>
                                        @endforeach

                                        
                                    </label>
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



//datepicker
$(".datepicker").datepicker({
    minDate: 0,
});

//text editor
$('.summernote').summernote({
    tabsize: 2,
    height: 200
});





//color picker
document.querySelectorAll('input[type=color]').forEach(function(picker) {

    var targetLabel = document.querySelector('label[for="' + picker.id + '"]');
    codeArea = document.createElement('span');

    codeArea.innerHTML = picker.value;
    targetLabel.appendChild(codeArea);

    picker.addEventListener('change', function() {
        codeArea.innerHTML = picker.value;
        targetLabel.appendChild(codeArea);
    });
});
</script>

@endsection