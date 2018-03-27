<?php
include '../includes/verify.php';
verify();
include '../includes/connection.php';

if($mysqli->query("INSERT INTO `members` (`username`, `password`, `role`, `employer`) VALUES ('".$_POST["username"]."', '".$_POST["password"]."', 'sales', NULL);") === TRUE) echo "true";
else echo "Sorry. That username already exists";
?>
