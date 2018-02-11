<?php
include '../includes/connection.php';
include '../includes/verify.php';
verify();

$results = $mysqli->query("SELECT SUM(`total price`) as 'sum', `company name` as 'cname' FROM `company` NATURAL JOIN `sold car` GROUP BY `company name`");

$data = array();
foreach($results as $row)
    $data[] = $row;

print json_encode($data);
?>
