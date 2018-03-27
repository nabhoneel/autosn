<?php
include '../includes/verify.php';
verify();
include '../includes/connection.php';
$data_array = [];
foreach ($_POST as $key => $value)
    $data_array[$key] = $value;

$mod_details = $mysqli->query("SELECT `company name`, `model name` FROM `cars` WHERE `index number`=".$data_array["vehicle_index"]);
$modelDetails = $mod_details->fetch_array(MYSQLI_NUM);

$sold_car_insert_query = "INSERT INTO `sold car` (`vehicle index`, `company name`, `model name`, `sold by`, `sold to`, `total price`, `credit card number`, `expiry month`, `expiry year`, `cvv`) VALUES ('".
    $data_array["vehicle_index"]."', '".
    $modelDetails[0]."', '".
    $modelDetails[1]."', '".
    getUsername()."', '".
    $data_array["email"]."', '".
    $data_array["totalCost"]."', '".
    $data_array["creditcard"]."', '".
    $data_array["expiryMonth"]."', '".
    $data_array["expiryYear"]."', '".
    $data_array["cvv"]."')";

$mysqli->query($sold_car_insert_query);//insert car into the `sold cars` table

$options = $mysqli->query("SELECT `option id` FROM `car has options` WHERE `vehicle index`=".$data_array["vehicle_index"]);
foreach($options as $i) {
    $options_insert_query = "INSERT INTO `sold car has options` (`vehicle index`, `option id`) VALUES (".$data_array["vehicle_index"].", ".$i["option id"].");";

    $mysqli->query($options_insert_query);//insert options available with the car which was sold
}

$mysqli->query("DELETE FROM `cars` WHERE `index number`=".$data_array["vehicle_index"]);//remove the car from inventory and cascade delete options from the `car has options` table
?>
