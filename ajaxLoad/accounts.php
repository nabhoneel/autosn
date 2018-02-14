<?php
include '../includes/verify.php';
verify();
include '../includes/connection.php';
$email = $_POST["email"];
$query = "SELECT * FROM `customer`";
$results = $mysqli->query($query);

foreach($results as $row) {
    if(strpos($row["email id"], $email) === 0) {
        $emailid = $row["email id"];
        ?><div class="suggestions" onclick="writeToTextArea('<?php echo $emailid; ?>');" onmouseover="" style="cursor: pointer;"><?php echo $emailid; ?></div>
        <?php
    }
}
?>
