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

<div class="item1">
    <input type="number" class="form-control" id="number of seats" placeholder="number of seats" min="1" max="7">
</div>
<div class="item2">
    <?php
    include 'connection.php';
    $rows = $mysqli->query("select `id`, `option name` from `options`;");

    foreach($rows as $option)
    {
        if($option["id"]%5 == 0) echo "<br>"; ?>
        <label class="control control--checkbox"><?php echo $option["option name"];?>
            <input type="checkbox" value="<?php echo $option["id"];?>" class="options"/>
            <div class="control__indicator"></div>&nbsp;
        </label>
    <?php   }
    ?>
</div>
<div class="item3">
    <button type="button" class="btn btn-outline-info" onmousedown="showCars()">Cars <i class="fa fa-hand-o-down" aria-hidden="true"></i></button>
</div>
<div class="item4" id="cars">
</div>
