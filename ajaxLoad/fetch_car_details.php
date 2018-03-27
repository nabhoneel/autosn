<?php
include '../includes/verify.php';
verify();
include '../includes/utilities.php';
include '../includes/connection.php';
$model = $_POST["car_model"];

$car = $mysqli->query("SELECT `index number`, `number of seats`, `cost` FROM `cars`, `model` WHERE CONCAT(`cars`.`company name`, ' ', `cars`.`model name`)='$model' AND `cars`.`company name`=`model`.`company name` AND `cars`.`model name`=`model`.`model name`;");

foreach($car as $key=>$data) {
    if($key == 0) {
        $x = $data["number of seats"];
        $y = $data["cost"];
        echo "<h1 style='text-align: center;'>$model [$x-seater]</h1>";
        echo "<h2 style='text-align: center;'>Base price: ".getRupees($y)."</h2>";
        ?>
        <div style="display: grid; grid-template-columns: 50% 50%; grid-column-gap: 0.5em; grid-row-gap: 0.5em;">
        <?php
    }
    ?>
    <div class="card">
        <h5 class="card-header">Vehicle Index: V-<?php echo $data["index number"]; ?></h5>
        <div class="card-body">
            <p class="card-text">
                <h5><b>Options available:</b></h5>
                <?php
                $options_result = $mysqli->query("SELECT `option name`, `cost` FROM `car has options`, `options`
                    WHERE `id`=`option id` AND `vehicle index`=".$data["index number"]);
                $options_cost = 0;
                foreach($options_result as $i) {
                    echo $i["option name"]." [".getRupees($i["cost"])."]<br>";
                    $options_cost += $i["cost"];
                }
                echo "<br><h5><b>Total cost:</b> ".getRupees($options_cost + $data["cost"])."</h5>";
                ?>
            </p>
        </div>
    </div>
    <?php
}
?>
</div>
