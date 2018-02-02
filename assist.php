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
	function showCars() {
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
        xmlhttp.open("POST", "generateCars.php", true);
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
                    <input type="number" class="form-control" id="number of seats" placeholder="number of seats" min="1" max="7">
                </div>
                <div class="col-sm-9">
                    <?php                             
                            include 'connection.php';
                            $rows = $mysqli->query("select `id`, `option name` from `options`;");

                            foreach($rows as $option)
                            { ?>
                    <label class="control control--checkbox"><?php echo $option["option name"];?>
                                <input type="checkbox" value="<?php echo $option["id"];?>" class="options"/>
                                <div class="control__indicator"></div>
                                </label>
                    <?php }                                                        
                            ?>
                </div>
                <div class="col-sm-1">
                    <button type="button" class="btn btn-outline-info" onmousedown="showCars()">Cars <i class="fa fa-hand-o-down" aria-hidden="true"></i></button>
                </div>
			</div>
			<div class="row" id="cars">
			</div>
        </form>
    </div>
</body>

</html>