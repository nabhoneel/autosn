<?php
include 'includes/verify.php';
verify();
?>
<html>
<head>
    <title>Dealer Profile</title>
    <?php include './includes/header.php'; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="js/Chart.min.js"></script>
    <script type="text/javascript" src="js/charts/dealerCharts.js"></script>
    <link rel="stylesheet" href="./css/dealer.css">
    <link rel="stylesheet" type="text/css" media="screen" href="./css/assist.css" />
    <script>
    var flag = 0;
    function addNewCar() {
        var options = [];
        $(".actual-options").each(function() {
            if($(this).is(':checked')) {
                options.push($(this).val());
            }
        });
        if(options.length == 0 && flag == 0) {
            $(".enter-options-alert").show();
            $('.enter-options-alert').css('opacity', '1');
            window.setTimeout(function() {
                $(".enter-options-alert").fadeTo(500, 0).slideUp(500, function(){
                    $(this).hide();
                });
            }, 4000);
            flag = 1;
        } else {
            $.ajax({
                url: 'ajaxLoad/addCar.php',
                method: 'POST',
                data: {
                    options: JSON.stringify(options),
                    model: $('#car-model').find(":selected").text()
                },
                success: function(data) {
                    console.log(data);
                    $(".success-alert").show();
                    $('.success-alert').css('opacity', '1');
                    window.setTimeout(function() {
                        $(".success-alert").fadeTo(500, 0).slideUp(500, function(){
                            $(this).hide();
                        });
                    }, 4000);
                }
            });
        }
    }
    </script>
</head>
<nav class="navbar navbar-expand-lg" style="background-color: #f57777 !important">
    <a class="navbar-brand" style="color: black;">Hello, <?php echo getUsername(); ?></a>
    <input type="hidden" value="<?php echo getUsername(); ?>" id="username_hidden">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto"></ul>
        <button type="button" class="btn btn-info"  data-toggle="modal" data-target="#addCar" style="margin: 0 1em;">Add Cars</button>
        <button type="button" class="btn btn-info" onclick="window.location.href='./includes/logout.php'">Logout</button>
    </div>
</nav>

<body>
    <div class="dealer-grid">
        <div class="brand-ranking jumbotron">
            <span class="brand-ranking-head">Brand ranking</span>
            <div class="companies">
                <?php
                include 'includes/connection.php';
                $result = $mysqli->query("select `company name` from `sold car` group by `company name` order by sum(`total price`) desc;");
                foreach($result as $key=>$company) {
                    $c = $company["company name"];
                    echo "<div>$c</div>";
                }
                ?>
                <style>
                .companies > div:nth-last-child(<?php echo $key-1; ?>):after {
                    content: "";
                }
                </style>
            </div>
        </div>
        <div class="sales-each-model">
            <canvas id="sales-each-model"></canvas>
        </div>
        <div class="monthwise-sales">
            <canvas id="monthwise-sales"></canvas>
        </div>
    </div>

    <div class="modal fade" id="addCar" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Car Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-primary enter-options-alert" style="display: none; grid-column: 1 / 3;" role="alert">
                        Click on 'Add Car' once more to enter a car without any options
                    </div>
                    <div class="alert alert-success success-alert" style="display: none; grid-column: 1 / 3;" role="alert">
                        A new car was added!
                    </div>
                    <select name="mname" class="custom-select" id="car-model">
                        <?php
                        $result=$mysqli->query("SELECT distinct `model name` from `model` where `company name`='".getEmployer()."' ORDER BY `model name` ASC");
                        while($row=$result->fetch_assoc())
                        {
                            echo "<option value=' ".$row['model name']." '>". $row['model name']." </option>";
                        }
                        ?>
                    </select>
                    <div class="options-section">
                        <h4>Options that come with the car:</h4>
                        <?php
                        $rows = $mysqli->query("select `id`, `option name` from `options`;");

                        foreach($rows as $option)
                        {
                            if($option["id"]%5 == 0) echo "<br>"; ?>
                            <label class="control control--checkbox"><?php echo $option["option name"];?>
                                <input type="checkbox" value="<?php echo $option["id"];?>" class="actual-options"/>
                                <div class="control__indicator"></div>&nbsp;
                            </label>
                        <?php   }
                        ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" onclick="addNewCar()">Add car</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>
