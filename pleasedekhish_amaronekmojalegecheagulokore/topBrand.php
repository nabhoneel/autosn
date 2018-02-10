<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Assist Customer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" media="screen" href="./css/assist.css" />
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="./js/jquery.min.js"></script>
	<script src="./bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
    <?php
    $conn = new mysqli('localhost', 'root', '', 'automobile');
    if ($conn->connect_error)
    {
      die("Connection failed: " . $conn->connect_error);
    }
    $sql ="select `company name` from `car sold` group by `company name` order by count(`company name`) desc";
    $result = $conn->query($sql);
    $i=1;
    if ($result->num_rows > 0)
    {
     //output data of each row
   while($row = $result->fetch_assoc())
    {
        echo "Rank $i: " . $row["company name"]. "<br>";
        $i=$i+1;
    }
    }
    ?>
</body>

</html>
