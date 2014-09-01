
<?php
	$breadcrumb= array( 'name'=>$languageMantan['menu'],
						'url'=>$urlOptions.'menus',
						'sub'=>array('name'=>$languageMantan['all'])
					  );
	addBreadcrumbAdmin($breadcrumb);
?> 
	<?php
		function listCat($cat,$sau,$parent)
		{
			if($cat['id']>0)
			{
				echo '<option id="'.$parent.'" value="'.$cat['id'].'">';
				for($i=1;$i<=$sau;$i++)
				{
					echo '&nbsp&nbsp&nbsp&nbsp';
				}
				echo $cat['name'].'</option>';
			}
			foreach($cat['sub'] as $sub)
			{
				listCat($sub,$sau+1,$cat['id']);
			}
		}
		
		function showCat($chuyenmuc,$level,$link,$languageMantan)
		{
			
			foreach($chuyenmuc as $cat)
	        { 
	        	echo '
			            <tr>
			              <td>'; 
			    for($i=1;$i<=$level;$i++) echo '&nbsp;&nbsp;&nbsp;&nbsp;';
			    echo $cat['name'].'</td>
			              
			              <td align="center" >
			                <input class="btn btn-default" type="button" value="'.$languageMantan['use'].'" onclick="saveThem('."'".$cat['name']."'".','."'".$link.'/'.$cat['slug'].".html'".');">
			              </td>
			            </tr>';
			    
			    showCat($cat['sub'],$level+1,$type,$languageMantan);
	        }
		}
		
		function showTrinhDon($chuyenmuc,$webRoot,$level,$urlOptions,$idParent,$languageMantan,$idMenuShow)
		{
			$left= "'left'";
			$top= "'top'";
			$right= "'right'";
			$bottom= "'bottom'";
			
			foreach($chuyenmuc as $menu)
	        { 
	        	echo '<tr>
				          <td>
			          		  ';
			          		  
			    for($i=1;$i<=$level;$i++) echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';      		  
			    
			    echo      	      '<img src="'.$webRoot.'images/bg-list-item.png"> <a id="nameTD'.$menu['id'].'" href="'.$menu['url'].'" target="_blank">'.$menu['name'].'
			          		  </a>
				          	  <div id="urlTD'.$menu['id'].'" style="display: none;">'.$menu['url'].'</div>
				          </td>
				          
				          <td align="center" >
					          
					          <a onclick="diChuyen('.$top.','.$menu['id'].','.$idParent.')" title="'.$languageMantan['move'].'" class="topIcon" href="javascript: voind(0);">
						          <img src="'.$webRoot.'images/topIcon.png" />
					          </a>
					          
					          <a onclick="diChuyen('.$bottom.','.$menu['id'].','.$idParent.')" title="'.$languageMantan['move'].'" class="bottomIcon" href="javascript: voind(0);">
						          <img src="'.$webRoot.'images/bottomIcon.png" />
					          </a>
				          </td>
				          <td align="center" >
				          	  <input onclick="suaData('."'".$menu['id']."'".')" class="btn btn-default" type="button" value="'.$languageMantan['edit'].'" />
				          	  &nbsp;&nbsp;&nbsp;
				          	  <a class="btn btn-default" href="'.$urlOptions.'deleteMenus/'.$menu['id'].'/'.$idMenuShow.'" onclick="return confirm('."'".$languageMantan['areYouSureYouWantToRemove']."'".')">'.$languageMantan['delete'].'</a>
				          </td>
				        </tr>';
	        	
			    
			    showTrinhDon($menu['sub'],$webRoot,$level+1,$urlOptions,$menu['id'],$languageMantan,$idMenuShow);
	        }
		}
	?>
<style>
	#page-wrapper{
		float: left;
	}
