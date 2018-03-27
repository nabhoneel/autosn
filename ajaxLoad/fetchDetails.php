<?php
include '../includes/verify.php';
verify();
include '../includes/connection.php';
$email = $_POST["email"];
$results = $mysqli->query("SELECT * FROM `customer` WHERE `email id` = '$email'");
$userDetails = $results->fetch_array(MYSQLI_NUM);
?>

  <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-default">Name</span>
      </div>
      <input type="text" id="oldname" readonly class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?php echo $userDetails[0]; ?>">
  </div>
  <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-default">Date of Birth</span>
      </div>
      <input type="date" id="olddob" readonly class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?php echo $userDetails[1]; ?>">
  </div>
  <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-default">Contact</span>
          <span class="input-group-text" id="inputGroup-sizing-default">(+91)</span>
      </div>
      <input type="text" id="oldcontact" readonly class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?php echo $userDetails[3]; ?>">
  </div>
  <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-default">Address</span>
      </div>
      <input type="text" id="oldaddress" readonly class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="<?php echo $userDetails[2]; ?>">
  </div>
<?php

?>
