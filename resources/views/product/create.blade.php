
<?php
$branches = resolve('branches');
$mcategories = resolve('mcategories');
$promotions = resolve('promotions');
$menutypes = resolve('menutypes');
$addons = resolve('addons');
$settings = resolve('settings');

?>

@extends('admin.layouts.master')

@section('head', 'Add Menu')

@section('content')



<!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.css" rel="stylesheet">
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
                        <h6 class="m-0 font-weight-bold text-primary">Add Menu</h6>


                    </div>
                    <div class="card-body">





                        <form action="{{ route('product.store') }}" method="post" enctype='multipart/form-data'>

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
                                    <label for="inputCity">Product Name Arabic</label>
                                    <input style="text-align: right" type="text" value="{{@old('name_ar')}}"
                                        class="form-control @error('name_ar') is-invalid @enderror" name="name_ar">
                                    @error('name_ar')
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
                                        value="{{ $settings->vat }}" required  autofocus>
            
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

                                <input type="hidden" name="qty" value="0">

                                <div class="form-group col-md-4">
                                  <label for="promotion">
                                      Promotion
                                  </label>
                                  <select  
                                      
                                      class="form-control w-full border-gray-400" 
                                      name="promotion"
                                      id="promotion"
                                  >
                                  <option value="">Select Promotion</option>
                                      @foreach ($promotions as $item)
                                      <option 
                                      @if (old('promotion') == $item->id)
                                          selected
                                      @endif
                                      value="{{$item->id}}">{{$item->name}}</option>
                                      @endforeach
                                  </select>
                                </div>


                                <div class="form-group col-md-4">
                                  <label for="addon">Categories</label>
                                      <select multiple data-multi-select-plugin name="cat[]" class="form-control w-full border-gray-400">
                                        @foreach ($mcategories as $item)
                                          <option @if (old('cat') == $item->id) selected @endif value="{{$item->name}}">{{$item->name}}</option>
                                        @endforeach
                                      </select>
                                </div>


                                
                            </div>


                            <div class="row">
                              

                              

                              <div class="form-group col-md-4">
                                <label for="addon">Addon</label>
                                    <select multiple data-multi-select-plugin name="addon[]" class="form-control w-full border-gray-400">
                                        @foreach ($addons as $addon)
                                            <option value="{{$addon['name']}}">addon</option>
                                        @endforeach
                                    </select>
                              </div>

                              {{-- <div class="form-group col-md-4">
                                <label for="branch">Branches</label>
                                    <select multiple data-multi-select-plugin name="branch[]" class="form-control w-full border-gray-400">
                                      @foreach ($branches as $item)
                                        <option @if (old('branch') == $item->id) selected @endif value="{{$item->name}}">{{$item->name}}</option>
                                      @endforeach
                                    </select>
                              </div> --}}

                              <input type="hidden" name="branch[]" value="1">


                            
                                {{-- <div class="form-group col-md-3">
                                    <label for="inputCity">Menu Type  </label>
                                     
                                    <label class="flex flex-col items-center mt-3">

                                        @foreach($menutypes as $type)
                                        <div>
                                            <input type="checkbox" class="form-checkbox h-5 w-5 text-gray-600" value="{{$type->id}}" name="type[]">
                                            <span class="ml-2 text-gray-700">{{$type->name}}</span>
                                        </div>
                                        @endforeach

                                        
                                    </label>
                                </div> --}}
                                <input type="hidden" name="type[]" value="1">


                                <div class="form-group col-md-4">
                                    <label for="inputCity">Status</label>
                                    <label class="flex flex-row items-center mt-3">
                                        <div>
                                            <input type="radio" class="form-checkbox h-5 w-5 text-gray-600" value="1" checked name="status">
                                            <span class="ml-2 text-gray-700">Enabled</span>
                                        </div>
                                        <div>
                                            <input type="radio" class="form-checkbox h-5 w-5 text-gray-600" value="0" name="status">
                                            <span class="ml-2 text-gray-700">Desabled</span>
                                        </div>
                                    </label>
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

                            <hr>

                            <div class="row"> 


                                <div class="form-group col-md-4">
                                  <label for="inputCity">Product Variant</label>


                                  <select class="form-control" name="variant" id="variantc">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                  </select>

                                  @error('cover')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{$message}}</strong>
                                  </span>
                                  @enderror
                              </div>
                              
                              <div class="form-group  col-md-8">
                                <div class="container" id="pass" style="background: #e7e7e7; border-radius:6px;display:none">

                                  <div class="row">
                                    <div class="form-group col-md-8">
                                      <label for="inputCity">Variant Name</label>
                                      <input type="text" value="S"
                                          class="form-control @error('v1_name') is-invalid @enderror" name="v1_name">
                                    </div>

                                    <div class="form-group col-md-4">
                                      <label for="inputCity">Price</label>
                                      <input type="text" class="form-control @error('v1_price') is-invalid @enderror"
                                        value="{{@old('v1_price')}}" name="v1_price">
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="form-group col-md-8">
                                      <label for="inputCity">Variant Name</label>
                                      <input type="text" value="M"
                                          class="form-control @error('v2_name') is-invalid @enderror" name="v2_name">
                                    </div>

                                    <div class="form-group col-md-4">
                                      <label for="inputCity">Price</label>
                                      <input type="text" class="form-control @error('v2_price') is-invalid @enderror"
                                        value="{{@old('v2_price')}}" name="v2_price">
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="form-group col-md-8">
                                      <label for="inputCity">Variant Name</label>
                                      <input type="text" value="L"
                                          class="form-control @error('v3_name') is-invalid @enderror" name="v3_name">
                                    </div>

                                    <div class="form-group col-md-4">
                                      <label for="inputCity">Price</label>
                                      <input type="text" class="form-control @error('v3_price') is-invalid @enderror"
                                        value="{{@old('v3_price')}}" name="v3_price">
                                    </div>
                                  </div>
                                  
                                </div>
                              </div>

                     
                                


                          


 

                                <input type="hidden" name="images">
                                {{-- <div class="form-group col-md-4">
                                    <label for="inputCity">Gallery Images</label>
                                    <input type="file" class="form-control-file  @error('images') is-invalid @enderror"
                                        id="exampleFormControlFile1" multiple  accept="image/x-png,image/gif,image/jpeg,image/jpg"  name="images[]" value="{{@old('images')}}">
                                    @error('images')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div> --}}

                            </div>


                            



                            {{-- <div class="form-group col-md-12">
                              <div class="row">
                                <label for="inputCity">Category</label>
                                <select  
                                    required 
                                    class="form-control w-full border-gray-400" 
                                    name="cat"
                                    id="category">
                                  <option value="">Select Category</option>
                                  @foreach ($mcategories as $item)
                                    <option @if (old('cat') == $item->id) selected @endif value="{{$item->id}}">{{$item->name}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div> --}}
 
 
                      
                         

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


$('#variantc').on('change', function() {

    
if(this.value == 1){
    $('#pass').css('display', 'block');
} else {

    $('#pass').css('display', 'none');

}

});


// Initialize function, create initial tokens with itens that are already selected by the user
function init(element) {
  // Create div that wroaps all the elements inside (select, elements selected, search div) to put select inside
  const wrapper = document.createElement("div");
  wrapper.addEventListener("click", clickOnWrapper);
  wrapper.classList.add("multi-select-component");

  // Create elements of search
  const search_div = document.createElement("div");
  search_div.classList.add("search-container");
  const input = document.createElement("input");
  input.classList.add("selected-input");
  input.setAttribute("autocomplete", "off");
  input.setAttribute("tabindex", "0");
  input.addEventListener("keyup", inputChange);
  input.addEventListener("keydown", deletePressed);
  input.addEventListener("click", openOptions);

  const dropdown_icon = document.createElement("a");
  dropdown_icon.setAttribute("href", "#");
  dropdown_icon.classList.add("dropdown-icon");

  dropdown_icon.addEventListener("click", clickDropdown);
  const autocomplete_list = document.createElement("ul");
  autocomplete_list.classList.add("autocomplete-list");
  search_div.appendChild(input);
  search_div.appendChild(autocomplete_list);
  search_div.appendChild(dropdown_icon);

  // set the wrapper as child (instead of the element)
  element.parentNode.replaceChild(wrapper, element);
  // set element as child of wrapper
  wrapper.appendChild(element);
  wrapper.appendChild(search_div);

  createInitialTokens(element);
  addPlaceholder(wrapper);
}

function removePlaceholder(wrapper) {
  const input_search = wrapper.querySelector(".selected-input");
  input_search.removeAttribute("placeholder");
}

function addPlaceholder(wrapper) {
  const input_search = wrapper.querySelector(".selected-input");
  const tokens = wrapper.querySelectorAll(".selected-wrapper");
  if (!tokens.length && !(document.activeElement === input_search))
    input_search.setAttribute("placeholder", "---------");
}

// Function that create the initial set of tokens with the options selected by the users
function createInitialTokens(select) {
  let { options_selected } = getOptions(select);
  const wrapper = select.parentNode;
  for (let i = 0; i < options_selected.length; i++) {
    createToken(wrapper, options_selected[i]);
  }
}

// Listener of user search
function inputChange(e) {
  const wrapper = e.target.parentNode.parentNode;
  const select = wrapper.querySelector("select");
  const dropdown = wrapper.querySelector(".dropdown-icon");

  const input_val = e.target.value;

  if (input_val) {
    dropdown.classList.add("active");
    populateAutocompleteList(select, input_val.trim());
  } else {
    dropdown.classList.remove("active");
    const event = new Event("click");
    dropdown.dispatchEvent(event);
  }
}

// Listen for clicks on the wrapper, if click happens focus on the input
function clickOnWrapper(e) {
  const wrapper = e.target;
  if (wrapper.tagName == "DIV") {
    const input_search = wrapper.querySelector(".selected-input");
    const dropdown = wrapper.querySelector(".dropdown-icon");
    if (!dropdown.classList.contains("active")) {
      const event = new Event("click");
      dropdown.dispatchEvent(event);
    }
    input_search.focus();
    removePlaceholder(wrapper);
  }
}

function openOptions(e) {
  const input_search = e.target;
  const wrapper = input_search.parentElement.parentElement;
  const dropdown = wrapper.querySelector(".dropdown-icon");
  if (!dropdown.classList.contains("active")) {
    const event = new Event("click");
    dropdown.dispatchEvent(event);
  }
  e.stopPropagation();
}

// Function that create a token inside of a wrapper with the given value
function createToken(wrapper, value) {
  const search = wrapper.querySelector(".search-container");
  // Create token wrapper
  const token = document.createElement("div");
  token.classList.add("selected-wrapper");
  const token_span = document.createElement("span");
  token_span.classList.add("selected-label");
  token_span.innerText = value;
  const close = document.createElement("a");
  close.classList.add("selected-close");
  close.setAttribute("tabindex", "-1");
  close.setAttribute("data-option", value);
  close.setAttribute("data-hits", 0);
  close.setAttribute("href", "#");
  close.innerText = "x";
  close.addEventListener("click", removeToken);
  token.appendChild(token_span);
  token.appendChild(close);
  wrapper.insertBefore(token, search);
}

// Listen for clicks in the dropdown option
function clickDropdown(e) {
  const dropdown = e.target;
  const wrapper = dropdown.parentNode.parentNode;
  const input_search = wrapper.querySelector(".selected-input");
  const select = wrapper.querySelector("select");
  dropdown.classList.toggle("active");

  if (dropdown.classList.contains("active")) {
    removePlaceholder(wrapper);
    input_search.focus();

    if (!input_search.value) {
      populateAutocompleteList(select, "", true);
    } else {
      populateAutocompleteList(select, input_search.value);
    }
  } else {
    clearAutocompleteList(select);
    addPlaceholder(wrapper);
  }
}

// Clears the results of the autocomplete list
function clearAutocompleteList(select) {
  const wrapper = select.parentNode;

  const autocomplete_list = wrapper.querySelector(".autocomplete-list");
  autocomplete_list.innerHTML = "";
}

// Populate the autocomplete list following a given query from the user
function populateAutocompleteList(select, query, dropdown = false) {
  const { autocomplete_options } = getOptions(select);

  let options_to_show;

  if (dropdown) options_to_show = autocomplete_options;
  else options_to_show = autocomplete(query, autocomplete_options);

  const wrapper = select.parentNode;
  const input_search = wrapper.querySelector(".search-container");
  const autocomplete_list = wrapper.querySelector(".autocomplete-list");
  autocomplete_list.innerHTML = "";
  const result_size = options_to_show.length;

  if (result_size == 1) {
    const li = document.createElement("li");
    li.innerText = options_to_show[0];
    li.setAttribute("data-value", options_to_show[0]);
    li.addEventListener("click", selectOption);
    autocomplete_list.appendChild(li);
    if (query.length == options_to_show[0].length) {
      const event = new Event("click");
      li.dispatchEvent(event);
    }
  } else if (result_size > 1) {
    for (let i = 0; i < result_size; i++) {
      const li = document.createElement("li");
      li.innerText = options_to_show[i];
      li.setAttribute("data-value", options_to_show[i]);
      li.addEventListener("click", selectOption);
      autocomplete_list.appendChild(li);
    }
  } else {
    const li = document.createElement("li");
    li.classList.add("not-cursor");
    li.innerText = "No options found";
    autocomplete_list.appendChild(li);
  }
}

// Listener to autocomplete results when clicked set the selected property in the select option
function selectOption(e) {
  const wrapper = e.target.parentNode.parentNode.parentNode;
  const input_search = wrapper.querySelector(".selected-input");
  const option = wrapper.querySelector(
    `select option[value="${e.target.dataset.value}"]`
  );

  option.setAttribute("selected", "");
  createToken(wrapper, e.target.dataset.value);
  if (input_search.value) {
    input_search.value = "";
  }

  input_search.focus();

  e.target.remove();
  const autocomplete_list = wrapper.querySelector(".autocomplete-list");

  if (!autocomplete_list.children.length) {
    const li = document.createElement("li");
    li.classList.add("not-cursor");
    li.innerText = "No options found";
    autocomplete_list.appendChild(li);
  }

  const event = new Event("keyup");
  input_search.dispatchEvent(event);
  e.stopPropagation();
}

// function that returns a list with the autcomplete list of matches
function autocomplete(query, options) {
  // No query passed, just return entire list
  if (!query) {
    return options;
  }
  let options_return = [];

  for (let i = 0; i < options.length; i++) {
    if (
      query.toLowerCase() === options[i].slice(0, query.length).toLowerCase()
    ) {
      options_return.push(options[i]);
    }
  }
  return options_return;
}

// Returns the options that are selected by the user and the ones that are not
function getOptions(select) {
  // Select all the options available
  const all_options = Array.from(select.querySelectorAll("option")).map(
    (el) => el.value
  );

  // Get the options that are selected from the user
  const options_selected = Array.from(
    select.querySelectorAll("option:checked")
  ).map((el) => el.value);

  // Create an autocomplete options array with the options that are not selected by the user
  const autocomplete_options = [];
  all_options.forEach((option) => {
    if (!options_selected.includes(option)) {
      autocomplete_options.push(option);
    }
  });

  autocomplete_options.sort();

  return {
    options_selected,
    autocomplete_options
  };
}

// Listener for when the user wants to remove a given token.
function removeToken(e) {
  // Get the value to remove
  const value_to_remove = e.target.dataset.option;
  const wrapper = e.target.parentNode.parentNode;
  const input_search = wrapper.querySelector(".selected-input");
  const dropdown = wrapper.querySelector(".dropdown-icon");
  // Get the options in the select to be unselected
  const option_to_unselect = wrapper.querySelector(
    `select option[value="${value_to_remove}"]`
  );
  option_to_unselect.removeAttribute("selected");
  // Remove token attribute
  e.target.parentNode.remove();
  input_search.focus();
  dropdown.classList.remove("active");
  const event = new Event("click");
  dropdown.dispatchEvent(event);
  e.stopPropagation();
}

// Listen for 2 sequence of hits on the delete key, if this happens delete the last token if exist
function deletePressed(e) {
  const wrapper = e.target.parentNode.parentNode;
  const input_search = e.target;
  const key = e.keyCode || e.charCode;
  const tokens = wrapper.querySelectorAll(".selected-wrapper");

  if (tokens.length) {
    const last_token_x = tokens[tokens.length - 1].querySelector("a");
    let hits = +last_token_x.dataset.hits;

    if (key == 8 || key == 46) {
      if (!input_search.value) {
        if (hits > 1) {
          // Trigger delete event
          const event = new Event("click");
          last_token_x.dispatchEvent(event);
        } else {
          last_token_x.dataset.hits = 2;
        }
      }
    } else {
      last_token_x.dataset.hits = 0;
    }
  }
  return true;
}

// You can call this function if you want to add new options to the select plugin
// Target needs to be a unique identifier from the select you want to append new option for example #multi-select-plugin
// Example of usage addOption("#multi-select-plugin", "tesla", "Tesla")
function addOption(target, val, text) {
  const select = document.querySelector(target);
  let opt = document.createElement("option");
  opt.value = val;
  opt.innerHTML = text;
  select.appendChild(opt);
}

document.addEventListener("DOMContentLoaded", () => {
  // get select that has the options available
  const select = document.querySelectorAll("[data-multi-select-plugin]");
  select.forEach((select) => {
    init(select);
  });

  // Dismiss on outside click
  document.addEventListener("click", () => {
    // get select that has the options available
    const select = document.querySelectorAll("[data-multi-select-plugin]");
    for (let i = 0; i < select.length; i++) {
      if (event) {
        var isClickInside = select[i].parentElement.parentElement.contains(
          event.target
        );

        if (!isClickInside) {
          const wrapper = select[i].parentElement.parentElement;
          const dropdown = wrapper.querySelector(".dropdown-icon");
          const autocomplete_list = wrapper.querySelector(".autocomplete-list");
          //the click was outside the specifiedElement, do something
          dropdown.classList.remove("active");
          autocomplete_list.innerHTML = "";
          addPlaceholder(wrapper);
        }
      }
    }
  });
});









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
            url: "/getsubcategory/" + category,
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