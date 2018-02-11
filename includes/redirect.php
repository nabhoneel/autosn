<?php

session_start();
if($_SESSION["valid"] == "true") {
    $x = $_SESSION["type"];
    if($x == "dealer") header('Location: ../dealer.php');
    if($x == "sales") header('Location: ../sales.php');
    if($x == "admin") header('Location: ../admin.php');
    exit();
}

?>
