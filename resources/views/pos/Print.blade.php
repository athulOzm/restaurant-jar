<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   
    <title> </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
<style>

#invoice-POS{
 
  padding:2mm;
  margin: 0 auto;
  width: 88mm;
  background: #FFF;
}
  
::selection {background: #f31544; color: #FFF;}
::moz-selection {background: #f31544; color: #FFF;}
h1{
  font-size: 1.5em;
  color: #222;
}
h2{font-size: .9em;}
h3{
  font-size: 1.2em;
  font-weight: 300;
  line-height: 2em;
}
p{
  font-size: .7em;
  color: #666;
  line-height: 1.2em;
}
 
#top, #mid,#bot{ /* Targets all id with 'col-' */
  border-bottom: 1px solid #EEE;
}

#top{min-height: 100px;}
#mid{min-height: 80px;} 
#bot{ min-height: 50px;}

#top .logo{
  //float: left;
	height: 60px;
	width: 60px;
	background: url(http://michaeltruong.ca/images/logo1.png) no-repeat;
	background-size: 60px 60px;
}
.clientlogo{
  float: left;
	height: 60px;
	width: 60px;
	background: url(http://michaeltruong.ca/images/client.jpg) no-repeat;
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
td{
  //padding: 5px 0 5px 15px;
  //border: 1px solid #EEE
}
.tabletitle{
  //padding: 5px;
  font-size: .5em;
  background: #EEE;
}
.service{border-bottom: 1px solid #EEE;}
.item{width: 24mm;}
.itemtext{font-size: .5em;}

#legalcopy{
  margin-top: 5mm;
}

  
 

</style>
 
  </head>
<body>

    <div class="backf" style="
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
    </div>


    <div id="invoice-POS">
    
        <center id="top">
         
          <div class="info"> 
            <img src="http://restoapp.link/img/cooking.png" width="30" alt="">
            <h2>POS Test </h2>
            <p style="line-height:.6em">CR No: 12345</p>
            <p style="line-height:.6em">AL AMARAT</p>
            <p style="line-height:.6em">Tel : (968) 0000-9999</p>

          </div> 
        </center> 
        
     
        
        <div id="bot">
    
                        <div id="table">
                            <table>
                                <tr class="tabletitle" style="text-align: left;">
                                    <td class="item"><h2>العنصر </h2></td>
                                    <td class="Hours"><h2>الكمية </h2></td>
                                    <td class="Rate"><h2>السعر </h2></td>
                                    <td class="Rate"><h2>خصم </h2></td>
                                    <td class="Rate"><h2>ضريبة </h2></td>
                                    <td class="Rate"><h2>اجمالي</h2></td>
                                </tr>
                                <tr class="tabletitle" style="text-align: left; ">
                                    <td class="item"><h2>Item</h2></td>
                                    <td class="Hours"><h2>Qty</h2></td>
                                    <td class="Rate"><h2>Rate</h2></td>
                                    <td class="Rate"><h2>Discount</h2></td>
                                    <td class="Rate"><h2>VAT</h2></td>
                                    <td class="Rate"><h2>Total</h2></td>
                                </tr>

                                @foreach ($order->orderproducts as $product)
                                
                            {{-- @dd($product) --}}
                                <tr class="service">
                                    <td class="tableitem"><p class="itemtext">{{$product->product->name}}</p></td>
                                    <td class="tableitem"><p class="itemtext">{{$product->quantity}}</p></td>
                                    <td class="tableitem"><p class="itemtext">{{$product->product->price}}</p></td>
                                    <td class="tableitem"><p class="itemtext">{{$product->discount}}</p></td>
                                    <td class="tableitem"><p class="itemtext">{{$product->tax}}</p></td>
                                    <td class="tableitem"><p class="itemtext">{{$product->sub_price}}</p></td>
                                </tr>
                                @endforeach
    
                             
    
    
                                <tr class="tabletitle">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="Rate"><h2>tax</h2></td>
                                    <td class="payment"><h2>{{$order->gettotalprice()['tax']}}</h2></td>
                                    <td class="Rate"><h2>ضريبة </h2></td>
                                    

                                </tr>

                                <tr class="tabletitle">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="Rate"><h2>Discount</h2></td>
                                    <td class="payment"><h2>{{$order->gettotalprice()['discount']}}</h2></td>
                                    <td class="Rate"><h2>خصم </h2></td>

                                </tr>
    
                                <tr class="tabletitle">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="Rate"><h2>Total</h2></td>
                                    <td class="payment"><h2>{{$order->gettotalprice()['subtotal']}}</h2></td>
                                    <td class="Rate"><h2>اجمالي</h2></td>

                                </tr>
    
                            </table>
                        </div><!--End Table-->
    
                        <div id="legalcopy" style="text-align: center">
                            <p class="legal"><strong>Thank you for your business!</strong></p>
                        </div>
    
                    </div><!--End InvoiceBot-->
      </div><!--End Invoice-->
    

<script type="text/javascript">
    function auto_print() {     
        window.print()
    }
    //setTimeout(auto_print, 1000);
</script>
</body>
</html>
