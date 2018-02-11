<?php
session_start();
$type = $username = $employer = $verify = "";

if(isset($_SESSION["valid"])) {
    if($_SESSION["valid"] == "true") {
        $type = $_SESSION["type"];
        $username = $_SESSION["$type username"];
        if($type == "dealer") $employer = $_SESSION["employer"];
        $verify = "true";
    }
} else $verify = "false";

function getUsername() {
    return $GLOBALS['username'];
}

function getUsertype() {
    return $GLOBALS['type'];
}

function getEmployer() {
    return $GLOBALS['employer'];
}

function verify() {
    if(!isset($_SESSION["valid"])) {header("Location: ./");}
}

?>
