<?php
include '../includes/verify.php';
verify();
header('Content-type: application/json');
$json = file_get_contents('php://input');
$details = json_decode($json, true);

if($details[0] == 0) editDetails($details);
else newDetails($details);

function editDetails($details) {
    include '../includes/connection.php';
    $query = "UPDATE `customer` SET `name` = '$details[2]', `dob` = '$details[5]', `address` = '$details[3]', `contact number` = '$details[4]'  WHERE `customer`.`email id` = '$details[1]'";

    if($mysqli->query($query) === TRUE) {
    ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Your new details were saved!</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <input value="success" id="queryStatus" type="hidden"/>
    <?php
    }
    else {
    ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>Your details could not be saved!</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
    <?php
    }
}

function newDetails($details) {
    include '../includes/connection.php';
    $query = "INSERT INTO `customer` (`name`, `dob`, `address`, `contact number`, `email id`) VALUES ('$details[2]', '$details[5]', '$details[3]', '$details[4]', '$details[1]');";

    if($mysqli->query($query) === TRUE) {
    ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>The new customer's details were saved!</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <input value="success" id="queryStatus" type="hidden"/>
    <?php
    }
    else {
    ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>The details could not be saved!</strong><br>Error: <?php echo $mysqli->error; ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
    <?php
    }
}

?>
