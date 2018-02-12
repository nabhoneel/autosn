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
                <a class="nav-link active" id="v-pills-dashboard-tab" data-toggle="pill" href="#v-pills-dashboard" role="tab" aria-controls="v-pills-dashboard" aria-selected="true"><i class="fa fa-dashboard"></i> Dashboard</a>
                <?php
                $tabs = array("<i class='fa fa-users'></i> Assists", "<i class='fa fa-user'></i> Customers", "<i class='fa fa-car'></i> Cars");
                foreach($tabs as $key=>$x) {
                    ?>
                    <a class="nav-link" id="v-pills-<?php echo $key; ?>-tab" data-toggle="pill" href="#v-pills-<?php echo $key; ?>" role="tab" aria-controls="v-pills-<?php echo $key; ?>" aria-selected="false"><?php echo $x; ?></a>
                    <?php
                }
                ?>
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
                <div class="tab-pane fade show active" id="v-pills-dashboard" role="tabpanel" aria-labelledby="v-pills-dashboard-tab">
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
                <div class="tab-pane fade" id="v-pills-0" role="tabpanel" aria-labelledby="v-pills-Assists-tab"><div style="background-color: black;"></div></div>
                <div class="tab-pane fade" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-Customers-tab">...</div>
                <div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-Cars-tab">...</div>
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
                            $sales_people = $mysqli->query("SELECT `username` FROM `members` WHERE `role`='sales'");
                            foreach($sales_people as $key=>$username) {
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
