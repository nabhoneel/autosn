<?
include '../includes/verify.php';
verify();
include '../includes/connection.php';
include '../includes/utilities.php';
$email = $_POST["email"];
$results = $mysqli->query("SELECT * FROM `customer` WHERE `email id` = '$email'");
$userDetails = $results->fetch_array(MYSQLI_NUM);
?>
<div class="card">
  <h5 class="card-header"><?php echo $userDetails[0]; ?></h5>
  <div class="card-body">
    <p class="card-text">
        <b>Email ID:</b> <?php echo $userDetails[4]; ?><br>
        <b>Contact number:</b> <?php echo $userDetails[3]; ?><br>
        <b>Date of Birth:</b> <?php echo date_format(date_create($userDetails[1]), 'jS F Y'); ?><br>
        <b>Address:</b> <?php echo $userDetails[2]; ?><br>
    </p>
    <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#purchaseHistory" aria-expanded="false">Purchase History</button>
    <div class="collapse" id="purchaseHistory">
      <div class="card card-body" id="purchases" style="border: 0px;">
          <div style="display: grid; grid-template-columns: 50% 50%; grid-column-gap: 0.5em; grid-row-gap: 0.5em;">
              <?php
              $email = $_POST["email"];
              $results = $mysqli->query("SELECT * FROM `sold car` WHERE `sold to` = '$email'");

              foreach($results as $data) {
                  $card = explode(" ", $data["credit card number"]);
                  ?>
                  <div class="card">
                      <h5 class="card-header"><?php echo date_format(date_create($data["datetime"]), 'jS F Y'); ?></h5>
                      <div class="card-body">
                          <p class="card-text">
                              <b>Car:</b> <?php echo $data["company name"]." ".$data["model name"]; ?><br>
                              <b>Total Price:</b> <?php echo getRupees($data["total price"]); ?><br>
                              <b>Options availed:</b> <?php
                              $options_result = $mysqli->query("SELECT `option name`, `cost` FROM `sold car has options`, `options`
                                  WHERE `id`=`option id` AND `vehicle index`=".$data["vehicle index"]);
                              $options = "";
                              foreach($options_result as $i)
                                  $options .= $i["option name"].", ";
                              $options = substr($options, 0, strlen($options)-2);
                              echo $options;
                              ?><br>
                              <b>Card used:</b> <?php echo $card[0]." **** **** ".$card[3]; ?><br>
                          </p>
                      </div>
                  </div>
                  <?php
              }
              ?>
          </div>
      </div>
    </div>
  </div>
</div>
