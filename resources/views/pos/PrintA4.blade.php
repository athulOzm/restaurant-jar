<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   
    <title> </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600;700&display=swap" rel="stylesheet">

    <style>
body{font-family: 'Poppins', sans-serif;!important;}
      #invoice-POS{
       
        padding:1mm 2mm 18mm;
        margin: 0 auto;
        width: 86mm;
        background: #FFF;
      }
        
      ::selection {background: #f31544; color: #FFF;}
      ::moz-selection {background: #f31544; color: #FFF;}
      h1{
        font-size: 1.5em;
        color: #222;
      }
      h2{font-size: 1.6em; font-weight: 600}
      h3{
        font-size: 1.4em;
        font-weight: 800;
        line-height: 1.6em; padding: 0; margin: 0
      }
      p{
        font-size: 1.6em;
        color: #000;
        line-height: 1.1em;
      }
       
      #top, #mid,#bot{ /* Targets all id with 'col-' */
        /* border-bottom: 1px solid #000; */
      }
      
      
      
      #top .logo{
        //float: left;
        height: 60px;
        width: 60px;
        /* background: url(http://michaeltruong.ca/images/logo1.png) no-repeat; */
        background-size: 60px 60px;
      }
      .clientlogo{
        float: left;
        height: 60px;
        width: 60px;
        /* background: url(http://michaeltruong.ca/images/client.jpg) no-repeat; */
        background-size: 60px 60px;
        border-radius: 50px;
      }
      .info{
        display: block;
        //float:left;
        margin-left: 0;
      }
      .title{
        float: right;
      }
      .title p{text-align: right;} 
      table{
        width: 100%;
        border-collapse: collapse;
      }
   
      .tabletitle{
       
        font-size: .6em;
       
      }
      .service{border-bottom: 1px solid #000;}
      /* .item{width: 24mm;} */
      .itemtext{font-size: 1em;}
      .itemtext2{font-size: .9em; margin: 0; padding: 0}
      
      #legalcopy{
        margin-top: 5mm;
      }
      
      @media print {
        body * {
          visibility: hidden;
        }
        #invoice-POS, #invoice-POS * {
          visibility: visible;
        }
        #invoice-POS {
          position: absolute;
          left: 0;
          top: 0;
        }
      }
       

      .info p {
    margin: 0;
    line-height: 1.3em;
    font-size: 1em;
}


.nn p {
    margin: 0;
    line-height: 1.3em;
    font-size: .8em;
}


.info {
    display: block;
    margin-left: 0;
    border-bottom: 1px solid #000;
    padding-bottom: 15px;
    margin-bottom: 15px; 
}
.tar{text-align: right}
p{margin-block-end:.5em; margin-block-start:.5em}

h2, h3{margin-block-end:.2em; margin-block-start:.2em}

page {
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
}
page[size="A4"] {  
  width: 21cm;
  height: 29.7cm; 
}
page[size="A4"][layout="landscape"] {
  width: 29.7cm;
  height: 21cm;  
}
page[size="A3"] {
  width: 29.7cm;
  height: 42cm;
}
page[size="A3"][layout="landscape"] {
  width: 42cm;
  height: 29.7cm;  
}
page[size="A5"] {
  width: 14.8cm;
  height: 21cm;
}
page[size="A5"][layout="landscape"] {
  width: 21cm;
  height: 14.8cm;  
}
@media print {
  body, page {
    margin: 0;
    box-shadow: 0;
  }
}


      </style>
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" integrity="undefined" crossorigin="anonymous">
  </head>
