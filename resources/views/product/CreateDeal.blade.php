@extends('store.layouts.master')

@section('head', 'create deal')

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
                        <h6 class="m-0 font-weight-bold text-primary">Create Deal</h6>


                    </div>
                    <div class="card-body">





                        <form action="{{ route('store.storedeal') }}" method="post" enctype='multipart/form-data'>

                        <input type="hidden"  value="1000" name="coupons">
                            @csrf



                            <div class="row">

                                <div class="form-group col-md-4">
                                    <label for="inputCity">Category *  </label>
                                    <a href="/store/categories" style="float:right;font-size: 11px;line-height: 28px;">(Create new Category)</a>
                                    <select id="inputState" class="form-control @error('category') is-invalid @enderror"
                                        name="category">
                                        <option selected value="0">Choose...</option>
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
                                    <input type="text" value="{{@old('name')}}"
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
                                        value="{{@old('price')}}" name="price">
                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Enter Price eg(55.60)</strong>
                                    </span>
                                    @enderror
                                </div>

                                

                                
                            </div>

                            <div class="row">

                                <div class="form-group col-md-4">
                                    <label for="inputCity">If any Offer Price (%) </label>
                                    <input type="text" class="form-control @error('deal') is-invalid @enderror"
                                        value="{{@old('deal')}}" name="deal">
                                    @error('deal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Offer Price (eg:15.50)%</strong>
                                    </span>
                                    @enderror
                                </div>

                                

                                <div class="form-group col-md-4">
                                    <label for="inputCity">Any Other Offer </label>
                                    <input type="text" class="form-control" name="deal2">
                                </div>
                             
                                <div class="form-group col-md-4">
                                    <label for="inputCity">Product Brand </label>
                                    <a href="/store/brands" style="float:right;font-size: 11px;line-height: 28px;">(Create Brand)</a>
                                    <select id="inputState" class="form-control" name="brand">
                                        <option selected value="">Choose...</option>
                                        @foreach(resolve('storebind')['brands'] as $brand)
                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- <div class="form-group col-md-4">
                                    <label for="inputCity">Start Date *</label>
                                    <input type="text"
                                        class="form-control datepicker @error('date_from') is-invalid @enderror"
                                        name="date_from" 
                                        autocomplete="off"
                                        value="{{@old('date_from')}}">
                                    @error('date_from')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="inputCity">End Date *</label>
                                    <input 
                                        type="text"
                                        class="form-control datepicker  @error('date_to') is-invalid @enderror"
                                        name="date_to" 
                                        autocomplete="off"
                                        value="{{@old('date_to')}}">
                                    @error('date_to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div> -->


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

                                

                            </div>


                            <!-- <div class="row">

                                <div class="form-group col-md-2">
                                    <label for="inputCity">Title Color</label>
                                    <input type="color" value="#000" id="colorPicker" name="title">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputCity">Button Color</label>
                                    <input type="color" value="#514095"  name="button">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputCity">Sub Title</label>
                                    <input type="color" value="#514095"  name="title2">
                                </div>

                            </div> -->

                         

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Description</label>

                                <textarea class="summernote" name="body" rows="3">{{@old('body')}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Terms & Condition</label>

                                <textarea class="summernote" name="tc" rows="3">{{@old('tc')}}</textarea>
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