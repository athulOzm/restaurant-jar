@extends('admin.layouts.master')

@section('head', 'Create Store')


@section('content')


<style>
.wickedpicker {
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  box-shadow: 0 0 0 1px rgba(14, 41, 57, 0.12), 0 2px 5px rgba(14, 41, 57, 0.44), inset 0 -1px 2px rgba(14, 41, 57, 0.15);
  background: #fefefe;
  margin: 0 auto;
  border-radius: 0.1px;
  width: 270px;
  height: 130px;
  font-size: 14px;
  display: none; }
  .wickedpicker__title {
    background-image: -webkit-linear-gradient(top, #ffffff 0%, #f2f2f2 100%);
    background-image: linear-gradient(to bottom, #ffffff 0%, #f2f2f2 100%);
    position: relative;
    background: #f2f2f2;
    margin: 0 auto;
    border-bottom: 1px solid #e5e5e5;
    padding: 12px 11px 10px 15px;
    color: #4C4C4C;
    font-size: inherit; }
  .wickedpicker__close {
    -webkit-transform: translateY(-25%);
    -moz-transform: translateY(-25%);
    -ms-transform: translateY(-25%);
    -o-transform: translateY(-25%);
    transform: translateY(-25%);
    position: absolute;
    top: 25%;
    right: 10px;
    color: #34495e;
    cursor: pointer; }
    .wickedpicker__close:before {
      content: '\00d7'; }
  .wickedpicker__controls {
    padding: 10px 0;
    line-height: normal;
    margin: 0; }
    .wickedpicker__controls__control, .wickedpicker__controls__control--separator {
      vertical-align: middle;
      display: inline-block;
      font-size: inherit;
      margin: 0 auto;
      width: 35px;
      letter-spacing: 1.3px; }
      .wickedpicker__controls__control-up, .wickedpicker__controls__control-down {
        color: #34495e;
        position: relative;
        display: block;
        margin: 3px auto;
        font-size: 18px;
        cursor: pointer; }
      .wickedpicker__controls__control-up:before {
        content: '⬆'; }
      .wickedpicker__controls__control-down:after {
        content: '⬇'; }
      .wickedpicker__controls__control--separator {
        width: 5px; }

.text-center, .wickedpicker__title, .wickedpicker__controls, .wickedpicker__controls__control, .wickedpicker__controls__control--separator, .wickedpicker__controls__control-up, .wickedpicker__controls__control-down {
  text-align: center; }

.hover-state {
  color: #3498db; }

  .pb10{padding-top:10px}
</style>



<div class="container">
 
            <div class="card">
            <div class="card-header"> Create Store</div>

<div class="card-body">
 
    <form method="POST" action='{{ url(route("admin.store.store")) }}' aria-label="{{ __('Register') }}" 
    enctype="multipart/form-data"
    >
   
        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Agent*</label>

                            <div class="col-md-6">
                               
                            <select  id="agent" require name="agent" class="form-control @error('agent') is-invalid @enderror">
                                        <option value="" selected>Choose...</option>
                                        @foreach(resolve('adminbind')['agents'] as $agent)
                                        <option value="{{$agent->id}}">{{$agent->name}}</option>
                                        @endforeach
                                    </select>

                                @error('agent')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}*</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"   autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Domain*</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('domain') is-invalid @enderror" name="domain" value="{{ old('domain') }}"   autofocus>

                                @error('domain')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}*</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"   >

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        


                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">Phone Number</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}"   >

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">Location</label>

                            <div class="col-md-6">
                            <select id="inputState" class="form-control" name="location">
                                        <option selected value="">Choose...</option>
                                        @foreach(resolve('publicbind')['locations'] as $location)
                                        <option value="{{$location->id}}">{{$location->name}}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>


                       
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="">
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}*</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}*</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Store Timing</label>

                            <div class="col-md-6">

                                <div class="row pb10">
                                    <div class="col-md-3">
                                        <div class="form-check pb10">
                                            <input type="checkbox" name="days[]" value="monday" class="form-check-input" id="exampleCheck1"> Monday
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="mondayf" class="form-control timepickerf"/>
                                    </div>
                                    <div class="col-md-1">to</div>
                                    <div class="col-md-3">
                                        <input type="text" name="mondayt" class="form-control timepickert"/>
                                    </div>
                                </div>
                                
                                <div class="row pb10">
                                    <div class="col-md-3">
                                        <div class="form-check pb10">
                                            <input type="checkbox" name="days[]" value="tuesday" class="form-check-input" id="exampleCheck1"> Tuesday
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="tuesdayf" class="form-control timepickerf"/>
                                    </div>
                                    <div class="col-md-1">to</div>
                                    <div class="col-md-3">
                                        <input type="text" name="tuesdayt" class="form-control timepickert"/>
                                    </div>
                                </div>

                                <div class="row pb10">
                                    <div class="col-md-3">
                                        <div class="form-check pb10">
                                            <input type="checkbox" name="days[]" value="wednesday" class="form-check-input" id="exampleCheck1"> Wednesday
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="wednesdayf" class="form-control timepickerf"/>
                                    </div>
                                    <div class="col-md-1">to</div>
                                    <div class="col-md-3">
                                        <input type="text" name="wednesdayt" class="form-control timepickert"/>
                                    </div>
                                </div>

                                <div class="row pb10">
                                    <div class="col-md-3">
                                        <div class="form-check pb10">
                                            <input type="checkbox" name="days[]" value="thursday" class="form-check-input" id="exampleCheck1"> Thursday
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="thursdayf" class="form-control timepickerf"/>
                                    </div>
                                    <div class="col-md-1">to</div>
                                    <div class="col-md-3">
                                        <input type="text" name="thursdayt" class="form-control timepickert"/>
                                    </div>
                                </div>

                                <div class="row pb10">
                                    <div class="col-md-3">
                                        <div class="form-check pb10">
                                            <input type="checkbox" name="days[]" value="friday" class="form-check-input" id="exampleCheck1"> Friday
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="fridayf" class="form-control timepickerf"/>
                                    </div>
                                    <div class="col-md-1">to</div>
                                    <div class="col-md-3">
                                        <input type="text" name="fridayt" class="form-control timepickert"/>
                                    </div>
                                </div>

                                <div class="row pb10">
                                    <div class="col-md-3">
                                        <div class="form-check pb10">
                                            <input type="checkbox" name="days[]" value="saturday" class="form-check-input" id="exampleCheck1"> Saturday
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="saturdayf" class="form-control timepickerf"/>
                                    </div>
                                    <div class="col-md-1">to</div>
                                    <div class="col-md-3">
                                        <input type="text" name="saturdayt" class="form-control timepickert"/>
                                    </div>
                                </div>

                                <div class="row pb10">
                                    <div class="col-md-3">
                                        <div class="form-check pb10">
                                            <input type="checkbox" name="days[]" value="sunday" class="form-check-input" id="exampleCheck1"> Sunday
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="sundayf" class="form-control timepickerf"/>
                                    </div>
                                    <div class="col-md-1">to</div>
                                    <div class="col-md-3">
                                        <input type="text" name="sundayt" class="form-control timepickert"/>
                                    </div>
                                </div>
                            </div>

                        </div>


                        



                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Description</label>

                            <div class="col-md-6">
                                
                                <textarea id="summernote" name="des" rows="3">{{@old('description')}}</textarea>
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Location(latitude and longitude)</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="map" value="">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Image (300px * 80px)</label>

                            <div class="col-md-6">
                                <input type="file" name="image" id="" class="form-control @error('image') is-invalid @enderror">
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>


                    </form>
                </div>
         
    </div>
</div>

@endsection






@section('script')

<script src="https://cdn.jsdelivr.net/npm/wickedpicker@0.4.3/dist/wickedpicker.min.js"></script>

<script>
$('.timepickerf').wickedpicker({
    now: "8:30"
});

$('.timepickert').wickedpicker({
    now: "17:00"
});
  
//text editor
$('#summernote').summernote({
    tabsize: 2,
    height: 200
});
</script>
@endsection