</style>
	  <div class="thanhcongcu">
	      <div class="congcu" onclick="them();">
	        <span>
	          <input type="hidden" id="idDelete" value="" />
	          <input type="image" src="<?php echo $webRoot;?>images/add.png" />
	        </span>
	        <br/>
	        <?php echo $languageMantan['add'];?>
	      </div>
	      
	      
	  </div>
	  <div class="clear"></div>
	  
	  <div class="themTinh" id="themData"></div>
	  
	  <div class="clear"></div>
	  <center>
	  	  <form method="get" action="">
			  <select class="form-control" style="width: auto;display: inline;margin-bottom: 15px;" name="id" >
				  <option><?php echo $languageMantan['choose'].' '.$languageMantan['menuUser'];?></option>
				  <?php
					  foreach($menus as $menuUser)
					  {
					  	  if($menuShow['Option']['id']!=$menuUser['Option']['id'])
					  	  {
						  	  echo '<option value="'.$menuUser['Option']['id'].'">'.$menuUser['Option']['value']['name'].'</option>';
						  }
						  else
						  {
							  echo '<option selected="" value="'.$menuUser['Option']['id'].'">'.$menuUser['Option']['value']['name'].'</option>';
						  }
					  }
				  ?>
			  </select>
			  <input type="submit" value="<?php echo $languageMantan['show'];?>" class="btn btn-default" /> 
			  <input onclick="addNewMenu()" class="btn btn-default" type="button" value="<?php echo $languageMantan['addNew'];?>" />
	  	  </form>
	  </center>
	  <div style="width: 38%;float:left;">
	    <form action="" method="post" name="listForm">
	        <table id="listTable" cellspacing="0" class="table table-striped" style="width: 100%;">
	
	                <tr>
	                  <td align="center" colspan="2"><b><?php echo $languageMantan['menuSystem'];?></b></td>
	                  
	                </tr>
	                <?php
	                    
	                    foreach($trinhDon as $components)
	                    { ?>
	                        <tr>
	                          <td><?php echo $components['name'];?></td>
	                          
	                          <td align="center" >
	                            <input class="btn btn-default" type="button" value="<?php echo $languageMantan['use'];?>" onclick="saveThem('<?php echo $components['name'];?>','<?php echo $components['url'];?>');">
	                          </td>
	                        </tr>
	                        
	                    <?php 
	                    }
	                    ?>
	                    <tr>
	                      <td><b><?php echo $languageMantan['newsCategories'];?></b></td>
	                      <td></td>
	                    </tr>
	                    <?php
	                    	showCat($categoryNotice,0,$urlNotices.'cat',$languageMantan);
	                    ?>	                    
	                    <tr>
	                      <td><b><?php echo $languageMantan['pages'];?></b></td>
	                      <td></td>
	                    </tr>
	                    <?php
	                    foreach($pages as $page)
	                    { 
	                    	?>
	                        <tr>
	                          <td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $page['Notice']['title'];?></td>
	                          
	                          <td align="center" >
	                            <input class="btn btn-default" type="button" value="<?php echo $languageMantan['use'];?>" onclick="saveThem('<?php echo $page['Notice']['title'];?>','<?php echo getUrlNotice($page['Notice']['id']);?>');">
	                          </td>
	                        </tr>
	                    <?php }
	                    ?>
	                    
	
	        </table>
	    </form>
	  </div>
	  <div class="taovien" style="float:right;width:60%;">
	  	<form action="" method="post" name="listForm">
		   <table id="listTable" cellspacing="0" class="table table-striped" style="width: 100%;">
	            <tr>
	              <td align="center" colspan="3">
	              	<?php 
	              		echo '<b>'.$languageMantan['menuUser'].'</b>';
		              	if($menuShow['Option']['value']['name'])
		              	{
			              	echo ': '.$menuShow['Option']['value']['name'];
			              	?>
			              	<input onclick="editInfoMenu('<?php echo $menuShow['Option']['value']['name'];?>','<?php echo $menuShow['Option']['id'];?>')" class="btn btn-default" type="button" value="<?php echo $languageMantan['edit'];?>" /> 
			              	<input onclick="deleteOneMenu('<?php echo $menuShow['Option']['id'];?>')" class="btn btn-default" type="button" value="<?php echo $languageMantan['delete'];?>" />
		              	<?php }
	              	?> 
	              </td>
	            </tr>
	            
	            <tr>
		          <td align="center" ><div><?php echo $languageMantan['title'];?></div></td>	 
		          <td align="center"><?php echo $languageMantan['move'];?></td>         
		          <td align="center" ><div style="width:130px;"><?php echo $languageMantan['choose'];?></div></td>
		        </tr>
		        
		        <?php
		        	showTrinhDon($menuShow['Option']['value']['category'],$webRoot,0,$urlOptions,0,$languageMantan,$menuShow['Option']['id']);
			        
		        ?>
		   </table>
		   
		   
	  	</form>  
	  </div>
	  <select id="listParent" style="display: none;">
	  	<option value="0"><?php echo $languageMantan['rootCategories'];?></option>
		<?php
			foreach($menuShow['Option']['value']['category'] as $cat)
			{
				listCat($cat,1,0);
	
			}	
		?>
	  </select>
	<script type="text/javascript">
		var st;
		var idMenuShow= '<?php echo $menuShow['Option']['id'];?>';
		var urlWeb="<?php echo $urlOptions;?>";
		var urlNow="<?php echo $urlNow;?>";
		
		function setCheckedValue(radioObj) {
			if(!radioObj)
		    {
				return;
		    }
			var radioLength = radioObj.length;
		
			for(var i = 0; i < radioLength; i++)
		    {
				radioObj[i].checked = false;
			}
		}
		setCheckedValue(document.forms['listForm'].elements['idXoa']);
		
		function diChuyen(type, idMenu,idParent)
		{
			$.ajax({
		      type: "POST",
		      url: urlWeb+"changeMenus",
		      data: { type:type, idMenu:idMenu, idParent:idParent, idMenuShow:idMenuShow}
		    }).done(function( msg ) { 	
			  		window.location= urlNow;	
			 })
			 .fail(function() {
					window.location= urlNow;
				});  
		}
		
		// Replaces all instances of the given substring.
		function replaceAll(strTarget, strSubString, string)
		{
			var strText = string;
			var intIndexOfMatch = strText.indexOf( strTarget );
			while (intIndexOfMatch != -1){
			strText = strText.replace( strTarget, strSubString )
			 
			intIndexOfMatch = strText.indexOf( strTarget );
			}
			return( strText );
		}
		
		function suaData(id)
		{
			var nameTD= document.getElementById("nameTD"+id).innerHTML;
			var urlTD= document.getElementById("urlTD"+id).innerHTML;
			nameTD= replaceAll('&nbsp;', '',nameTD);
			urlTD= replaceAll('&nbsp;', '',urlTD);
			
			var parent= document.getElementById("listParent").innerHTML;
			
			st= "<form method='post' action='"+urlWeb+"saveMenus'><input type='hidden' name='idMenuShow' value='"+idMenuShow+"' /><table class='table table-striped'><tr><td><?php echo $languageMantan['parentCategories'];?></td><td><select name='idParent' id='parent'>"+parent+"</select></td></tr><tr><td><?php echo $languageMantan['title'];?></td><td><input type='text' name='name' class='form-control' value='"+nameTD+"' /></td></tr><tr><td><?php echo $languageMantan['link'];?></td><td><input class='form-control' type='text' name='url' value='"+urlTD+"' /></td></tr><tr><td><input type='hidden' value='"+id+"' name='idTD'/> <input  type='submit' name='submit' value='<?php echo $languageMantan['save'];?>' class='btn btn-default' /></td></tr></table></form>";
		    document.getElementById("themData").innerHTML= st;
		    
		    var x=document.getElementById("parent");
			var i,j,idParent,truoc= 0;
			for (i=0;i<x.length;i++)
			{
				if(id == x.options[i].value)
				{
					idParent= x.options[i].id;
					for (j=0;j<x.length;j++)
					{
						if(idParent == x.options[j].value)
						{
							x.options[j].selected= "selected";
							break;
						}
					}
					break;
					
				}
				
			}
			
			$('#themData').lightbox_me({
		    centered: true, 
		    onLoad: function() { 
		        $('#themData').find('input:first').focus()
		        }
		    });
			
		  }
		
		
		function them()
		{
			var parent= document.getElementById("listParent").innerHTML;
			
		    st= "<form method='post' action='"+urlWeb+"saveMenus'><input type='hidden' name='idMenuShow' value='"+idMenuShow+"' /><table class='table table-striped'><tr><td><?php echo $languageMantan['parentCategories'];?></td><td><select name='idParent' id='parent'>"+parent+"</select></td></tr><tr><td><?php echo $languageMantan['title'];?></td><td><input class='form-control' type='text' name='name' value='' /></td></tr><tr><td><?php echo $languageMantan['link'];?></td><td><input type='text' class='form-control' name='url' value='' /></td></tr><tr><td><input  type='submit' name='submit' value='<?php echo $languageMantan['save'];?>' class='btn btn-default' /></td></tr></table></form>";
		    document.getElementById("themData").innerHTML= st;
		    
		    $('#themData').lightbox_me({
		    centered: true, 
		    onLoad: function() { 
		        $('#themData').find('input:first').focus()
		        }
		    });
		}
		
		function saveThem(name,url)
		{
		    $.ajax({
		      type: "POST",
		      url: urlWeb+"saveMenus",
		      data: { name:name, url:url, idMenuShow:idMenuShow}
		    }).done(function( msg ) { 	
			  		window.location= urlNow;	
			 })
			 .fail(function() {
					window.location= urlNow;
				});  
		    
		}
		
		function editInfoMenu(name,id)
		{
			st= '<form method="post" action="'+urlWeb+'saveInfoMenu"><input type="hidden" name="id" value="'+id+'" /><table class="table table-striped"><tr><td>ID:</td><td>'+id+'</td></tr><tr><td><?php echo $languageMantan['title'];?>:</td><td><input class="form-control"  type="text" name="name" id="name" value="'+name+'" /></td></tr><tr><td colspan="2"><input  type="submit" value="<?php echo $languageMantan['save'];?>" class="btn btn-default" /></td></tr></table></form>';
		    document.getElementById("themData").innerHTML= st;
		    
		    $('#themData').lightbox_me({
		    centered: true, 
		    onLoad: function() { 
		        $('#themData').find('input:first').focus()
		        }
		    });
		}
		
		function addNewMenu()
		{
			st= '<form method="post" action="'+urlWeb+'saveInfoMenu"><table class="table table-striped"><tr><td><?php echo $languageMantan['title'];?>:</td><td><input class="form-control"  type="text" name="name" id="name" value="" /></td></tr><tr><td colspan="2"><input  type="submit" value="<?php echo $languageMantan['save'];?>" class="btn btn-default" /></td></tr></table></form>';
		    document.getElementById("themData").innerHTML= st;
		    
		    $('#themData').lightbox_me({
		    centered: true, 
		    onLoad: function() { 
		        $('#themData').find('input:first').focus()
		        }
		    });
		}
		
		function deleteOneMenu(idMenu)
		{
			var check= confirm('<?php echo $languageMantan['areYouSureYouWantToRemove'];?>');
			if(check)
			{
				$.ajax({
			      type: "POST",
			      url: urlWeb+"deleteOneMenu",
			      data: { idMenu:idMenu}
			    }).done(function( msg ) { 	
				  		window.location= urlNow;	
				 })
				 .fail(function() {
						window.location= urlNow;
					});  
			}  
		}
	</script>
</div>


