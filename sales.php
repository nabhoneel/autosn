<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sales Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="./css/sales.css">
    <link rel="stylesheet" type="text/css" media="screen" href="./css/assist.css" />
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="./js/jquery.min.js"></script>
    <script src="./bootstrap/js/bootstrap.min.js"></script>
    <script>
      var index;
      function getValues(id) {
        index = id;
      }

      function order() {
        var flag = false;
        var checks = document.getElementsByTagName("input");
        for(var i=0; i<checks.length; i++) {
            if(checks[i].type=='radio' && checks[i].checked == true) flag = true;
        }
        if(flag) window.location.href='./generateBill.php?index='+index;
        else {
            $("#alert_success").show();
            $("#alert_success").css('opacity', '1');
            window.setTimeout(function() {
                $("#alert_success").fadeTo(500, 0).slideUp(500, function(){
                    $(this).remove();
                });
            }, 4000);
            return;
        }
      }
    </script>
</head>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" style="color: white;">Hello, &lt;Person&gt;</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <h5><span class="badge badge-info" style="margin-top: 9px;">Rank #10</span></h5>
      </li>
    </ul>
    <button type="button" class="btn btn-outline-light"  data-toggle="modal" data-target="#assistModal" style="margin: 0 1em">Assist Customer</button>
    <button type="button" class="btn btn-outline-light" onclick="window.location.href='./logout.php'">Logout</button>
  </div>
</nav>

<body>

<div class="modal fade " id="assistModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="longTitle">Cars' List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php include 'assist.php'; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="order()">Proceed</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>
