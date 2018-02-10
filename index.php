<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Automobile Company's MIS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="./js/jquery.min.js"></script>
    <script src="./bootstrap/js/bootstrap.min.js"></script>
    <script>
        $('.carousel').carousel();
    </script>
</head>
<body>
    <div class="backdrop"></div>
    <div class="container">
        <div class="glass">
            <div class="inner">
                <div class="card" style="width: 18rem;">
                    <span class="logo"><img src="images/logo.svg" alt="all in one" /></span>
                    <div class="card-body">
                        <h5 class="card-title" style="text-align: center;">Automobile Company Management</h5>
                            <div class="holder">
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Username</span>
                                  </div>
                                  <input type="text" class="form-control" id="username" placeholder="">
                                </div><div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Password</span>
                                  </div>
                                  <input type="password" class="form-control" id="password" placeholder="">
                                </div>
                            </div>
                            <span class="badge badge-pill badge-warning" id="error"></span>
                            <button type="submit" value="Login" class="btn btn-primary" onclick="verifyUser()">Login</button>
                            <script>
                                function verifyUser() {
                                    $.ajax({
                                        url: "ajaxLoad/checkUser.php",
                                        method: "POST",
                                        data: {
                                            username: $("#username").val(),
                                            password: $("#password").val()
                                        },
                                        success: function(data) {;
                                            if(data != "true") {
                                                $("#error").html(data);
                                                $("#error").css("display", "table");
                                            }
                                            else window.location = "redirect.php";
                                        }
                                    });
                                }
                            </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
