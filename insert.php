<?php
include 'connection.php';
$options = array(1, 2, 5);
$company = "Maruti Suzuki";
$model = "WagonR";

foreach($options as $i) {
    $query = "INSERT INTO `model has options` (`company name`, `model name`, `option id`) VALUES ('$company', '$model', '$i')";
    echo $query."<br>";
    if($mysqli->query($query) === TRUE) echo "Successful<br>";
    else echo "Unsuccessful";
}
?>