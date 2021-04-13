@extends('admin.layouts.master')

@section('head', 'Update Store')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/wickedpicker@0.4.3/dist/wickedpicker.min.js"></script>
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
 
    <form method="POST" action='{{ url(route("admin.store.storeUpdateStore")) }}' aria-label="{{ __('Register') }}"
    enctype="multipart/form-data"
    >
   
        @csrf
        @method('PUT')

        <input type="hidden" value="{{$store->id}}" name="id">
        <input type="hidden" value="{{$store->logo}}" name="curimage">
        <input type="hidden" value="{{$store->domain}}" name="curdomain">

        
        
        

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Agent*</label>

                            <div class="col-md-6">
                               
                            <select  id="agent" require name="agent" class="form-control @error('agent') is-invalid @enderror">
                                        <option value="{{$store->agent_id}}" selected>{{$store->agent->name}}</option>
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
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$store->name}}"   autofocus>

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
                                <input id="name" type="text" class="form-control @error('domain') is-invalid @enderror" name="domain" value="{{$store->domain}}"   autofocus>

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
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$store->email}}"   >

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row" style="background: #e7e7e7;padding: 5px 0;">
                            <label for="password" class="col-md-4 col-form-label text-md-right">
                                Change Password (Min 6 letter) <br>
                                <i style="color:#0d48ef">leave blank if you don't want to change Password</i>
                            </label>

                            <div class="col-md-6">
                                <input style="margin-top: 13px;"  id="password" type="password" class="form-control" name="password" autocomplete="off">
 
                            </div>
                        </div>

                        


                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">Phone Number</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{$store->phone}}"   >

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="{{$store->address}}"   >

                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">Location</label>

                            <div class="col-md-6">
                            <select id="inputState" class="form-control" name="location">

                            @if($store->location_id !='')

                            <option value="{{$store->location_id}}" selected>{{$store->location->name}}</option>

                            @endif

                                        <option  value="">Choose...</option>
                                        @foreach(resolve('adminbind')['locations'] as $location)
                                        <option value="{{$location->id}}">{{$location->name}}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Store Timing</label>

                            <div class="col-md-6">

                            @if($store->store_times->contains('day', 'monday'))
                            <div class="row pb10">
                                    <div class="col-md-3">
                                        <div class="form-check pb10">
                                            <input type="checkbox" name="days[]" checked value="monday" class="form-check-input" id="exampleCheck1"> Monday 
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text"  name="mondayf" class="form-control mf"/>
                                    </div>
                                    <div class="col-md-1">to</div>
                                    <div class="col-md-3">
                                        <input type="text" name="mondayt" class="form-control mt"/>
                                    </div>
                                </div>
                                <script>
                                $('.mf').wickedpicker({now: "{{$store->store_time('monday')['timef'] }}"});
                                $('.mt').wickedpicker({now: "{{$store->store_time('monday')['timet'] }}"});
                                </script>
                            @else
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
                            @endif





                            @if($store->store_times->contains('day', 'tuesday'))
                            <div class="row pb10">
                                    <div class="col-md-3">
                                        <div class="form-check pb10">
                                            <input type="checkbox" name="days[]" checked value="tuesday" class="form-check-input" id="exampleCheck1"> Tuesday
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text"  name="tuesdayf" class="form-control tf"/>
                                    </div>
                                    <div class="col-md-1">to</div>
                                    <div class="col-md-3">
                                        <input type="text" name="tuesdayt" class="form-control tt"/>
                                    </div>
                                </div>
                                <script>
                                $('.tf').wickedpicker({now: "{{$store->store_time('tuesday')['timef'] }}"});
                                $('.tt').wickedpicker({now: "{{$store->store_time('tuesday')['timet'] }}"});
                                </script>
                            @else
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
                            @endif






                            @if($store->store_times->contains('day', 'wednesday'))
                            <div class="row pb10">
                                    <div class="col-md-3">
                                        <div class="form-check pb10">
                                            <input type="checkbox" name="days[]" checked value="wednesday" class="form-check-input" id="exampleCheck1"> Wednesday
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text"  name="wednesdayf" class="form-control wf"/>
                                    </div>
                                    <div class="col-md-1">to</div>
                                    <div class="col-md-3">
                                        <input type="text" name="wednesdayt" class="form-control wt"/>
                                    </div>
                                </div>
                                <script>
                                $('.wf').wickedpicker({now: "{{$store->store_time('wednesday')['timef'] }}"});
                                $('.wt').wickedpicker({now: "{{$store->store_time('wednesday')['timet'] }}"});
                                </script>
                            @else
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
                            @endif



                            @if($store->store_times->contains('day', 'thursday'))
                            <div class="row pb10">
                                    <div class="col-md-3">
                                        <div class="form-check pb10">
                                            <input type="checkbox" name="days[]" checked value="thursday" class="form-check-input" id="exampleCheck1"> Thursday 
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text"  name="thursdayf" class="form-control thf"/>
                                    </div>
                                    <div class="col-md-1">to</div>
                                    <div class="col-md-3">
                                        <input type="text" name="thursdayt" class="form-control tht"/>
                                    </div>
                                </div>
                                <script>
                                $('.thf').wickedpicker({now: "{{$store->store_time('thursday')['timef'] }}"});
                                $('.tht').wickedpicker({now: "{{$store->store_time('thursday')['timet'] }}"});
                                </script>
                            @else
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
                            @endif



                            @if($store->store_times->contains('day', 'friday'))
                            <div class="row pb10">
                                    <div class="col-md-3">
                                        <div class="form-check pb10">
                                            <input type="checkbox" name="days[]" checked value="friday" class="form-check-input" id="exampleCheck1"> Friday
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text"  name="fridayf" class="form-control ff"/>
                                    </div>
                                    <div class="col-md-1">to</div>
                                    <div class="col-md-3">
                                        <input type="text" name="fridayt" class="form-control ft"/>
                                    </div>
                                </div>
                                <script>
                                $('.ff').wickedpicker({now: "{{$store->store_time('friday')['timef'] }}"});
                                $('.ft').wickedpicker({now: "{{$store->store_time('friday')['timet'] }}"});
                                </script>
                            @else
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
                            @endif



                            @if($store->store_times->contains('day', 'saturday'))
                            <div class="row pb10">
                                    <div class="col-md-3">
                                        <div class="form-check pb10">
                                            <input type="checkbox" name="days[]" checked value="saturday" class="form-check-input" id="exampleCheck1"> Saturday
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text"   name="saturdayf" class="form-control sf"/>
                                    </div>
                                    <div class="col-md-1">to</div>
                                    <div class="col-md-3">
                                        <input type="text" name="saturdayt" class="form-control st"/>
                                    </div>
                                </div>
                                <script>
                                $('.sf').wickedpicker({now: "{{$store->store_time('saturday')['timef'] }}"});
                                $('.st').wickedpicker({now: "{{$store->store_time('saturday')['timet'] }}"});
                                </script>
                            @else
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
                            @endif



                            @if($store->store_times->contains('day', 'sunday'))
                            <div class="row pb10">
                                    <div class="col-md-3">
                                        <div class="form-check pb10">
                                            <input type="checkbox" name="days[]" checked value="sunday" class="form-check-input" id="exampleCheck1"> Sunday
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text"  name="sundayf" class="form-control suf"/>
                                    </div>
                                    <div class="col-md-1">to</div>
                                    <div class="col-md-3">
                                        <input type="text" name="sundayt" class="form-control sut"/>
                                    </div>
                                </div>
                                <script>
                                $('.suf').wickedpicker({now: "{{$store->store_time('sunday')['timef'] }}"});
                                $('.sut').wickedpicker({now: "{{$store->store_time('sunday')['timet'] }}"});
                                </script>
                            @else
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
                            @endif



                            

                     
 

                                
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Description</label>
                            <div class="col-md-6">
                                <textarea id="summernote" name="des" rows="3">{{$store->description}}</textarea>
                            </div>
                        </div>
 
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Location(latitude and longitude)</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="map" value="{{$store->map}}">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Image (300px * 80px)</label>
                            
                            <div class="col-md-3">
                                <input type="file" name="image" id="" class="form-control  ">
                            
                            </div>

                            <div class="col-md-3">
                                <img src="/storage/uploads/images/{{$store->logo}}" alt="">
                            
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>


                    </form>
                </div>
         
    </div>
</div>
@endsection


@section('script')


<script>
$('#summernote').summernote({
    tabsize: 2,
    height: 200
});

$('.timepickerf').wickedpicker({
    now: "8:00"
});

$('.timepickert').wickedpicker({
    now: "20:00"
});
</script>
@endsection