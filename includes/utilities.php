<?php

function getRupees($x) {
    $amount = (string)$x;
    $decimal_point_position = strpos($amount, ".");
    if($decimal_point_position === false) $decimal_point_position = strlen($amount) - 1;
    else $decimal_point_position--;

    for($i=$decimal_point_position - 2; $i>0; $i-=2) {
        $amount = substr($amount, 0, $i).",".substr($amount, $i);

    }
    return "&#8377;".$amount;
}

?>
