<?php
include 'includes/verify.php';
verify();
include 'includes/connection.php';
?>
<html>
<head>
    <title>Automobile Administration</title>
    <?php include './includes/header.php'; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="js/Chart.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="./css/admin.css">
    <script type="text/javascript" src="js/charts/dashboard.js"></script>
    <script type="text/javascript" src="js/adminTopBar.js"></script>
</head>

<?php
include 'includes/utilities.php';

$result = $mysqli->query("SELECT `company name`, SUM(`total price`) FROM `sold car` GROUP BY `company name` ORDER BY SUM(`total price`) DESC LIMIT 1");
$top_car = $result->fetch_array(MYSQLI_NUM);

$result = $mysqli->query("SELECT `company name`, `model name`, SUM(`total price`) FROM `sold car` GROUP BY `model name` ORDER BY SUM(`total price`) DESC LIMIT 1");
$top_model = $result->fetch_array(MYSQLI_NUM);

$result = $mysqli->query("SELECT SUM(`total price`) as 'sum' FROM `sold car`");
$all_sales = $result->fetch_array(MYSQLI_NUM);

$result = $mysqli->query("SELECT SUM(`total price`), `sold by` FROM `sold car` GROUP BY `sold by` ORDER BY SUM(`total price`) DESC LIMIT 1");
$top_sales_person = $result->fetch_array(MYSQLI_NUM);
?>

