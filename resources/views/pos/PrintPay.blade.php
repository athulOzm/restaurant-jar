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

 
    <div id="invoice-POS">
    

        <center id="top">
         
          <div class="info"> 

            {{-- <div style="width: 38%; float:left; text-align:left"><img src="{{asset('img/cooking.png')}}" width="60" alt="">
              <h2 style="margin: 0; font-size:1.3em"> </h2>
            </div> --}}

            <div style="width: 100%; float:right; text-align:center; padding-top:10px; margin-bottom:10px">
              <p>The Royal Guard of Oman</p>
              <p>Al Husn Officers Mess</p>
              <p style="margin-bottom: 6px">Al Husn Kitchen</p>  
              <b style="padding: 6px 20px; background: #fff; font-weight: 400">PAYMENT</b>
              <div class="dot" style="margin-top: -12px"></div>
            </div>
            
            <div style="clear: both"></div>

            {{-- <table style="font-size: .9em">
              <tr>
                <td>Order No</td>
                <td><b>:</b>{{$order->branch->code}}{{$order->id}}</td>
              </tr>
              <tr>
                <td>Order Date</td>
                <td><b>:</b>{{Carbon\Carbon::now() }}<td>
              </tr>
            </table> --}}

            <div style="clear: both"></div>
          </div> 


          <div class="info">
            <table style="font-size: .9em">
              <tr>
                <td>Member No</td>
                <td><b>:</b>{{$user->memberid}}</td>
              </tr>
              <tr>
                <td>OldMess No</td>
                <td><b>:</b>{{$user->serviceid}}<td>
              </tr>
              <tr>
                <td>Rank</td>
                <td><b>:</b>{{$user->rank->name}}<td>
              </tr>
              <tr>
              <td>Member Name</td>
                <td>{{$user->name}}<td>
              </tr>
            </table>
          </div>


          

 
      


        </center> 
        
     
        
        <div id="bot">
    
                        <div id="table">
                            <table>
                              
                                <tr class="tabletitle" style="text-align: left; ">
                                  <td class="Rate"><h3>Inv</h3></td>
                                    <td class="Hours"><h3>Date</h3></td>
                                    {{-- <td class="Rate"><h3>Menu Type</h3></td> --}}
                                    <td class="Rate tar"><h3>Amount</h3></td>
                                </tr>

                         
                                @foreach($orders as $order) 
               
                          
                                <tr >
                                    <td class="tableitem"><p class="itemtext">{{$order->branch->code}}{{$order->invoice->id}}</p></td>
                                    <td class="tableitem"><p class="itemtext">{{$order->delivery_time}}</p></td>
                                    {{-- <td class="tableitem"><p class="itemtext">{{$order->menutype->name}}</p></td> --}}
                                    <td class="tableitem"><p class="itemtext">{{$order->amount}}</p></td>
                             
                                </tr>

                                  


                                @endforeach
    
                             
    
    
                                
                                <tr class="tabletitle" style="border-top: 1px solid #333">
                                  <td class="Rate" ><h2>Total Amount</h2></td>
                                  <td class="payment tar"><h2 style="text-align: center">{{$toty}}</h2></td>
                                  <td class="Rate tar" ><h2>اجمالي المبلغ</h2></td>
                                </tr>

                             
 
    
                            </table>
                        </div><!--End Table--> 

                        <hr>

                        <div style="text-align: center; margin:0; font-size:14px; text-align:left">
                         
                   
                          Member Sign : <BR></div>

                    <hr>

                      <div style="text-align: center">

                        {{-- <img width="250mm" src="data:image/png;base64,{{DNS1D::getBarcodePNG('RE-'.$order->id, 'C39', 2, 40)}}" alt="barcode" /> --}}

                      </div>


                        
    
                       
    
                    </div><!--End InvoiceBot-->
      </div><!--End Invoice-->
    

<script type="text/javascript">
    function auto_print() {     
       window.print()
       window.location.href = "/members/balance";

    }
    setTimeout(auto_print, 1000);
</script>
</body>
</html>
