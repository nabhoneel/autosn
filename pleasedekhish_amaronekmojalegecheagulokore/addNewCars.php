<?php
//session_start();
if(empty($_SESSION)) header("Location: http://localhost/autosn?previous=addCar");
if(!($_SESSION["verification"] == "true")) header("Location: http://localhost/autosn?previous=addCar");

$c = $_SESSION["employer"];
?>

<html>
<head>
<title> Insert Car Information </title>
</head>

<body>

<?php
include "connection.php";
function value_set($val)
{
	if (!isset($_POST[$val]))
		return null;
	else
		return $_POST[$val];
}
if ($_SERVER['REQUEST_METHOD']=='POST')
{
	$cname=$_POST['cmane'];
	$mname=$_POST['mname'];
	$seats=$_POST['$seats'];
	$price=$_POST['$price'];
	$sql = "INSERT INTO model('company name','model name','`number of seats`','cost') VALUES('$cname','$mname','$seats','$price')";

 }
?>

</body>
</html>
