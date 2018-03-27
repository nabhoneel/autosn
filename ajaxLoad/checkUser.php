<?php
session_start();

include '../includes/connection.php';
$user = $mysqli->query("SELECT * FROM `members` WHERE `username`='".$_POST["username"]."';");

$_SESSION["valid"] = "false";
if($user->num_rows == 0) echo "Your account does not exist";
else {
    foreach($user as $u) {
        if($u["password"] != $_POST["password"]) echo "The password you entered was wrong";
        else {
            $_SESSION["valid"] = "true";
            $_SESSION["type"] = $u["role"];
            $_SESSION[$u["role"]." username"] = $u["username"];
            if($u["role"] == "dealer") $_SESSION["employer"] = $u["employer"];
            echo "true";
        }
    }
}

?>
