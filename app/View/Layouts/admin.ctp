<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
		Mantan System <?php echo ' | '.$userAdmins['Admin']['infoSite']['title'];?>
	</title>
	<link rel="shortcut icon" href="<?php echo $webRoot;?>images/favicon.png">
	
    <!-- Core CSS - Include with every page -->
    <link href="<?php echo $webRoot;?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $webRoot;?>font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Blank -->

    <!-- SB Admin CSS - Include with every page -->
    <link href="<?php echo $webRoot;?>css/sb-admin.css" rel="stylesheet">
    
    <!-- JS -->
    <script type="text/javascript" src="<?php echo $webRoot;?>js/jquery-1.7.2.min.js"></script>
    <script src="<?php echo $webRoot;?>js/jquery.lightbox_me.js" type="text/javascript" charset="utf-8"></script>

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
                <a target="_blank" class="navbar-brand" href="http://mantansource.com">Mantan Admin v1.3</a>
                <?php
	                if($infoSite['Option']['value']['title'])
	                {
		                echo '<a target="_blank" class="navbar-brand" href="'.$urlHomes.'">'.$infoSite['Option']['value']['title'].'</a> ';
	                }
                ?>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo $urlAdmins.'account/'.$userAdmins['Admin']['id'];?>"><i class="fa fa-user fa-fw"></i> <?php echo $languageMantan['changePassword'];?></a>
                        </li>
                        <li><a href="<?php echo $urlOptions.'infoSite';?>"><i class="fa fa-gear fa-fw"></i> <?php echo $languageMantan['setting'];?></a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo $urlAdmins.'logout';?>"><i class="fa fa-sign-out fa-fw"></i> <?php echo $languageMantan['logout'];?></a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="side-menu">
                        <?php
                        	global $hookMenuAdminMantan;
                        	
                        	if(!is_array($hookMenuAdminMantan)) $hookMenuAdminMantan= array();
                        	
	                    	$menus= array();
		                    $menus[0]= array('name'=>$languageMantan['setting'],'url'=>$urlOptions.'infoSite');
		                    $menus[1]= array('name'=>$languageMantan['news'],
		                    				 'url'=>$urlNotices.'listNotices',
		                    				 'sub'=>array( array('name'=>$languageMantan['allPosts'],'url'=>$urlNotices.'listNotices'),
		                    							   array('name'=>$languageMantan['newsCategories'],'url'=>$urlOptions.'categoryNotice')
		                    							) 
		                    			   );
		                    $menus[2]= array('name'=>$languageMantan['pages'],'url'=>$urlNotices.'listPages');
		                    $menus[3]= array('name'=>$languageMantan['album'],'url'=>$urlAlbums.'listAlbums');
		                    $menus[4]= array('name'=>$languageMantan['video'],'url'=>$urlVideos.'listVideos');
		                    
		                    $menus[5]= array('name'=>$languageMantan['languages'],'url'=>$urlOptions.'languages');
		                    $menus[6]= array('name'=>$languageMantan['appearance'],
		                    				 'url'=>$urlOptions.'themes',
		                    				 'sub'=>array( array('name'=>$languageMantan['interfaceStorage'],'url'=>$urlOptions.'themes'),
		                    							   array('name'=>$languageMantan['menu'],'url'=>$urlOptions.'menus')
		                    							) 
		                    			   );
		                    $menus[7]= array('name'=>$languageMantan['expand'],'url'=>$urlOptions.'plugins');
		                    			   
		                    $hookMenuAdminMantan= array_merge($menus,$hookMenuAdminMantan);
		                    
		                    $menus= array();
		                    $menus[0]= array('name'=>$languageMantan['account'],'url'=>$urlAdmins.'listAccount');
		                    $menus[1]= array('name'=>$languageMantan['logout'].' ['.$userAdmins['Admin']['user'].']','url'=>$urlAdmins.'logout');
		                    $hookMenuAdminMantan= array_merge($hookMenuAdminMantan,$menus);
		                    
		                    foreach($hookMenuAdminMantan as $menu)
							{
								if(!$menu['sub'])
								{
									if($urlNow!=$menu['url'])
									{
										$class= '';
									}
									else
									{
										$class= 'active';
									}
									
									echo '  <li class="'.$class.'">
						                        <a href="'.$menu['url'].'"><i class="fa fa-files-o fa-fw"></i> '.$menu['name'].'</a>
						                    </li>';
								}
								else
								{
									$class='';
									if($menu['url']==$urlNow)
									{
										$class= 'active';
									}
									else
									{
										foreach($menu['sub'] as $subMenu)
										{
											if($urlNow==$subMenu['url'])
											{
												$class= 'active';
												break;
											}
										}
									}
									
									echo ' <li class="'.$class.'">
						                        <a href="'.$menu['url'].'"><i class="fa fa-files-o fa-fw"></i> '.$menu['name'].'<span class="fa arrow"></span></a>
						                        <ul class="nav nav-second-level">';
						                        foreach($menu['sub'] as $sub)
						                        {
						                        	if($urlNow==$sub['url'])
													{
														$classSub= 'activeSub';
													}
													else
													{
														$classSub= '';
													}
													
						                        	echo '  <li class="'.$classSub.'">
								                                <a href="'.$sub['url'].'">'.$sub['name'].'</a>
								                            </li>';
						                        }
						            echo        '</ul>
						                    </li>';
								}
							}
	                    ?>
                    </ul>
                    <!-- /#side-menu -->
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <?php echo $this->Session->flash(); ?>
	    	<?php echo $this->fetch('content'); ?>
	    	<?php echo $this->element('sql_dump'); ?>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Core Scripts - Include with every page -->
    <script src="<?php echo $webRoot;?>js/bootstrap.min.js"></script>
    <script src="<?php echo $webRoot;?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
    
    <!-- Page-Level Plugin Scripts - Blank -->

    <!-- SB Admin Scripts - Include with every page -->
    <script src="<?php echo $webRoot;?>js/sb-admin.js"></script>

    <!-- Page-Level Demo Scripts - Blank - Use for reference -->

</body>

</html>
