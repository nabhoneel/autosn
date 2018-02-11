<?php
include 'includes/connection.php';

$vins = $mysqli->query("SELECT `index number` FROM `cars`");
$success = $failure = 0;

foreach($vins as $x) {
    $options = array(1, 2, 3, 4, 5, 6, 7);
    $a = 0;

    $vin = $x["index number"];
    $times = array_rand($options, 1) + 1;
    while ($a <= $times) {
        $k = array_rand($options, 1);
        $option = $options[$k];
        unset($options[$k]);
        
        $query = "INSERT INTO `car has options` (`vehicle index`, `option id`) VALUES ('$vin', '$option')";
        if($mysqli->query($query) === TRUE) $success++;
        else $failure++;
        $a++;
    }
}

echo "Success: ".$success."<br>Failure: ".$failure;
?>
