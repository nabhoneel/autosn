<?php
session_start();

include '../connection.php';
$_SESSION["sales username"] = "nabhoneelm";
$username = $_SESSION["sales username"];

$results = $mysqli->query("SELECT SUM(`total price`) AS `amount`, MONTH(`datetime`) AS `month` FROM `sold car` WHERE YEAR(`datetime`)=".$_POST["yr"]." GROUP BY CONCAT(YEAR(`datetime`), '/', MONTH(`datetime`))");

$data = array();
foreach($results as $row)
    $data[] = $row;

print json_encode($data);
?>