<body>
    <div class="grid">
        <div class="sidebar">
            <span class="logo"><h2>Automobile Company</h2></span>
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="dashboard-tab" data-toggle="pill" href="#dashboard" role="tab"><i class="fa fa-dashboard"></i> Dashboard</a>
                <a class="nav-link" id="assists-tab" data-toggle="pill" href="#assists" role="tab"><i class='fa fa-users'></i> Assists</a>
                <a class="nav-link" id="customers-tab" data-toggle="pill" href="#customers" role="tab"><i class='fa fa-user'></i> Customers</a>
                <a class="nav-link" id="cars-tab" data-toggle="pill" href="#cars" role="tab"><i class='fa fa-car'></i> Cars</a>
            </div>
        </div>
        <div class="content-area">
            <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" style="color: #252525;">Hello, <?php echo getUsername(); ?></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto" style="margin-left: auto; margin-right:0 !important;">
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#addSalesPerson">Add Sales Person</button>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#salesPeople" style="margin: 0 1em">Sales People</button>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#carDealer" style="margin: 0 1em 0 0">Car Dealers</button>
                        <button type="button" class="btn btn-info" onclick="window.location.href='./includes/logout.php'" style="padding: 0 0.5em 0 1em; border-radius: 3em;">Logout <i class="fa fa-sign-out"></i></button>
                    </ul>
                </div>
            </nav>
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="dashboard" role="tabpanel">
                    <div class="dashboard-grid">
                        <div class="gross-sales">
                            <h1>Overall sale</h1>
                            <h5><?php echo getRupees($all_sales[0]); ?></h5>
                        </div>
                        <div class="top-company">
                            <h4>Company with highest sales</h4>
                            <h1><?php echo $top_car[0]; ?></h1>
                            <h5><?php echo getRupees($top_car[1]); ?></h5>
                        </div>
                        <div class="top-model">
                            <h4>Model with highest sales</h4>
                            <h1><?php echo $top_model[0]." ".$top_model[1]; ?></h1>
                            <h5><?php echo getRupees($top_model[2]); ?></h5>
                        </div>
                        <div class="top-seller">
                            <h4>Top Sales Person</h4>
                            <h1><?php echo $top_sales_person[1]; ?></h1>
                            <h5><?php echo getRupees($top_sales_person[0]); ?></h5>
                        </div>
                        <div class="company-sales"><canvas id="company-sales"></canvas></div>
                        <div class="seller-comparison"><canvas id="seller-comparison"></canvas></div>
                        <div class="all-sales-graph"><canvas id="all-sales-comparison"></canvas></div>
                    </div>
                </div>
                <div class="tab-pane fade" id="assists" role="tabpanel">
                    <div class="assist-grid">
                        <select name="sales-people" class="custom-select sales-people" placeholder="Sales People's List">
                            <?php
                            $sales_people = $mysqli->query("SELECT `username` FROM `members` WHERE `role`='sales';");
                            foreach($sales_people as $i) {
                                ?>
                                <option value="<?php echo $i["username"]; ?>"><?php echo $i["username"]; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <script type="text/javascript" src="js/dropdown.js"></script>
                        <div class="sales-details">
                            <input type="hidden" id="chosenYear" value="<?php echo date("Y"); ?>">
                            <div id="assists-cards"></div>
                            <canvas id="salesComparison" width=740></canvas>
                            <div id="sales-data"></div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="customers" role="tabpanel">
                    <div class="customers-grid">
                        <div class="list-of-customers">
                            <script type="text/javascript" src="js/customer_list.js"></script>
                            <input type="text" class="search-customers" id="search-customers" oninput="showSuggestions()" placeholder="search customers (by emails)">
                            <ul id="list-of-customers" style="padding-left: 0px;">
                                <?php
                                $customers = $mysqli->query("SELECT * FROM `customer`");
                                foreach($customers as $x) {
                                    echo "<li class='customer-list-set' id='".$x["email id"]."'>".$x["email id"]."</li>";
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="customer-details" id="customer-details"></div>
                    </div>
                </div>
                <div class="tab-pane fade" id="cars" role="tabpanel" aria-labelledby="v-pills-Cars-tab">
                    <div class="cars-grid">
                        <div class="list-of-cars">
                            <script type="text/javascript" src="js/car_list.js"></script>
                            <select name="car-companies" class="custom-select car-companies" placeholder="Car companies" id="carCompanies">
                                <option value="all">All models</option>
                                <?php
                                $car_companies = $mysqli->query("SELECT `name` FROM `company`;");
                                foreach($car_companies as $key=>$i) {
                                    ?>
                                    <option value="<?php echo $key; ?>"><?php echo $i["name"]; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <ul id="list-of-models" style="padding-left: 0px;">
                                <?php
                                $models = $mysqli->query("SELECT * FROM `model`");
                                $count = -1;
                                $old_company = "";
                                foreach($models as $x) {
                                    if($x["company name"] != $old_company) $count++;
                                    echo "<li class='model-list ".$count." list-of-models' id='".$x["company name"]."' onclick='showCarDetails(\"".$x["company name"]." ".$x["model name"]."\")'>".$x["company name"]." ".$x["model name"]."</li>";
                                    $old_company = $x["company name"];
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="car-list" id="car-list"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addSalesPerson">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Sales Person</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="email" class="form-control" id="username" placeholder="">
                            <small id="usernameHelp" class="form-text text-muted">Ideally, the sales person gets to choose the username.</small>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Password">
                        </div>
                        <span class="badge badge-pill badge-warning" id="error"></span>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" onclick="addSalesPerson()">Add</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="salesPeople">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Current list of sales people</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <table class="table table-sm" style="text-align: center;">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Username</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $dealers = $mysqli->query("SELECT `username` FROM `members` WHERE `role`='sales'");
                            foreach($dealers as $key=>$username) {
                                ?>
                                <tr>
                                    <th scope="row"><?php echo ($key+1); ?></th>
                                    <td><?php echo $username["username"]; ?></td>
                                </tr>
                                <?php
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

    <div class="modal fade" id="carDealer">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Current list of dealers</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <table class="table" style="text-align: center;">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Username</th>
                                <th scope="col">Company</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sales_people = $mysqli->query("SELECT `username`, `employer` FROM `members` WHERE `role`='dealer'");
                            foreach($sales_people as $key=>$username) {
                                ?>
                                <tr>
                                    <th scope="row"><?php echo ($key+1); ?></th>
                                    <td><?php echo $username["username"]; ?></td>
                                    <td><?php echo $username["employer"]; ?></td>
                                </tr>
                                <?php
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

    <!--The following modal is for all sorts of notifications:-->
    <div class="modal fade" id="notifyModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Notification</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="notify-modal-body">
                </div>
                <button type="button" class="btn btn-info" data-dismiss="modal">Okay</button>
            </div>
        </div>
    </div>
</div>

<body>
