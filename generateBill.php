<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Payment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="./css/sales.css">
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="./js/jquery.min.js"></script>
    <script src="./bootstrap/js/bootstrap.min.js"></script>
		<style>
		.outer {
			display: table;
			height: 100%;
			width: 100%;
			}

			.middle {
					display: table-cell;
					vertical-align: middle;
			}

			.inner {
					margin: auto;
					padding: auto;
					width: 100%; /*whatever width you want*/
			}

			.container {
					top: 0;
					width: 35em;
			}
		</style>
</head>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" style="color: white;">Payment Portal</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        
      </li>      
    </ul>
    <button type="button" class="btn btn-outline-light" onclick="window.history.back()" style="margin: 0 1em">Go back</button>
    <button type="button" class="btn btn-outline-light" onclick="window.location.href='./logout.php'">Logout</button>
  </div>
</nav>

<body>
<div class="outer">
  <div class="middle">
    <div class="inner">
      <div class="container">
				<ul class="nav nav-tabs nav-justified">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#home">Returning Customer</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#menu1">New customer</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
</body>

<?php

$company = $_GET["company"];
$model = $_GET["model"];
?>