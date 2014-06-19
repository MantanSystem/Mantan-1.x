
<?php
	$breadcrumb= array( 'name'=>$languageMantan['appearance'],
						'url'=>$urlOptions.'themes',
						'sub'=>array('name'=>$languageMantan['interfaceStorage'])
					  );
	addBreadcrumbAdmin($breadcrumb);
?>   
	<script type="text/javascript">
		var urlWeb="<?php echo $urlOptions;?>";
		var urlNow="<?php echo $urlNow;?>";
		
		function active(theme)
		{
			$.ajax({
		      type: "POST",
		      url: urlWeb+"changeTheme",
		      data: { theme:theme}
		    }).done(function( msg ) { 	
			  		window.location= urlNow;	
			 })
			 .fail(function() {
					window.location= urlNow;
				}); 
		}
	</script>
	

	  <div class="clear"></div>
	  <div id="content">
	
	  <form action="" method="post" name="duan">
	  	<table class="table table-striped">
		  	<tr>
			  	<td width="150" align="center"><b><?php echo $languageMantan['ilustration']?></b></td>
			  	<td><b><?php echo $languageMantan['appearance']?></b></td>
			  	<td width="100" align="center"><b><?php echo $languageMantan['status']?></b></td>
		  	</tr>
		  	<?php
	            foreach($listFile as $folder)
	            { 
	            	$img= 'http://'.$infoSite['Option']['value']['domain'].'/app/Theme/'.$folder.'/thumb.jpg';
	            	$file_headers = @get_headers($img);
	            	if($file_headers[0] == 'HTTP/1.1 404 Not Found')
	            	{
		            	$img= 'http://'.$infoSite['Option']['value']['domain'].'/app/webroot/images/thumbDefault.jpg';
	            	}
	                ?>
	                  <tr>
	                  	<td align="center"><img src="<?php echo $img;?>" class="thumbImage" /></td>
	                  	<td><?php echo $folder;?></td>
	                  	<td align="center">
		                  	<?php
	                            if($folder!=$theme)
	                                echo '<a class="btn btn-default" onclick="active('."'".$folder."'".')" href="javascript:void(0);">'.$languageMantan['use'].'</a>';
	                            else
	                                echo '<a class="btn btn-default" href="javascript:void(0);">'.$languageMantan['using'].'</a>';
	                        ?>
	                  	</td>
	                  </tr>
	                <?php 
	            }
	        ?>
	  	</table>
        
	  </form>
	
	    
	</div>
	