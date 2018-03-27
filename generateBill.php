<!DOCTYPE html>
<?php include 'includes/verify.php'; verify(); ?>
<html>
<head>
    <title>Payment</title>
    <link rel="stylesheet" href="./css/bill.css">
    <?php include './includes/header.php'; ?>
    <script type="text/javascript" src="./js/generateBill.js"></script>
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
        <button type="button" class="btn btn-outline-light" onclick="window.location.href='./includes/logout.php'">Logout</button>
    </div>
</nav>

<body>
    <?php
    $index = $_GET["index"];
    echo "<input type=hidden id=vin value='$index'>";

    include 'includes/connection.php';
    include 'includes/utilities.php';

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
                    <input size="35" type="text" class="form-control" id="emailid" aria-describedby="emailHelp" placeholder="Enter email" oninput="showResult(this.value)">
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
                    <td><b><?php echo getRupees($modelDetails[4]); ?></b></td>
                </tr>
                <?php
                $optionsCost = 0;
                foreach($options as $i) {
                    $optionsCost += $i["cost"];
                    ?>
                    <tr>
                        <td><?php echo $i["option name"]; ?></td>
                        <td><?php echo getRupees($i["cost"]); ?></td>
                    </tr>
                    <?php
                }
                ?>
                <thead class="thead-light">
                    <tr>
                        <th>Total</th>
                        <th style="font-family: monospace;
                        font-size: 1.4em;
                        text-align: right;"><?php echo getRupees($modelDetails[4] + $optionsCost); ?></th>
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
