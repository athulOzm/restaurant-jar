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
            .info {
          display: block;
          margin-left: 0;
          border-bottom: 2px dotted #333;
          padding-bottom: 10px;
          margin-bottom: 10px;
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
          line-height: 1.5em;
          font-size: .9em;
      }
      
      
      .nn p {
          margin: 0;
          line-height: 1.3em;
          font-size: 1em;
      }
      
      
      .info {
          display: block;
          margin-left: 0;
          border-bottom: 2px dotted #333;
          padding-bottom: 10px;
          margin-bottom: 10px;
      }
      .tar{text-align: right}
      p{margin-block-end:.5em; margin-block-start:.5em}
      
      h2, h3{margin-block-end:.2em; margin-block-start:.2em}
      
      
      .dot{width: 100%;height: 1px; border-bottom: 2px dotted #000; clear: both;}
       
      .info td b{padding: 0 10px; }
      
            </style>
 
  </head>
<body>

    {{-- <div class="backf" style="
    max-width: 88mm;
    margin: auto;
    text-align: center;
    background: #3F51B5;
    padding: 10px 0;
">
        <a href="{{route('pos')}}" style="
        width: 100%;
        color: #fff;
        text-decoration: none;
    ">Back to POS</a>
    </div> --}}


    <div id="invoice-POS">
    

        <center id="top">
         
          <div class="info"> 

            <div style="width: 100%; float:right; text-align:center; padding-top:10px; margin-bottom:10px">
              <img src="/img/cooking.png" style="width: 30%; margin-left:30%" alt="">
              <p>Jar Cookies</p>
              <b style="padding: 6px 20px; background: #fff; font-weight: 400">INVOICE</b>
              <div class="dot" style="margin-top: -12px"></div>
            </div>

            <div style="clear: both"></div>

            <table style="font-size: .9em">
              <tr>
                <td>Bill No</td>
                <td><b>:</b>{{$order->branch->code}}{{$order->invoice->id}}</td>
              </tr>
              <tr>
                <td>Order Date</td>
                <td><b>:</b>{{Carbon\Carbon::now() }}<td>
              </tr>
              @if ($order->user != '')
              <tr>
                <td>Member Name</td>
                <td><b>:</b>{{$order->vn}}<td>
              </tr>
              @endif
              {{-- <tr>
                <td>Member No</td>
                <td><b>:</b>{{$order->user->memberid}}</td>
              </tr>
              <tr>
                <td>Member Name</td>
                <td><b>:</b>{{$order->user->name}}<td>
              </tr> --}}
            </table>

          <div style="clear: both"></div>
          </div>
        </center> 
        
     
        
        <div id="bot">
    
                        <div id="table">
                            <table>
                                <tr class="tabletitle" style="text-align: left;">
                                    <td class="item"><h3>العنصر </h3></td>
                                    <td class="Hours"><h3>الكمية </h3></td>
                                    <td class="Rate"><h3>السعر </h3></td>
                                    <td class="Rate"><h3>خصم </h3></td>
                                    {{-- <td class="Rate"><h3>ضريبة </h3></td> --}}
                                    <td class="Rate tar"><h3>اجمالي</h3></td>
                                </tr>
                                <tr class="tabletitle" style="text-align: left; ">
                                    <td class="item"><h3>Item</h3></td>
                                    <td class="Hours"><h3>Qty</h3></td>
                                    <td class="Rate"><h3>Rate</h3></td>
                                    <td class="Rate"><h3>Discount</h3></td>
                                    {{-- <td class="Rate"><h3>VAT</h3></td> --}}
                                    <td class="Rate tar"><h3>Total</h3></td>
                                </tr>

                                @foreach ($order->orderproducts as $product)
                                
                            {{-- @dd($product) --}}

                          
                                <tr >
                                    <td class="tableitem"><p class="itemtext">{{$product->product->name}}<br>{{$product->product->name_ar}}</p></td>
                                    <td class="tableitem"><p class="itemtext">{{$product->quantity}}</p></td>
                                    <td class="tableitem"><p class="itemtext2">{{$product->product->price}}</p></td>
                                    <td class="tableitem"><p class="itemtext2">{{$product->discount}}</p></td>
                                    {{-- <td class="tableitem"><p class="itemtext2">{{$product->tax}}</p></td> --}}
                                    <td class="tableitem tar"><p class="itemtext"><b>{{$product->price_total_with_tax}}</b></p></td>
                                </tr>

                                  @foreach ($product->items as $item)

                                  {{-- @dd($item) --}}
                                      <tr class="service2">
                                        
                                        <td class="tableitem"><p class="itemtext2"> + {{$item->name}}</p></td>
                                        <td class="tableitem"><p class="itemtext2">{{$item->pivot->quantity}}</p></td>
                                        <td class="tableitem"><p class="itemtext2">{{$item->price}}</p></td>
                                        <td class="tableitem"><p class="itemtext2">{{$item->pivot->discount}}</p></td>
                                        {{-- <td class="tableitem"><p class="itemtext2">{{$item->vat}}</p></td> --}}
                                        <td class="tableitem tar"><p class="itemtext"><b>
                                          {{ @number_format($item->price * $item->pivot->quantity, 3)}}</b>
                                       </p></td>
                                        

                                    </tr>
                                  @endforeach


                                @endforeach
    
                             
    
    
                                
                                <tr class="tabletitle" style="border-top: 1px solid #333">
                                  <td class="Rate"  colspan="3"><h2>Total Amount Payable</h2></td>
                                  <td class="payment tar"><h2 style="text-align: center">{{$order->gettotalprice()['price']}}</h2></td>
                                  <td class="Rate tar" colspan="2"  ><h2>اجمالي المبلغ</h2></td>
                                </tr>

                                @if ($order->gettotalprice()['discount'] != 0)
                                  <tr class="tabletitle">
                                    <td class="Rate"  colspan="3"><h2>Discount</h2></td>
                                    <td class="payment tar"><h2 style="text-align: center">{{$order->gettotalprice()['discount']}}</h2></td>
                                    <td class="Rate tar" colspan="2"  ><h2>خصم </h2></td>
                                  </tr>
                                @endif

                                @if ($order->gettotalprice()['container'] != 0)
                                  <tr class="tabletitle">
                                    <td class="Rate"  colspan="3"><h2>Container</h2></td>
                                    <td class="payment tar"><h2 style="text-align: center">{{$order->gettotalprice()['container']}}</h2></td>
                                    <td class="Rate tar" colspan="2"  ><h2>وعاء </h2></td>
                                  </tr>
                                @endif


                                @if ($order->gettotalprice()['tax'] != 0)
                                  <tr class="tabletitle">
                                    <td class="Rate" colspan="3"><h2>Tax</h2></td>
                                    <td class="payment tar"><h2 style="text-align: center">{{$order->gettotalprice()['tax']}}</h2></td>
                                    <td class="Rate tar" colspan="2"  ><h2>الضريبة</h2></td>
                                  </tr>
                              
    
                                <tr class="tabletitle">
                                  <td class="Rate"  colspan="3"><h2>Total Amound after Tax</h2></td>
                                  <td class="payment tar"><h2 style="text-align: center">{{$order->gettotalprice()['subtotal']}}</h2></td>
                                  <td class="Rate tar" colspan="2" ><h2>اجمالي المبلغ بعد الضريبة </h2></td>
                                </tr>
                                @endif
    
                            </table>
                        </div><!--End Table--> 

                        <hr>

                      <div style="text-align: center">

                        <img width="250mm" src="data:image/png;base64,{{DNS1D::getBarcodePNG('RE-'.$order->id, 'C39', 2, 40)}}" alt="barcode" />

                      </div>


                      <hr>

                      <div style="text-align: center; margin:0; font-size:14px; text-align:left">
                       
                        Pripared By : <BR>
                        Date and Time : {{Carbon\Carbon::now() }}<BR></div>
    
                    </div><!--End InvoiceBot-->
      </div><!--End Invoice-->
    

<script type="text/javascript">
    function auto_print() {     
        window.print()
        window.location.href = "/orders/list";

    }
    setTimeout(auto_print, 1000);
</script>
</body>
</html>
