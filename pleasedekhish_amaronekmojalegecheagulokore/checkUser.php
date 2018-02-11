<?php

include 'includes/connection.php';

$whichUser = $_POST["id"];
$username = $_POST["username"];
$query = "SELECT * from MEMBERS WHERE `username` = \"".$username."\"";

$result = $mysqli->query($query);
if($result->num_rows > 0)
{
    $row = $result->fetch_assoc();
    if($_POST["password"] == $row["password"])
    {
        session_start();
        $_SESSION["verification"] = "true";
        $_SESSION["username"] = $username;
        $_SESSION["role"] = $row["role"];
        $_SESSION["employer"] = $row["employer"];
        $r = $row["role"];;
        if(strcmp($r,"sales") == 0)
          header("Location: sales.php");
        else if(strcmp($r,"dealer") == 0)
            header("Location: dealer.php");
    }
    else displayError($whichUser, 1);
}
else displayError($whichUser, 2);

function displayError($whichUser, $status)
{
    if($whichUser == "customers") header("Location: index.php?tab=login&status=".$status);
    else header("Location: index.php?tab=member&status=".$status);
}
?>
