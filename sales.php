<?php
include 'verify.php';
verify();
?>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sales Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="./css/sales.css">
    <link rel="stylesheet" type="text/css" media="screen" href="./css/assist.css" />
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="./js/jquery.min.js"></script>
    <script src="./bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/Chart.min.js"></script>
    <script>
    var index;
    function getValues(id) {
        index = id;
    }

    function order() {
        var flag = false;
        var checks = document.getElementsByTagName("input");
        for(var i=0; i<checks.length; i++) {
            if(checks[i].type=='radio' && checks[i].checked == true) flag = true;
        }
        if(flag) window.location.href='./generateBill.php?index='+index;
        else {
            $("#alert_success").show();
            $("#alert_success").css('opacity', '1');
            window.setTimeout(function() {
                $("#alert_success").fadeTo(500, 0).slideUp(500, function(){
                    $(this).remove();
                });
            }, 4000);
            return;
        }
    }
    </script>
</head>
<nav class="navbar navbar-expand-lg" style="background: #134756;">
    <a class="navbar-brand" style="color: white;">Hello, <?php echo getUsername(); ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <h5><span class="badge badge-primary" style="margin-top: 9px;">Rank #10</span></h5>
            </li>
        </ul>
        <button type="button" class="btn btn-outline-light"  data-toggle="modal" data-target="#assistModal" style="margin: 0 1em">Assist Customer</button>
        <button type="button" class="btn btn-outline-light" onclick="window.location.href='./logout.php'">Logout</button>
    </div>
</nav>

<body>

    <?php

    include 'connection.php';
    $results = $mysqli->query("SELECT * FROM `sold car`");
    $fmt = new NumberFormatter('en_IN', NumberFormatter::CURRENCY);

    ?>
    <div class="grid">
        <div class="tables">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Date of Sale</th>
                        <th scope="col">Model</th>
                        <th scope="col">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($results as $key=>$row) {
                        echo "<tr>";
                        echo "<td>".($key+1)."</td>";
                        $datetime = new DateTime($row["datetime"]);
                        echo "<td>".$datetime->format('jS F\, Y')."</td>";
                        echo "<td>".$row["company name"]." ".$row["model name"]."</td>";
                        echo "<td>".$fmt->formatCurrency($row["total price"], "INR")."</td>";
                        echo "</tr>";
                        if($key==4) break;
                    }
                    ?>
                </tbody>
            </table>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#showAll" style="
            display: table;
            margin: 0 auto;
            ">
            Show All Sales
        </button>
    </div>
    <div class="graph">
        <input type="hidden" id="chosenYear" value="<?php echo date("Y"); ?>">
        <canvas id="salesComparison" width=740></canvas>
        <div class="btn-group" role="group" aria-label="Basic example" style="padding: 2em 0 1em 0;">
            <?php
            $years = $mysqli->query("SELECT YEAR(`datetime`) AS 'years' FROM `sold car` GROUP BY YEAR(`datetime`)");
            foreach($years as $y) {
                ?>
                <button type="button" class="btn btn-warning" onclick="changeYear(<?php echo $y["years"]; ?>)"><?php echo $y["years"]; ?></button>
                <?php
            }
            ?>
        </div>
        <script type="text/javascript" src="js/salesComparison.js"></script>
    </div>
</div>

<div class="modal fade show" id="showAll" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" style="width: fit-content;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">All sales</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="display: block;">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Date of Sale</th>
                            <th scope="col">Model</th>
                            <th scope="col">Options</th>
                            <th scope="col">Total Amount</th>
                            <th scope="col">Buyer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach($results as $key=>$row) {
                            echo "<tr>";
                            echo "<td>".($key+1)."</td>";
                            $datetime = new DateTime($row["datetime"]);
                            echo "<td>".$datetime->format('jS F\, Y')."</td>";
                            echo "<td>".$row["company name"]." ".$row["model name"]."</td>";
                            $options_result = $mysqli->query("SELECT `option name`, `cost` FROM `sold car has options`, `options`
                                WHERE `id`=`option id` AND `vehicle index`=".$row["vehicle index"]);
                            $options = "";
                            foreach($options_result as $i)
                                $options .= "<div title=".$fmt->formatCurrency($i["cost"], "INR")." class='optionName'>".$i["option name"]."</div>";
                            echo "<td>".$options."</td>";
                            echo "<td>".$fmt->formatCurrency($row["total price"], "INR")."</td>";
                            echo "<td>".$row["sold to"]."</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade " id="assistModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="longTitle">Cars' List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php include 'assist.php'; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="order()">Proceed</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
