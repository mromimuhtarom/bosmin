<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">  
	    <title>Buku BOS( Bantuan Operasional Sekolah)</title>
        <meta name="description" content="">
        <meta name="author" content="templatemo">
        <!-- 
        Visual Admin Template
        https://templatemo.com/tm-455-visual-admin
        -->
	    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
	    <link href="/css/font-awesome.min.css" rel="stylesheet">
	    <link href="/css/bootstrap.min.css" rel="stylesheet">
        <link href="/css/templatemo-style.css" rel="stylesheet">
        <link rel="stylesheet" href="/css/button.css">
	    
	    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
	</head>
	<body class="green_bg_yellow">
		<div class="templatemo-content-widget templatemo-login-widget green_bg_dark" style="border:25px solid #ffffff">
			<header class="text-center">
	          <div style="margin-bottom:5%;"> <img style="width:80%;height:auto;margin:auto" src="/img/logo-min.png" alt=""></div>
	          <h1>Buku BOS(Bantuan Operasional Sekolah)</h1>
	        </header>
			<form method="post" action="{{ route('login') }}" class="templatemo-login-form">
				{{ csrf_field() }}
	        	<div class="form-group">
	        		<div class="input-group">
		        		<div class="input-group-addon"><i class="fa fa-user fa-fw"></i></div>	        		
		              	<input name="username" type="text" class="form-control" placeholder="Nama Pengguna">           
		          	</div>	
	        	</div>
	        	<div class="form-group">
	        		<div class="input-group">
		        		<div class="input-group-addon"><i class="fa fa-key fa-fw"></i></div>	        		
		              	<input name="password" type="password" class="form-control" placeholder="Kata Sandi">           
		          	</div>	
	        	</div>	
				<div class="form-group">
					<button type="submit" class="myButton width-100">Login</button>
				</div>
	        </form>
		</div>
	</body>
</html>