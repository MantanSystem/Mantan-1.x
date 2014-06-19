<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo $this->webroot;?>images/favicon.png" type="image/ico" rel="icon">
    <title>Mantan 1.1</title>

    <!-- Core CSS - Include with every page -->
    <link href="<?php echo $this->webroot;?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $this->webroot;?>font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- SB Admin CSS - Include with every page -->
    <link href="<?php echo $this->webroot;?>css/sb-admin.css" rel="stylesheet">

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Install Mantan System</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="<?php echo $urlAdmins;?>startInstall">
                        	<input type="hidden" value="<?php echo Router::url('/', true);?>" name="domain" />
                        	<table class="table">
	                        	<tr>
		                        	<td>Account</td>
		                        	<td><input class="form-control" value="admin" placeholder="User" name="user" type="text" autofocus /></td>
	                        	</tr>
	                        	<tr>
		                        	<td>Password</td>
		                        	<td><input class="form-control" placeholder="Password" name="Passwd1" type="password" value=""></td>
	                        	</tr>
	                        	<tr>
		                        	<td>Password Again</td>
		                        	<td><input class="form-control" placeholder="Password Again" name="Passwd2" type="password" value=""></td>
	                        	</tr>
	                        	<tr>
		                        	<td>Database Name</td>
		                        	<td><input class="form-control" placeholder="Database Name" name="database" type="text" /></td>
	                        	</tr>
	                        	<tr>
		                        	<td>Database User</td>
		                        	<td><input class="form-control" placeholder="Database User" name="databaseUser" type="text" /></td>
	                        	</tr>
	                        	<tr>
		                        	<td>Database Password</td>
		                        	<td><input class="form-control" placeholder="Database Password" name="databasePassword" type="password" value=""></td>
	                        	</tr>
                        	</table>
                        	<input type="submit" value="Start" class="btn btn-lg btn-success btn-block" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Core Scripts - Include with every page -->
    <script src="<?php echo $this->webroot;?>js/jquery-1.10.2.js"></script>
    <script src="<?php echo $this->webroot;?>js/bootstrap.min.js"></script>
    <script src="<?php echo $this->webroot;?>js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="<?php echo $this->webroot;?>js/sb-admin.js"></script>

</body>

</html>
