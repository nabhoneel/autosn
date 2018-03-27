<script>
function showCars() {
    if(document.getElementById("number of seats").value == 0) {
        $("#need_seats").show();
        $("#need_seats").css('opacity', '1');
        window.setTimeout(function() {
            $("#need_seats").fadeTo(500, 0).slideUp(500, function(){
                $(this).hide();
            });
        }, 4000);
        return;
        return;
    }
    var inputElements = document.getElementsByClassName('options');
    var checkedValues = [];
    for(var i=0; inputElements[i]; ++i) {
        if(inputElements[i].checked) {
            checkedValues.push(inputElements[i].value);
        }
    }
    $.ajax({
        url: "ajaxLoad/generateCars.php",
        method: "POST",
        data: {
            number: document.getElementById("number of seats").value,
            options: JSON.stringify(checkedValues)
        },
        success: function(data) {
            $("#cars").html(data);
        }
    });
}
</script>

<div class="item1">
    <input type="number" class="form-control" id="number of seats" placeholder="number of seats" min="1" max="7">
</div>
<div class="item2">
    <?php
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
    <button type="button" class="btn btn-outline-info" onclick="showCars()">Cars <i class="fa fa-hand-o-down" aria-hidden="true"></i></button>
</div>
<div style="display: none; grid-column: 1 / span 3;" id="alert_success" class="alert alert-info alert-dismissible fade show item5" role="alert">
  <strong>Wait!</strong> You need to select a car first. (Enter the number of required seats and hit the 'Cars' button, if you haven't already)
</div>
<div style="display: none; grid-column: 1 / span 4;" id="need_seats" class="alert alert-info alert-dismissible fade show item5" role="alert">
  First enter the <strong>number of required seats</strong> for generating a list of cars
</div>

<div class="item4" id="cars">
</div>