<body>

  <page size="A4" layout="landscape">

    <div class="row">
      
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-4">The Royal Guard of Oman <br> Al-Husn Mess</div>
          <div class="col-md-4">Food Bill</div>
          <div class="col-md-4"> ?????????? ???????????????? ??????????????<br>       ?????? ??????    </div>
        </div>
      </div>

      <hr>


      <div class="col-md-12">
        <div class="row">
          <div class="col-md-4">
            <div class="col-md-4">Bill No</div>
            <div class="col-md-8">BFH <P style="float: right">83563<P></div>
          </div>

          <div class="col-md-4">
            <div class="col-md-4">aa</div>
            <div class="col-md-8">aa</div>
          </div>


          <div class="col-md-4">
            <div class="col-md-4">aa</div>
            <div class="col-md-8">aa</div>
          </div>

        </div>
      </div>


      <div class="row">
        <div class="col-md-4">aa</div>
        <div class="col-md-4">aa</div>
      </div>

      <div class="row">
        aa
      </div>



      <div class="row">
        <div class="col-md-6">sign</div>
        
      </div>

    </div>
  </page>





    <div id="invoice-POS">
    

        <center id="top">
         
          <div class="info"> 

            <div style="width: 38%; float:left; text-align:left"><img src="{{asset('img/cooking.png')}}" width="60" alt="">
              <h2 style="margin: 0; font-size:1.3em"> </h2>
            </div>

            <div style="width: 58%; float:right; text-align:right; padding-top:10px">
              <p>CR No: 12345</p>
              <p>AL AMARAT</p>
              <p>Tel : (968) 0000-9999</p>
            </div>
            
            <div style="clear: both"></div>

            <div style="width: 100%; text-align:left; padding-top:10px" class="nn">
              <p>Date: <b>{{Carbon\Carbon::now()->isoFormat('LLLL') }}</b></p>
              <p>Invoice No: <b>#{{$order->id}}</b></p>
               
            </div>

            <div style="clear: both"></div>


            </div> 
        </center> 
        
     
        
        <div id="bot">
    
                        <div id="table">
                            <table>
                                <tr class="tabletitle" style="text-align: left;">
                                    <td class="item"><h3>???????????? </h3></td>
                                    <td class="Hours"><h3>???????????? </h3></td>
                                    <td class="Rate"><h3>?????????? </h3></td>
                                    <td class="Rate"><h3>?????? </h3></td>
                                    <td class="Rate"><h3>?????????? </h3></td>
                                    <td class="Rate tar"><h3>????????????</h3></td>
                                </tr>
                                <tr class="tabletitle" style="text-align: left; ">
                                    <td class="item"><h3>Item</h3></td>
                                    <td class="Hours"><h3>Qty</h3></td>
                                    <td class="Rate"><h3>Rate</h3></td>
                                    <td class="Rate"><h3>Discount</h3></td>
                                    <td class="Rate"><h3>VAT</h3></td>
                                    <td class="Rate tar"><h3>Total</h3></td>
                                </tr>

                                @foreach ($order->orderproducts as $product)
                                
                            {{-- @dd($product) --}}

                          
                                <tr >
                                    <td class="tableitem"><p class="itemtext">{{$product->product->name}}<br>{{$product->product->name_ar}}</p></td>
                                    <td class="tableitem"><p class="itemtext">{{$product->quantity}}</p></td>
                                    <td class="tableitem"><p class="itemtext2">{{$product->product->price}}</p></td>
                                    <td class="tableitem"><p class="itemtext2">{{$product->discount}}</p></td>
                                    <td class="tableitem"><p class="itemtext2">{{$product->tax}}</p></td>
                                    <td class="tableitem tar"><p class="itemtext"><b>{{$product->price_total_with_tax}}</b></p></td>
                                </tr>

                                  @foreach ($product->items as $item)

                                  {{-- @dd($item) --}}
                                      <tr class="service2">
                                        
                                        <td class="tableitem"><p class="itemtext2"> + {{$item->name}}</p></td>
                                        <td class="tableitem"><p class="itemtext2">{{$item->pivot->quantity}}</p></td>
                                        <td class="tableitem"><p class="itemtext2">{{$item->price}}</p></td>
                                        <td class="tableitem"><p class="itemtext2">{{$item->pivot->discount}}</p></td>
                                        <td class="tableitem"><p class="itemtext2">{{$item->vat}}</p></td>
                                        <td class="tableitem tar"><p class="itemtext"><b>
                                          {{ @number_format($item->price * $item->pivot->quantity, 3)}}</b>
                                       </p></td>
                                        

                                    </tr>
                                  @endforeach


                                @endforeach
    
                             
    
    
                                
                                <tr class="tabletitle" style="border-top: 1px solid #333">
                                  <td class="Rate"  colspan="3"><h2>Total Amount</h2></td>
                                  <td class="payment tar"><h2 style="text-align: center">{{$order->gettotalprice()['price']}}</h2></td>
                                  <td class="Rate tar" colspan="2"  ><h2>???????????? ????????????</h2></td>
                                </tr>

                                @if ($order->gettotalprice()['discount'] != 0)
                                  <tr class="tabletitle">
                                    <td class="Rate"  colspan="3"><h2>Discount</h2></td>
                                    <td class="payment tar"><h2 style="text-align: center">{{$order->gettotalprice()['discount']}}</h2></td>
                                    <td class="Rate tar" colspan="2"  ><h2>?????? </h2></td>
                                  </tr>
                                @endif

                                @if ($order->gettotalprice()['container'] != 0)
                                  <tr class="tabletitle">
                                    <td class="Rate"  colspan="3"><h2>Container</h2></td>
                                    <td class="payment tar"><h2 style="text-align: center">{{$order->gettotalprice()['container']}}</h2></td>
                                    <td class="Rate tar" colspan="2"  ><h2>???????? </h2></td>
                                  </tr>
                                @endif


                                @if ($order->gettotalprice()['tax'] != 0)
                                  <tr class="tabletitle">
                                    <td class="Rate" colspan="3"><h2>Tax</h2></td>
                                    <td class="payment tar"><h2 style="text-align: center">{{$order->gettotalprice()['tax']}}</h2></td>
                                    <td class="Rate tar" colspan="2"  ><h2>??????????????</h2></td>
                                  </tr>
                              
    
                                <tr class="tabletitle">
                                  <td class="Rate"  colspan="3"><h2>Total Amound after Tax</h2></td>
                                  <td class="payment tar"><h2 style="text-align: center">{{$order->gettotalprice()['subtotal']}}</h2></td>
                                  <td class="Rate tar" colspan="2" ><h2>???????????? ???????????? ?????? ?????????????? </h2></td>
                                </tr>
                                @endif
    
                            </table>
                        </div><!--End Table--> 

                        <hr>

                      <div style="text-align: center">

                        <img width="250mm" src="data:image/png;base64,{{DNS1D::getBarcodePNG('RE-'.$order->id, 'C39', 2, 40)}}" alt="barcode" />

                      </div>


                        
    
                        <div id="legalcopy" style="text-align: center; margin:0">
                            <p class="" style="line-height: .9em; margin:0"><strong style="font-size: .6em; line-height:.8em">?????? ???????? ?????????????? ??????</strong></p>
                            {{-- <p>_</p>
                            <p>_</p><p>_</p> --}}
                        </div>
    
                    </div><!--End InvoiceBot-->
      </div><!--End Invoice-->
    

<script type="text/javascript">
    // function auto_print() {     
    //     window.print()
    //     window.close();

    // }
    // setTimeout(auto_print, 1000);
</script>
</body>
</html>
