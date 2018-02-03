<div class="col-sm-12" id="cars">	
<table class="table table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>Company</th>
      <th>Model</th>
      <th>Seats</th>
      <th>Price <span class="badge badge-pill badge-dark" data-toggle="tooltip" data-placement="top" title="Base price + options">i</span></th>
    </tr>
  </thead>
  <tbody>
		
	<?php
	include 'connection.php';
	header('Content-type: application/json');
	$json = file_get_contents('php://input');
	$json_decode = json_decode($json, true); 

	//generating an array with the specified options:
	$options = "";
	for($i=1; $i<count($json_decode); $i++)
			$options .= $json_decode[$i].",";
	$options = substr($options, 0, -1);

	$query = "SELECT `company name`, `model name`, `number of seats`, SUM(`options`.`cost`)+`model`.`cost` AS 'cost' FROM `model` NATURAL JOIN `model has options` JOIN `options` WHERE `model has options`.`option id` = `options`.`id` AND `number of seats`>=".$json_decode[0]." AND `option id` in (".$options.") GROUP BY `company name`, `model name` ORDER BY `cost`;";

	for ($i = 0; $i < count($json_decode) - 1; $i++) {
		$json_decode[$i] = $json_decode[$i + 1];
	}
	unset($json_decode[count($json_decode) - 1]);
	
	setlocale(LC_MONETARY, 'en_IN.UTF-8');
	$count = 1;
	$results = $mysqli->query($query);

	foreach($results as $row) {
		$options_check_query = "SELECT `option id` FROM `model has options` WHERE `company name` = '".$row["company name"]."' AND `model name` = '".$row["model name"]."';";
		$options_result = $mysqli->query($options_check_query);

		$x = array();
		foreach($options_result as $y){
			$x[] = $y["option id"];		
		}
		if(isValid($x, $json_decode)) {		
			echo "<tr>";
		?>
		<td>
		<label class="control control--radio"  data-toggle="tooltip" data-placement="top" title="<?php echo $count++; ?>">			
			<input type="radio" name="radio"/>
			<div class="control__indicator"></div>
	  	</label>
		</td>
		<?php
			echo "<td>".$row["company name"]."</td><td>".$row["model name"]."</td>";
			echo "<td>".$row["number of seats"]."</td><td>".money_format('&#8377;%!n', $row["cost"])."</td>";
		}
	}

	function isValid($x, $y) {
		for($i=0; $i<count($y); $i++) {
			if(!in_array($y[$i], $x)) return false;
		}
		return true;
	}	
	?>

	</tbody>
</table>
</div>