	<div class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                    	<form method="get" action="<?php echo $urlNotices;?>search" role="form">
	                        <input type="text" class="form-control" placeholder="Search..." name="key" value="<?php echo $_GET['key'];?>">
	                        <span class="input-group-btn">
		                        <button class="btn btn-default" type="submit">
		                            <i class="fa fa-search"></i>
		                        </button>
							</span>
						</form>
                    </div>
                    <!-- /input-group -->
                </li>
                <?php
					$menus= $modelOption->getOptionById('538a3ce2793260e605000000');
					foreach($menus['Option']['value']['category'] as $categoryMenu)
					{
						if(count($categoryMenu['sub'])>0)
						{
							$class='';
							if($categoryMenu['url']==$urlNow)
							{
								$class= 'active';
							}
							else
							{
								foreach($categoryMenu['sub'] as $subMenu)
								{
									if($urlNow==$subMenu['url'])
									{
										$class= 'active';
										break;
									}
								}
							}
							
							echo ' <li class="'.$class.'">
										<a href="'.$categoryMenu['url'].'" ><span onclick="window.location= '."'".$categoryMenu['url']."'".'">'.$categoryMenu['name'].'</span><span class="fa arrow"></span></a>
										<ul class="nav nav-second-level">';
											foreach($categoryMenu['sub'] as $subMenu)
											{
												if($urlNow==$subMenu['url'])
												{
													$classSub= 'activeSub';
												}
												else
												{
													$classSub= '';
												}
												echo '<li class="'.$classSub.'"><a href="'.$subMenu['url'].'">'.$subMenu['name'].'</a></li>';
											}
							echo		'</ul>
									</li>';
						}
						else
						{
							if($urlNow!=$categoryMenu['url'])
							{
								echo '<li><a href="'.$categoryMenu['url'].'">'.$categoryMenu['name'].'</a></li>';
							}
							else
							{
								echo '<li  class="active"><a href="'.$categoryMenu['url'].'">'.$categoryMenu['name'].'</a></li>';
							}
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