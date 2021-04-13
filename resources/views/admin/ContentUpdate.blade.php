@extends('admin.layouts.master')

@section('head', 'Update Content')

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
                        <h6 class="m-0 font-weight-bold text-primary">Update Page</h6>


                    </div>
                    <div class="card-body">





                        <form action="{{ route('admin.content.updStore') }}" method="post" enctype='multipart/form-data'>
                        @method('PUT')
                        <input type="hidden" name="id" value="{{$content->id}}">
                        <input type="hidden" name="img" value="{{$content->image}}">


                        
                            @csrf

                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="inputCity">Parant Page</label>
                                    <select id="parant" name="parant" class="form-control">
                                    @if($content->parant_id != 0)
                                    <option selected value="{{$content->parant_id}}">Main Page</option>
                                    @endif
                                        <option value="0">Main Page</option>
                                        @foreach($pages as $page)
                                        <option value="{{$page->id}}">{{$page->title}}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group col-md-5">
                                    <label for="inputCity">Title *</label>
                                    <input type="text" value="{{$content->title}}"
                                        class="form-control @error('title') is-invalid @enderror" name="title">
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="inputCity">Cover Image </label>
                                    <input type="file" class="form-control-file  @error('image') is-invalid @enderror"
                                        id="exampleFormControlFile1" accept="image/x-png,image/gif,image/jpeg,image/jpg"  name="image" value="{{$content->image}}">
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-1">
                                    <label for="inputCity">Order</label>
                                    <input placeHolder="0" type="text" value="{{$content->pos}}"
                                        class="form-control " name="pos">
                                  
                                </div>


                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Sub Title </label>

                                <textarea name="description" class="form-control" rows="3">{{$content->description}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Body</label>

                                <textarea class="summernote" name="body" rows="3">{{$content->body}}</textarea>
                            </div>

                            <div class="form-check">
@if($content->status)
<input type="checkbox" class="form-check-input" name="status" checked id="exampleCheck1">
@else
<input type="checkbox" class="form-check-input" name="status" id="exampleCheck1">
@endif

    


    <label class="form-check-label"  for="exampleCheck1">Add to Menu</label>
  </div>
  <br>

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
$('.summernote').summernote({
    tabsize: 2,
    height: 400
});
</script>


@endsection