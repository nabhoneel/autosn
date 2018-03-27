<?php
include '../includes/verify.php';
verify();
include '../includes/connection.php';

$results = $mysqli->query("SELECT SUM(`total price`) AS 'sum', `sold by` AS 'seller' FROM `sold car` GROUP BY `sold by`");

$data = array();
foreach($results as $row)
    $data[] = $row;

print json_encode($data);
?>
