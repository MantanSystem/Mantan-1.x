<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="<?php echo $urlThemeActive;?>images/favicon.png">

    <!-- Core CSS - Include with every page -->
    <link href="<?php echo $urlThemeActive;?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $urlThemeActive;?>font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Dashboard -->
    <link href="<?php echo $urlThemeActive;?>css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    <link href="<?php echo $urlThemeActive;?>css/plugins/timeline/timeline.css" rel="stylesheet">

    <!-- SB Admin CSS - Include with every page -->
    <link href="<?php echo $urlThemeActive;?>css/sb-admin.css" rel="stylesheet">
	<?php mantan_header();?>
</head>

<body>

    <div id="wrapper">

        <nav class="navbar navbar-default" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo $urlHomes;?>"><?php echo $infoSite['Option']['value']['title']; ?></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" href="https://www.facebook.com/MantanSystem" target="_blank">
                        <i class="fa fa-facebook fa-fw"></i>
                    </a>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" href="https://github.com/MantanSystem" target="_blank">
                        <i class="fa fa-github fa-fw"></i>
                    </a>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" href="https://twitter.com/MantanSystem" target="_blank">
                        <i class="fa fa-twitter fa-fw"></i>
                    </a>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" href="mailto:mantansource@gmail.com">
                        <i class="fa fa-envelope fa-fw"></i>
                    </a>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->