<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Payment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="./css/bill.css">
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="./js/jquery.min.js"></script>
    <script src="./bootstrap/js/bootstrap.min.js"></script>
	<script>
    function generalEventer() {
        var options = document.getElementsByClassName("options");
        for (var i = 0; i < options.length; i++) {
            options[i].addEventListener('change', function() {
                if(this.checked == true) document.getElementById("totalCost").innerHTML = parseInt(document.getElementById("totalCost").innerHTML) + parseInt(this.value);
                if(this.checked == false) document.getElementById("totalCost").innerHTML = parseInt(document.getElementById("totalCost").innerHTML) - parseInt(this.value);
            });
        }
    }
	function showResult(str) {
		if (str.length==0) {
			document.getElementById("showids").innerHTML="";
			document.getElementById("showids").style.border="0px";
            document.getElementById("detailsbutton").disabled = true;
			return;
		}
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		} else {  // code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function() {
			if (this.readyState==4 && this.status==200) {
				document.getElementById("showids").innerHTML=this.responseText;
				document.getElementById("showids").style.border="1px solid #A5ACB2";
			}
		}
        document.getElementById("detailsbutton").disabled = false;
		xmlhttp.open("GET","accounts.php?q="+str,true);
		xmlhttp.send();
	}
    function writeToTextArea(str) {
        if(str.length > 0) {
        document.getElementById("emailid").value = str;
        }
		document.getElementById("showids").innerHTML="";
		document.getElementById("showids").style.border="0px";
    }
    function getDetails() {
        var str = document.getElementById("emailid").value;
    }
    </script>
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

<body onload="generalEventer()">
<div class="grid">
    <div class="userDetails">
        <ul class="nav nav-tabs nav-fill" id="customers" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="old-tab" data-toggle="tab" href="#oldcust" role="tab" aria-controls="old-customer" aria-selected="true">Returning customer</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="new-tab" data-toggle="tab" href="#newcust" role="tab" aria-controls="new-customer" aria-selected="false">New customer</a>
          </li>
        </ul>

        <div class="tab-content">
          <div class="tab-pane fade show active" id="oldcust" role="tabpanel" aria-labelledby="home-tab">
              <input size="35" type="text" class="form-control" id="emailid" aria-describedby="emailHelp" placeholder="Enter email" onkeyup="showResult(this.value)">
              <div id="showids"></div>
              <br>
              <center>
                  <button type="button" id="detailsbutton" disabled class="btn btn-outline-info">Get details</button>
              </center>

              <div class="modal-body">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroup-sizing-default">Email</span>
                    </div>
                    <input type="text" readonly id="email" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroup-sizing-default">Name</span>
                    </div>
                    <input type="text" id="name" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroup-sizing-default">Date of Birth</span>
                    </div>
                    <input type="date" id="dob" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroup-sizing-default">Contact</span>
                        <span class="input-group-text" id="inputGroup-sizing-default">(+91)</span>
                    </div>
                    <input type="text" id="contact" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroup-sizing-default">Address</span>
                    </div>
                    <input type="text" id="name" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-info">Edit details</button>
                <button type="button" class="btn btn-primary">Confirm details</button>
              </div>
          </div>
          <div class="tab-pane fade" id="newcust" role="tabpanel" aria-labelledby="pills-profile-tab">
          </div>
        </div>
    </div>
    <div class="cars">
        <?php
        $company = $_GET["company"];
        $model = $_GET["model"];

        include 'connection.php';
    	setlocale(LC_MONETARY, 'en_IN.UTF-8');

            $optionsQuery = "SELECT `id`, `option name`, `cost` FROM `options`, `model has options` WHERE `options`.`id` = `model has options`.`option id` AND `model has options`.`company name`='$company' AND `model has options`.`model name`='$model'";

        $modelDetailsQuery = "SELECT `model`.`number of seats`, `model`.`cost` FROM `model` WHERE `model`.`company name`='$company' AND `model`.`model name`='$model'";

        $options = $mysqli->query($optionsQuery);
        $modDetails = $mysqli->query($modelDetailsQuery);

        $modelDetails = $modDetails->fetch_array(MYSQLI_NUM);
        ?>
        <h1 style="text-align: center;">
            <?php echo $company." ".$model; ?>
        </h1>
        <h3 style="text-align: center;">
            <?php echo $modelDetails[0]."-seater car"; ?>
        </h3>
        <br>
        <table class="table table-sm">
          <thead>
            <tr>
              <th scope="col">Available Options</th>
              <th scope="col">Cost (&#8377;)</th>
            </tr>
          </thead>
          <tbody>
        <?php
        foreach($options as $option) { ?>
            <tr>
                <td>
                    <label class="control control--checkbox"><?php echo $option["option name"];?>
                    <input type="checkbox" class="options" value="<?php echo $option["cost"]; ?>"/>
                    <div class="control__indicator"></div>
                    </label>
                </td>
                <td>
                    <?php echo $option["cost"]; ?>
                </td>
            </tr>
        <?php }
        echo "<tr><th>Base price</th><td>".$modelDetails[1]."</td></tr>";
        ?>
          <tr>
              <th style="font-size: 1.4em;">Total</th>
              <td id="totalCost"><?php echo $modelDetails[1]; ?></td>
          </tr>
          </tbody>
        </table>
    </div>
</div>
</body>
