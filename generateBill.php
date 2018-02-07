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
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        } else {  // code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
                document.getElementById("oldFormBody").innerHTML=this.responseText;
            }
        }
        xmlhttp.open("POST", "fetchDetails.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("email=" + str);
    }
    function makeEditable(x) {
        if(x === 1) {
            document.getElementById("oldname").readOnly = false;
            document.getElementById("oldaddress").readOnly = false;
            document.getElementById("oldcontact").readOnly = false;
            document.getElementById("olddob").readOnly = false;
            document.getElementById("saveOld").disabled = false;
        }
        else {
            document.getElementById("oldname").readOnly = true;
            document.getElementById("oldaddress").readOnly = true;
            document.getElementById("oldcontact").readOnly = true;
            document.getElementById("olddob").readOnly = true;
            document.getElementById("saveOld").disabled = true;
        }
    }
    function saveOld() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("alertSuccess").innerHTML = this.responseText;
                if(document.getElementById("queryStatus").value=="success") makeEditable(0);
            }
        };
        var details = [];
        details.push(0);
        details.push(document.getElementById("emailid").value);
        details.push(document.getElementById("oldname").value);
        details.push(document.getElementById("oldaddress").value);
        details.push(document.getElementById("oldcontact").value);
        details.push(document.getElementById("olddob").value);

        xmlhttp.open("POST", "save.php", true);
        xmlhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xmlhttp.send(JSON.stringify(details));
    }
    function saveNew() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("alertSuccessNew").innerHTML = this.responseText;
            }
        };
        var details = [];
        details.push(1);
        details.push(document.getElementById("emailnew").value);
        details.push(document.getElementById("namenew").value);
        details.push(document.getElementById("addressnew").value);
        details.push(document.getElementById("contactnew").value);
        details.push(document.getElementById("dobnew").value);

        xmlhttp.open("POST", "save.php", true);
        xmlhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xmlhttp.send(JSON.stringify(details));
    }
    function finishOrder() {

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

<body>
    <?php
    $index = $_GET["index"];

    include 'connection.php';
    $fmt = new NumberFormatter( 'en_IN', NumberFormatter::CURRENCY );

    $optionsQuery = "SELECT `option name`, `cost`, `option id` FROM `car has options` JOIN `cars` JOIN `options` WHERE `option id`=`id` AND `vehicle index`=`index number` AND `index number`=$index ORDER BY `option id`";

    $modelDetailsQuery = "SELECT * FROM `cars` NATURAL JOIN `model` WHERE `index number`=$index";

    $options = $mysqli->query($optionsQuery);
    $modDetails = $mysqli->query($modelDetailsQuery);

    $modelDetails = $modDetails->fetch_array(MYSQLI_NUM);
    ?>
    <center>
        <h1 style="padding-top: 1em;">
            <?php echo $modelDetails[0]." ".$modelDetails[1]; ?> [<?php echo $modelDetails[3]; ?>-seater]
        </h1>
    </center>
    <div class="grid">
        <div class="userDetails">
            <h2 style="text-align: center;">
                Customer Details
            </h2>
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
                        <button type="button" id="detailsbutton" disabled class="btn btn-outline-info" onclick="getDetails()">Get details</button>
                    </center>

                    <div class="modal-body" id="oldFormBody">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">Name</span>
                            </div>
                            <input type="text" id="oldname" readonly class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">Date of Birth</span>
                            </div>
                            <input type="date" id="olddob" readonly class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">Contact</span>
                                <span class="input-group-text" id="inputGroup-sizing-default">(+91)</span>
                            </div>
                            <input type="text" id="oldcontact" readonly class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">Address</span>
                            </div>
                            <input type="text" id="oldaddress" readonly class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                        </div>
                    </div>
                    <div id="alertSuccess"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-info" onclick="makeEditable(1)">Edit details</button>
                        <button type="button" class="btn btn-outline-info" id="saveOld" onclick="saveOld()">Save</button>
                    </div>
                </div>
                <div class="tab-pane fade" id="newcust" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">Email</span>
                            </div>
                            <input type="text" id="emailnew" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">Name</span>
                            </div>
                            <input type="text" id="namenew" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">Date of Birth</span>
                            </div>
                            <input type="date" id="dobnew" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">Contact</span>
                                <span class="input-group-text" id="inputGroup-sizing-default">(+91)</span>
                            </div>
                            <input type="text" id="contactnew" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">Address</span>
                            </div>
                            <input type="text" id="addressnew" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                        </div>
                    </div>
                    <div id="alertSuccessNew"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-info" onclick="saveNew()">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="cars">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>Description</th>
                        <th>Cost</th>
                    </tr>
                </thead>
                <tr>
                    <td><b>Base Price</b></td>
                    <td><b><?php echo $fmt->formatCurrency($modelDetails[4], "INR"); ?></b></td>
                </tr>
                <?php
                $optionsCost = 0;
                foreach($options as $i) {
                    $optionsCost += $i["cost"];
                    ?>
                    <tr>
                        <td><?php echo $i["option name"]; ?></td>
                        <td><?php echo $fmt->formatCurrency($i["cost"], "INR"); ?></td>
                    </tr>
                    <?php
                }
                ?>
                <thead class="thead-light">
                    <tr>
                        <th>Total</th>
                        <th style="font-family: monospace;
                        font-size: 1.4em;
                        text-align: right;"><?php echo $fmt->formatCurrency(($modelDetails[4] + $optionsCost), "INR"); ?></th>
                    </tr>
                </thead>
            </table>
            <button style="float: right;" type="button" class="btn btn-secondary" data-toggle="modal" data-target="#confirmDialog">Confirm Order!</button>
        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="confirmDialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>After this point, the details cannot be edited. Are you sure you want to proceed?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Proceed!</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>
