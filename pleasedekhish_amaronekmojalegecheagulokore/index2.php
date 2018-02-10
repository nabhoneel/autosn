
<html lang="en">
<head>
  <title>Automobile</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <script src="./js/jquery.min.js"></script>
  <script src="./js/bootstrap.min.js"></script>

  <style>
  .outer {
    display: table;
    height: 100%;
    width: 100%;
    }

    .middle {
        display: table-cell;
        vertical-align: middle;
    }

    .inner {
        margin: auto;
        padding: auto;
        width: 100%; /*whatever width you want*/
    }

    .container {
        top: 0;
        width: 35em;
    }
  </style>
</head>

<?php
$status = "";

if(isset($_GET["previous"]))
    $previousPage = $_GET["previous"];
if(!empty($_GET) && (isset($_GET["status"]) || isset($_GET["tab"])))
{
    $status = $_GET["status"];
    $tab = $_GET["tab"];
}

function generateErrorMessage($message)
{
    ?>
    <p align=center class="text-danger"><kbd><?php echo $message; ?></kbd></p>
    <?php
}
?>

<body background="slide4.jpg">
<div class="outer">
  <div class="middle">
    <div class="inner">
        <div class="container">
          <div class="tab-content">
            <div id="login" class="tab-pane fade in active">
              <font color="white"><h1 align=center>Login</h1><br></font>
                  <form action="checkUser.php" method="post">
                  <input type=hidden value="customers" name="id">
                  <div class="form-group">
                    <font color="white" size="6"><label for="username">Username:</label></font>
                    <input type="text" class="form-control" name="username">
                  </div>
                  <div class="form-group">
                    <font color="white" size="6"><label for="password">Password:</label></font>
                    <input type="password" class="form-control" name="password">
                  </div>
                  <?php if($status == "1") generateErrorMessage("Incorrect password");
                          if($status == "2") generateErrorMessage("No account under that username exists"); ?>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>

</body>
</html>
