<?php
session_start();
if(empty($_SESSION)) header("Location: http://localhost/xampp/autosn?previous=dealer");
if(!($_SESSION["verification"] == "true")) header("Location: http://localhost/xampp/autosn?previous=dealer");

$employer = $_SESSION["employer"];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dealer Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" media="screen" href="./css/sales.css" />
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="./js/jquery.min.js"></script>
    <script src="./bootstrap/js/bootstrap.min.js"></script>
    <script>
    function logout()
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                alert("You are being logged out!" + xmlhttp.responseText);
            }
        };
        xmlhttp.open('GET','destroy_session.php', true);
        xmlhttp.send(null);
        window.location = "index.php";
    }
  </script>
</head>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" style="color: white;">Hello!</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <h5><span class="badge badge-info" style="margin-top: 9px;"></span></h5>
      </li>
    </ul>
    <button type="button" class="btn btn-outline-light" data-toggle="modal" data-target="#topBrandModal" style="margin: 0 1em">TOP BRANDS</button>
    str_repeat('&nbsp;', 5);
    <button type="button" class="btn btn-outline-light">SALES</button>
    str_repeat('&nbsp;', 5);
    <button type="button" class="btn btn-outline-light" data-toggle="modal" data-target="#addCar" style="margin: 0 1em">ADD CAR</button>
    str_repeat('&nbsp;', 5);
    <button type="button" class="btn btn-outline-light" onclick="logout()" style="margin: 0 1em">LOG OUT</button>
  </div>
</nav>
<body>

<div class="modal fade bd-example-modal-lg" id="topBrandModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Top Brands : Rank Wise</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php include 'topBrand.php'; ?>
        <div id='response'></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg" id="addCar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Insert Car Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php include 'addCar.php'; ?>
        <div id='response'></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>
