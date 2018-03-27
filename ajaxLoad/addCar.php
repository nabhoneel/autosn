<?php
include '../includes/verify.php';
verify();
include '../includes/connection.php';

$options = json_decode($_POST["options"]);
$model = $_POST["model"];

$mysqli->query("INSERT INTO cars (`index number`, `company name`, `model name`) VALUES (NULL, '".getEmployer()."', '$model');");
$result = $mysqli->query("SELECT max(`index number`) from cars;");
$index = $result->fetch_array(MYSQLI_NUM);
$vin = $index[0];

for($i=1; $i<=7; $i++) {
	if(in_array($i, $options)) {
		$mysqli->query("INSERT INTO `car has options` (`vehicle index`, `option id`) VALUES ('$vin', $i);");
	}
}
echo 'true';
?>
