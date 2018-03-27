<?php
include '../includes/verify.php';
verify();
include '../includes/connection.php';
$models = $mysqli->query("SELECT `model name` FROM `model` WHERE `company name`='".getEmployer()."';");
$sales = $mysqli->query("SELECT `model name`, SUM(`total price`) AS 'sum' FROM `sold car` WHERE `company name`='".getEmployer()."' GROUP BY `model name`");

$sales_array = array();
$count = 0;

foreach($sales as $i) {
    $sales_array[$count]["model name"] = $i["model name"];
    $sales_array[$count++]["sum"] = $i["sum"];
}

foreach($models as $model) {
    if(in_array($model["model name"], array_column($sales_array, "model name")) != true) {
        $sales_array[$count]["model name"] = $model["model name"];
        $sales_array[$count++]["sum"] = "0";
    }
}


print json_encode($sales_array);
?>
