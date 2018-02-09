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
    function proceed() {
        $('#confirmDialog').modal('hide');
        $('#paymentDialog').modal('show');
    }
    function finishOrder(which) {
        var details = [];
        if($('.nav-tabs .active').text() == "Returning customer") {
            details.push(document.getElementById("emailid").value);
            details.push(document.getElementById("oldname").value);
            details.push(document.getElementById("olddob").value);
            details.push(document.getElementById("oldcontact").value);
            details.push(document.getElementById("oldaddress").value);
            for(var i=0; i<details.length; i++) {
                if(details[i].length == 0) {

                    $(".returning-customer-alert").show();
                    $('.returning-customer-alert').css('opacity', '1');
                    window.setTimeout(function() {
                        $(".returning-customer-alert").fadeTo(500, 0).slideUp(500, function(){
                            $(this).hide();
                        });
                    }, 4000);
                    return;
                }
            }
        }
        else {
            details.push(document.getElementById("emailnew").value);
            details.push(document.getElementById("namenew").value);
            details.push(document.getElementById("dobnew").value);
            details.push(document.getElementById("contactnew").value);
            details.push(document.getElementById("addressnew").value);
            for(var i=0; i<details.length; i++) {
                if(details[i].length == 0) {

                    $(".new-customer-alert").show();
                    $('.new-customer-alert').css('opacity', '1');
                    window.setTimeout(function() {
                        $(".new-customer-alert").fadeTo(500, 0).slideUp(500, function(){
                            $(this).hide();
                        });
                    }, 4000);
                    return;
                }
            }
        }
        details.push(document.getElementById('vin').value);
        if(which != "Pay") $('#confirmDialog').modal('show');
        else {
            var d = new Date();
            if($("#creditCardNumber").val().length < 16)
                setAlert(".paymentAlert", "Enter a valid credit card number");
            else if(($("#month").val()-1) <= d.getMonth() && $("#year").val()==d.getFullYear())
                setAlert(".paymentAlert", "Enter a valid expiry date");
            else if($("#cvv").val().length < 3)
                setAlert(".paymentAlert", "Enter a valid CVV");

            $.ajax({
                type: "POST",
                url: 'makeTransaction.php',
                data: {
                    email: details[0],
                    name: details[1],
                    dob: details[2],
                    contact: details[3],
                    address: details[4],
                    vehicle_index: details[5],
                    totalCost: document.getElementById("totalCost").value,
                    creditcard: document.getElementById("creditCardNumber").value,
                    expiryMonth: document.getElementById("month").value,
                    expiryYear: document.getElementById("year").value,
                    cvv: document.getElementById("cvv").value
                },
                success: function(data) {
                    $('#paymentDialog').modal('hide');
                    $('#successDialog').modal('show');
                    window.setTimeout(function() {
                        $("#successDialog").fadeTo(500, 0).slideUp(500, function(){
                            $('#paymentDialog').modal('hide');
                            $('#successBox').modal('show');
                        });
                    }, 4000);
                }
            });
        }
    }
    function setAlert(str, htmlText) {
        $(str).show();
        $(str).html(htmlText);
        $(str).css('opacity', '1');
        window.setTimeout(function() {
            $(str).fadeTo(500, 0).slideUp(500, function(){
                $(this).hide();
            });
        }, 4000);
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
    echo "<input type=hidden id=vin value='$index'>";

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
    <div id="getResults"></div>
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
                        <div style="display: none;" class="alert alert-info alert-dismissible fade show returning-customer-alert" role="alert"><center>
                            All details must be present!<br>Choose a returning customer <br><strong>or, </strong><br>Enter details of the new customer in the other tab</center>
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
                        <div style="display: none;" class="alert alert-info alert-dismissible fade show new-customer-alert" role="alert"><center>
                            All details must be present!<br>Enter details of the new customer and click on 'Save'</center>
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
                        <input type="hidden" id="totalCost" value="<?php echo ($modelDetails[4] + $optionsCost); ?>">
                    </tr>
                </thead>
            </table>
            <button style="float: right;" type="button" class="btn btn-secondary" onclick="finishOrder('confirm')">Confirm Order!</button>
        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="confirmDialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>After this point, the details cannot be changed. Are you sure you want to proceed?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="proceed()">Proceed!</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="paymentDialog">
        <div class="modal-dialog" role="document" style="max-width: 20em;">
            <div class="modal-content" style="max-width: 20em;">
                <div class="modal-header">
                    <h5 class="modal-title">Payment Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div style="display: none;" class="alert alert-info alert-dismissible fade show paymentAlert" role="alert"><center>

                    </div>
                    <div class="form-group">
                        <label for="creditCardNumber">Card Number</label>
                        <input class="form-control" id="creditCardNumber" aria-describedby="Credit/Debit card number" placeholder="Enter credit/debit card number" style="
                        font-family:  monospace;
                        font-size: 1.4em;
                        text-align:  center;
                        width: 14em;
                        font-weight: 500;
                        ">
                        <small id="cardHelp" class="form-text text-muted">We'll never share your card details with anyone else.</small>
                    </div>
                    <script>
                    function cc_format(value) {
                        var v = value.replace(/\s+/g, '').replace(/[^0-9]/gi, '')
                        var matches = v.match(/\d{4,16}/g);
                        var match = matches && matches[0] || ''
                        var parts = []
                        for (i=0, len=match.length; i<len; i+=4) {
                            parts.push(match.substring(i, i+4))
                        }
                        if (parts.length) {
                            return parts.join(' ')
                        } else {
                            return value
                        }
                    }

                    onload = function() {
                        document.getElementById('creditCardNumber').oninput = function() {
                            this.value = cc_format(this.value)
                        }
                    }
                    </script>
                    <div class="form-row">
                        <div class="input-group form-group col-md-4">
                            <select class="custom-select" id="month" style="
                            font-size: 1em;
                            font-weight: 600;">
                            <?php
                            $months = array(1 => 'Jan.', 2 => 'Feb.', 3 => 'Mar.', 4 => 'Apr.', 5 => 'May', 6 => 'Jun.', 7 => 'Jul.', 8 => 'Aug.', 9 => 'Sep.', 10 => 'Oct.', 11 => 'Nov.', 12 => 'Dec.');
                            foreach($months as $num => $name) {
                                echo "<option value=".$num.">".$name."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="input-group form-group col-md-4">
                        <select class="custom-select" id="year" style="
                        font-size: 0.8em;
                        font-weight: 600;">
                        <?php
                        for($i=date("Y"); $i<=2050; $i++)
                        echo "<option value=".$i.">".$i."</option>";
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <input minlength="3" maxlength="3"type="password" class="form-control" id="cvv" placeholder="CVV">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="finishOrder('Pay')">Pay</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="successBox" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" id="successDialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="text-align: center;">Successful transaction!</h5>
            </div>
            <div class="modal-body">
                <center>
                    <strong>Congratulations on making a sale!</strong><br><br>You have been awarded sales points. Go to your profile to check how many you have acquired.
                </center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" onclick="window.location.href='sales.php'">Okay</button>
            </div>
        </div>
    </div>
</body>
