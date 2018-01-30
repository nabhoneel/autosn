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

</head>
<body>
    <div class="container">    
            <form class="form-group">
                <div class="row">
                    <div class="col-sm-5">
                        <input type="number" class="form-control" id="number of seats" placeholder="number of seats">
                    </div>
                    <div class="col-sm-5">
                            <?php                             
                            include 'connection.php';
                            $rows = $mysqli->query("select `id`, `option name` from `options`;");

                            foreach($rows as $option)
                            { ?>
                                <label class="control control--checkbox"><?php echo $option["option name"];?>
                                <input type="checkbox" value="option<?php echo $option["id"];?>"/>
                                <div class="control__indicator"></div>
                                </label>                                
                            <?php }                                                        
                            ?>                     
                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-outline-info">Show Cars! <i class="fa fa-hand-o-down" aria-hidden="true"></i></button>
                    </div>
                </div>
            </form>
    </div>
</body>
</html>



