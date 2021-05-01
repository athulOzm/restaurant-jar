@extends('pos.layout.master')

<?php 
$menutypes = resolve('menutypesforpos');
?>

@section('content')
<div class="row">

  <div class="col-sm-5">
    <div class="card  shadow-xs my-1" style="height: 60vh; overflow:hidden">

      <div style="height: 50vh">
        <table id="customers" style="width:100%">
          <tr>
            <th  width="30">S/L</th>
            <th>Name</th>
            <th width="40">Qty</th>
            <th width="60">U.Price</th>
            <th width="60">Amount</th>
            <th width="90">Action</th>
          </tr>
          <tr>
            <td>1</td>
            <td>New burgar red rose</td>
            <td>2</td>
            <td>18.000</td>
            <td>68.000</td>
            <td>
              <div style="display: flex">
                
                <button  onclick="deleteCon('delfrm3');" class="btn btn-circle btn-sm">
                  <i class="fas fa-plus btnc"></i>
                </button>

                <button  onclick="deleteCon('delfrm3');" class="btn  btn-circle btn-sm">
                  <i class="fas fa-minus btnc"></i>
                </button>

                <button style="margin-left: 2px" onclick="deleteCon('delfrm3');" class="btn  btn-circle btn-sm">
                  <i class="fas fa-trash btnc"></i>
                </button>
              </div>
            </td>
          </tr>
          
          <tr>
            <td>1</td>
            <td>New burgar red rose</td>
            <td>2</td>
            <td>18.000</td>
            <td>68.000</td>
            <td>
              <div style="display: flex">
                <button  onclick="deleteCon('delfrm3');" class="btn btn-circle btn-sm">
                  <i class="fas fa-plus btnc"></i>
                </button>

                <button  onclick="deleteCon('delfrm3');" class="btn  btn-circle btn-sm">
                  <i class="fas fa-minus btnc"></i>
                </button>

                <button style="margin-left: 2px" onclick="deleteCon('delfrm3');" class="btn  btn-circle btn-sm">
                  <i class="fas fa-trash btnc"></i>
                </button>
              </div>
            </td>
          </tr>

          <tr>
            <td>1</td>
            <td>New burgar red rose</td>
            <td>2</td>
            <td>18.000</td>
            <td>68.000</td>
            <td>
              <div style="display: flex">
                <button  onclick="deleteCon('delfrm3');" class="btn btn-circle btn-sm">
                  <i class="fas fa-plus btnc"></i>
                </button>

                <button  onclick="deleteCon('delfrm3');" class="btn  btn-circle btn-sm">
                  <i class="fas fa-minus btnc"></i>
                </button>

                <button style="margin-left: 2px" onclick="deleteCon('delfrm3');" class="btn  btn-circle btn-sm">
                  <i class="fas fa-trash btnc"></i>
                </button>
              </div>
            </td>
          </tr>
  
          
            
        </table>
      </div>


      <div style="height: 90px">
        <table id="customers" style="width:100%">
          <tr>
            <th style="padding: 0"> </th>
            <th style="text-align: right; padding:0; padding-right:10px">Tax</th>
            <th width="150" style="padding:0;text-align: right; padding-right:30px; font-size:17px; font-weight:bold;">RO 6</th>
          </tr>

          <tr>
            <th>Order Token <b>27</b></th>
            <th style="text-align: right">Total Amount</th>
            <th width="150" style="text-align: right; padding-right:30px; font-size:17px; font-weight:bold">RO 30.500</th>
          </tr>
          
        </table>
      </div>
    
      
    
    </div>

    <div class="card  shadow-xs mt-2" style="height: 24vh"></div>

  </div>

  <div class="col-sm-7">
    <div class="card  shadow-xs mt-1" style="height: 85vh; max-height:85vh; overflow-y:scroll">
    
    
 
      
      <div id="exTab2"  >	
        <ul class="nav nav-tabs">

          @foreach ($menutypes as $menutype)
          <?php $nub = 1; ?>
            <li class="@if ($loop->first) active @endif">
              <a  href="#{{$menutype->id}}" data-toggle="tab">{{$menutype->name}}</a>
            </li>
            <?php 
            $nub = 2;
            ?>
          @endforeach


              
               
            </ul>
        
              <div class="tab-content ">

          @foreach ($menutypes as $menutype)

                <div class="tab-pane @if ($loop->first) active @endif flex" id="{{$menutype->id}}" >
                  <div style="display: flex;flex-wrap: wrap;">

                    @forelse ($menutype->products as $product)
                      <div class="card itembox" onclick="alert('asdf')">
                        <h5><span style="font-size: 10px">OMR</span> {{$product->price}}</h5>
                        <img width="100%" src="http://restoapp.link/img/dummy_img.jpg">
                        <h6>{{$product->name}}</h6>
                      </div>
                    @empty
                      No menu found!
                    @endforelse
                    

                   


                  </div>
                </div>
          @endforeach



                <div class="tab-pane" id="2">
                  sdfsdf
                 </div>
                 <div class="tab-pane" id="3">
                  sdfsdf
                 </div>
              </div>
          </div>
        
      
 
    
    
    
    
    
    </div>
  </div>


 

</div>

@endsection

