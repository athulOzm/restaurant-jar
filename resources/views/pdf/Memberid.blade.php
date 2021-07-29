<!DOCTYPE html>
<html>
<head>
	<title>Profile Card</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<style>
        body{
	margin: 0px;
	padding: 0px;
	background: #fff;
	font-family: arial;
	box-sizing: border-box;
}
@page { margin: 0px; }
body { margin: 0px; }
.card-container{
	width: 300px;
	height: 450px;
	background: #e7e7e7;
	border-radius: 9px;
  
	box-shadow: 0px 1px 10px 1px #000;
	overflow: hidden;
	display: inline-block;
}
.upper-container{
	height: 110px;
	background: #7F00FF; overflow: visible
}
.image-container{
	background: white;
	width: 80px;
	height: 80px;
	border-radius: 50%;
	padding: 5px;
	transform: translate(100px,-40px)
}
.image-container img{
	width: 80px;
	height: 80px;
	border-radius: 50%;
}
.lower-container {
    height: 280px;
  
    padding: 20px;
    padding-top: 0;
    text-align: center;
    margin-top: -45px; padding-bottom: 0
}
.lower-container h3, h4{
	box-sizing: border-box;
	line-height: .5;
	font-weight: lighter;
}
.lower-container h4{
	color: #7F00FF;
	opacity: .5;
	font-weight: bold;
}
.lower-container p{
	font-size: 16px;
	color: gray;
	margin-bottom: 10px;
}
.lower-container .btn{
	padding: 12px 20px;
	background: #7F00FF;
	border: none;
	color: white;
	border-radius: 30px;
	font-size: 12px;
	text-decoration: none;
	font-weight: bold;
	transition: all .3s ease-in;
}
.lower-container .btn:hover{
	background: transparent;
	color: #7F00FF;
	border: 2px solid #7F00FF;
}
    </style>
</head>

<body>

	<div class="card-container">

		<div class="upper-container">
            <h2 style="
    width: 100%;
    text-align: center;
    margin: 0;
    padding-top: 20px;
    color: #fff;
    text-transform: uppercase;
">Club Name</h2>
			
		</div>

        <div class="image-container">
            
			@if ($user->cover != null)
                            <img   width="60" src="https://restourent.signcard.net/{{env('IMAGE_PATH')}}{{ $user->cover}}"  />
							@else
							<img src="{{asset('img/cooking.png')}}" width="60" alt="">
                          @endif
        </div>

		<div class="lower-container">
			<div>
				<h3>Name : {{$user->name}}</h3>
				<h4>Member ID : {{$user->memberid}}</h4>
				<h4>Pass Code : {{$user->code}}</h4>
			</div>
			<div>
				<p style="color: #222; font-size:13px">Member ID card for Club name</p>
			</div>
			<div>
				<img src="{{asset('img/barcode.png')}}" width="150" alt="">
			</div>
		</div>

	</div>

</body>
</html>