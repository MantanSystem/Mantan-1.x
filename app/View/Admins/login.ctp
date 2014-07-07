<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo $webRoot;?>images/favicon.png" type="image/ico" rel="icon">
    <title>Login Mantan System</title>
	<meta name="description" content="<?php echo $infoSite['Option']['value']['description'];?>">
	<meta name="keywords" content="<?php echo $infoSite['Option']['value']['key'];?>">
			  
    <!-- Core CSS - Include with every page -->
    <link href="<?php echo $webRoot;?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $webRoot;?>font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- SB Admin CSS - Include with every page -->
    <link href="<?php echo $webRoot;?>css/sb-admin.css" rel="stylesheet">

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In Mantan System</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="<?php echo $urlAdmins;?>loginAfter">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="User" name="user" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="Passwd" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" value="Login" class="btn btn-lg btn-success btn-block" />
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Core Scripts - Include with every page -->
    <script src="<?php echo $webRoot;?>js/jquery-1.10.2.js"></script>
    <script src="<?php echo $webRoot;?>js/bootstrap.min.js"></script>
    <script src="<?php echo $webRoot;?>js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="<?php echo $webRoot;?>js/sb-admin.js"></script>

</body>

</html>
