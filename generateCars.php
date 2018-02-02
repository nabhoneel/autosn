<div class="col-sm-12" id="cars">							
<?php
header('Content-type: application/json');
$json = file_get_contents('php://input');
$json_decode = json_decode($json, true); 
$options = "";
for($i=1; $i<count($json_decode); $i++)
    $options .= $json_decode[$i].",";
$options = substr($options, 0, -1);
$query = "SELECT * FROM `model` NATURAL JOIN `model has options` WHERE `option id` in (".$options.") AND `number of seats` = ".$json_decode[0];
echo $query;
?>
</div>