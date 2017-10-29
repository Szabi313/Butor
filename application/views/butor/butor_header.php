<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bútorstúdió - Galgahévíz</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Passion+One|Open+Sans" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="<?php echo base_url();?>js/butor-front.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    
	<div class="container-fluid" id="header-and-menu">
		
		<div class="row" id="butor-header">
			<!-- <div class="col-lg-2"></div> -->
			<div class="col-lg-10 col-lg-offset-1 col-md-8">
				<div id="header-title">
					<div id="header-title-in"></div>
					<h1>BÚTORSTÚDIÓ</h1>
					<h3>Galgahévíz, Fő út 203.</h3>					
				</div>
			</div>
		</div> <!-- END HEADER -->
		
		<div class="row" id="menu">
			<!-- <div class="col-lg-2  col-md-2"></div> -->
			<nav class="col-lg-10 col-lg-offset-1 col-md-12  navbar navbar-default">
				<div class="container-fluid" id="butor-top-menu-container-fluid">
					<div class="navbar-header">
					  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#butor-top-menu-collapse" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					  </button>
					  <!-- <a class="navbar-brand" href="#">Menü</a> -->
					</div>
					
					<div class="collapse navbar-collapse" id="butor-top-menu-collapse">
						<ul class="nav nav-pills">
							<li><a href="<?php echo base_url();?>kategoriak">Főoldal</a></li>
							<li><a href="<?php echo base_url();?>butorstudio/magunkrol">Magunkról</a></li>
							<li><a href="<?php echo base_url();?>kategoria/aruhazunk">Áruházunk</a></li>
							<li><a href="<?php echo base_url();?>butorstudio/szolgaltatasaink">Szolgáltatásaink</a></li>
							<li><a href="<?php echo base_url();?>butorstudio/terkep">Térkép</a></li>
							<li><a href="<?php echo base_url();?>butorstudio/kapcsolat">Kapcsolat</a></li>
						</ul>
					</div>
				</div>
			</nav>
		</div> <!-- END MENU -->
	</div> <!-- END HEADER-AND-MENU -->		