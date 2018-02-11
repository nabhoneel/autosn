<?php
include '../includes/connection.php';
include '../includes/verify.php';
verify();

$results = $mysqli->query("SELECT SUM(`total price`) AS 'sum', YEAR(`datetime`) AS 'year', MONTH(`datetime`) AS 'month' FROM `company` NATURAL JOIN `sold car` GROUP BY YEAR(`datetime`), MONTH(`datetime`)");

$data = array();
foreach($results as $row)
    $data[] = $row;

print json_encode($data);
?>
