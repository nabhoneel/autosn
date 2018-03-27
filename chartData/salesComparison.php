<?php
include '../includes/connection.php';
include '../includes/verify.php';
verify();

$results = $mysqli->query("SELECT SUM(`total price`) AS `amount`, MONTH(`datetime`) AS `month` FROM `sold car` WHERE YEAR(`datetime`)=".$_POST["yr"]." AND `sold by`='".$_POST["username"]."' GROUP BY CONCAT(YEAR(`datetime`), '/', MONTH(`datetime`))");

$data = array();
foreach($results as $row)
    $data[] = $row;

print json_encode($data);
?>
