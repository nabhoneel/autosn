<?php
include '../includes/verify.php';
verify();
include '../includes/connection.php';
$years = $mysqli->query("SELECT YEAR(`datetime`) AS 'years' FROM `sold car` WHERE `sold by`='".$_POST["username"]."' GROUP BY YEAR(`datetime`);");
?>

<div class="btn-group" role="group" id="years-of-sales" aria-label="years-of-sales" style="padding: 1em 0 1em 0; display: table; margin: 0 auto;">
    <?php
    foreach($years as $y) {
        ?>
        <button type='button' class='btn btn-warning' onclick='changeYear(<?php echo $y["years"]; ?>)'><?php echo $y["years"]; ?></button>
        <?php
    }
    ?>
</div>

<?php
$results = $mysqli->query("SELECT * FROM `sold car` WHERE `sold by`='".$_POST["username"]."';");
include '../includes/utilities.php';
if($results->num_rows == 0) return;
?>

<table class="table" style="background-color: white;
padding: 1em;
text-align: center;
margin-top: 2em;
-webkit-box-shadow: 0px 0px 8px 2px rgba(9,24,43,0.13);
-moz-box-shadow: 0px 0px 8px 2px rgba(9,24,43,0.13);
box-shadow: 0px 0px 8px 2px rgba(9,24,43,0.13););
border-radius: 0.4em;">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Date of Sale</th>
            <th scope="col">Model</th>
            <th scope="col">Options</th>
            <th scope="col">Total Amount</th>
            <th scope="col">Buyer</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($results as $key=>$row) {
            echo "<tr>";
            echo "<td>".($key+1)."</td>";
            $datetime = new DateTime($row["datetime"]);
            echo "<td>".$datetime->format('jS F\, Y')."</td>";
            echo "<td>".$row["company name"]." ".$row["model name"]."</td>";
            $options_result = $mysqli->query("SELECT `option name`, `cost` FROM `sold car has options`, `options`
                WHERE `id`=`option id` AND `vehicle index`=".$row["vehicle index"]);
            $options = "";
            foreach($options_result as $i)
                $options .= "<div title=".getRupees($i["cost"], "INR")." class='optionName'>".$i["option name"]."</div>";
            echo "<td>".$options."</td>";
            echo "<td>".getRupees($row["total price"])."</td>";
            echo "<td>".$row["sold to"]."</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
