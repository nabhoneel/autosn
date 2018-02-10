<?php
//session_start();
if(empty($_SESSION)) header("Location: http://localhost/autosn?previous=checkUser");
if(!($_SESSION["verification"] == "true")) header("Location: http://localhost/autosn?previous=checkUser");

$c = $_SESSION["employer"];
?>

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

	<script>
	function addCars() {
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("cars").innerHTML = this.responseText;
            }
        };
		var inputElements = document.getElementsByClassName('options');
		var checkedValues = [document.getElementById("number of seats").value];
		for(var i=0; inputElements[i]; ++i) {
			if(inputElements[i].checked) {
				checkedValues.push(inputElements[i].value);
				}
		}
        xmlhttp.open("POST", "addNewCars.php", true);
		xmlhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xmlhttp.send(JSON.stringify(checkedValues));
	}
	</script>
</head>

<body>
    <div class="container">
        <form class="form-group">
            <div class="row">
                <div class="col-sm-2">
                  <?php
                  function value_set($val)
                  {
                     if (!isset($_POST[$val]))
                       return null;
                        else
                          return $_POST[$val];
                  }
                  if ($_SERVER['REQUEST_METHOD']=='POST')
                    $_SESSION["seats"] = $_POST['`number of seats`'];
                  ?>
                    <input type="number" class="form-control" id="number of seats" placeholder="number of seats" min="1" max="7">
                </div>
                <div class="col-sm-9">
                    <?php
                            include 'connection.php';
                            $rows = $mysqli->query("select `id`, `option name` from `options`;");
                            ?>
                            <b>Select options available :</b>
                            <?php
                            foreach($rows as $option)
                            { ?>
                    <label class="control control--checkbox"><?php echo $option["option name"];?>
                                <input type="checkbox" value="<?php echo $option["id"];?>" class="options"/>
                                <div class="control__indicator"></div>
                                </label>
                    <?php }
                            ?>
                </div>
                <div class="col-sm-9">
                            <b>Select model name :</b>
                            <form method="post">
                            <select name="mname">
                            <?php
	                           $sql="SELECT distinct `model name` from MODEL where `company name`='$c' ORDER BY `model name` ASC";
	                           $result=$conn->query($sql);
	                           while($row=$result->fetch_assoc())
	                           {
	                              echo "<option value=' ".$row['model name']." '>". $row['model name']." </option>";
	                           }
                             $_SESSION["mname"] = mname;
                             ?>
                           </select> </form>
                </div>
                <div class="col-sm-9">
                          <?php
                          if ($_SERVER['REQUEST_METHOD']=='POST')
                            $_SESSION["price"] = $_POST['pr'];
                          ?>
                          <form method="post">
                          <br><b>Enter price : </b><input type="number" name="pr"  value="<?php echo value_set("pr");?>">
                          </form>
                </div>
                <div class="col-sm-1">
                    <button type="button" class="btn btn-outline-info" onmousedown="addCars()">Add <i class="fa fa-save" aria-hidden="true"></i></button>
                </div>
			</div>
			<div class="row" id="cars">
			</div>
        </form>
    </div>
    <?php $_SESSION["mname"] = '$c'; ?>
</body>

</html>
