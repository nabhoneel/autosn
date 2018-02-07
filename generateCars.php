<?php
include 'connection.php';
header('Content-type: application/json');
$json = file_get_contents('php://input');
//ticked_options structure: [0]=>'number of seats'; [rest]=>'ticked options'
$ticked_options = json_decode($json, true);

$results = $mysqli->query("SELECT `cars`.`index number`, `cars`.`company name`, `cars`.`model name`, `model`.`number of seats`, `model`.`cost` FROM `cars` NATURAL JOIN `model` WHERE `model`.`number of seats` >= $ticked_options[0];");

//echo "<br>SELECT `cars`.`index number`, `cars`.`company name`, `cars`.`model name`, `model`.`number of seats`, `model`.`cost` FROM `cars` NATURAL JOIN `model` WHERE `model`.`number of seats` >= $ticked_options[0];";

for ($i = 0; $i < count($ticked_options) - 1; $i++) {
    $ticked_options[$i] = $ticked_options[$i + 1];
}
unset($ticked_options[count($ticked_options) - 1]);//only the ticked options remain

setlocale(LC_MONETARY, 'en_IN.UTF-8');
$count = 1;

$currentSet = "";
$prevSet = "";
$counter = 0;
$first_row = 1;
?>

<table class="table" id="carsTable">
    <thead>
        <tr>
            <th>#</th>
            <th>Company</th>
            <th>Model</th>
            <th>Base Price</th>
            <th>Seats</th>
            <th>Available Options</th>
        </tr>
    </thead>
    <tbody>

        <?php
        foreach($results as $row) {
            $index = $row["index number"];

            $options_check_query = "SELECT `option name`, `cost`, `option id` FROM `car has options` JOIN `cars` JOIN `options` WHERE `option id`=`id` AND `vehicle index`=`index number` AND `index number`=$index ORDER BY `option id`";
            $options_result = $mysqli->query($options_check_query);
            $id = $cost = [];
            $optionName = "";
            foreach($options_result as $i) {
                $id[] = $i["option id"];
                $cost[] = $i["cost"];
                $optionName .= $i["option name"].", ";
            }
            $optionName = substr($optionName, 0, -2);

            if(isValid($id, $ticked_options)) {
                $currentSet = $row["company name"]." ".$row["model name"];
                if($prevSet != $currentSet) {
                    if($first_row == 1) $first_row = 0;
                    else {
                        ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </td>
                        <?php
                    }
                    echo "<td>".$count."<td>".$row["company name"]."</td><td>".$row["model name"]."</td>";
                    echo "<td>".$row["cost"]."</td><td>".$row["number of seats"]."</td>";
                    ?>
                    <td>
                        <!--Expand button:-->
                        <button type="button" class="carsExpand btn btn-lg btn-info collapsed" data-toggle="collapse" data-target="#optionsSection<?php echo $count; ?>"></button>

                        <tr>
                            <td colspan=5>
                                <div id="optionsSection<?php echo $count; ?>" class="collapse">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th><?php echo $count; ?></th>
                                                <th>Options</th>
                                                <th>Total Cost</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count++;
                                        }
                                        ?>
                                        <tr>
                                            <td>
                                                <label class="control control--radio"  data-toggle="tooltip" data-placement="top" title="<?php echo $count++; ?>">
                                                    <input type="radio" name="radio"/>
                                                    <div class="control__indicator" onclick="getValues(<?php echo $index; ?>)"></div>
                                                </label>
                                            </td>
                                            <td><?php echo $optionName; ?></td>
                                            <td><?php echo array_sum($cost); ?></td>
                                        </tr>

                                        <?php
                                        $prevSet = $row["company name"]." ".$row["model name"];
                                    }
                                }

                                function isValid($id, $y) {
                                    for($i=0; $i<count($y); $i++) {
                                        if(!in_array($y[$i], $id)) return false;
                                    }
                                    return true;
                                }
                                ?>

                            </tbody>
                        </table>
