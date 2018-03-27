<?php
include '../includes/verify.php';
verify();
include '../includes/connection.php';
$sales = $mysqli->query("SELECT SUM(`total price`) AS 'sum', CONCAT(MONTH(`datetime`), '-', YEAR(`datetime`)) AS 'date' FROM `sold car` WHERE `company name`='".getEmployer()."' GROUP BY YEAR(`datetime`),MONTH(`datetime`);");

$data = array();
foreach($sales as $x) {
    $data[] = $x;
}
print json_encode($data);
?>
