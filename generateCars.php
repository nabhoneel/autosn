<div class="col-sm-12" id="cars">	
<table class="table table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>Company</th>
      <th>Model</th>
      <th>Seats</th>
      <th>Price</th>
    </tr>
  </thead>
  <tbody>
		
	<?php
	include 'connection.php';
	header('Content-type: application/json');
	$json = file_get_contents('php://input');
	$json_decode = json_decode($json, true); 
	$options = "";
	for($i=1; $i<count($json_decode); $i++)
			$options .= $json_decode[$i].",";
	$options = substr($options, 0, -1);
	$query = "SELECT `company name`, `model name`, `number of seats`, SUM(`options`.`cost`)+`model`.`cost` AS 'cost' FROM `model` NATURAL JOIN `model has options` JOIN `options` WHERE `model has options`.`option id` = `options`.`id` AND `number of seats`>=".$json_decode[0]." AND `option id` in (".$options.") GROUP BY `company name`, `model name` ORDER BY `cost`";

	echo $query;
	
	$count = 1;
	$results = $mysqli->query($query);
	foreach($results as $row) {
		echo "<tr>";
		echo "<td>".$count++."</td><td>".$row["company name"]."</td><td>".$row["model name"]."</td>";
		echo "<td>".$row["number of seats"]."</td><td>".$row["cost"]."</td>";
	}
	?>

	</tbody>
</table>
</div>