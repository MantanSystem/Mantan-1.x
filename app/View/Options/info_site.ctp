
<?php
	$breadcrumb= array( 'name'=>$languageMantan['setting'],
						'url'=>$urlOptions.'infoSite',
						'sub'=>array('name'=>$languageMantan['information'])
					  );
	addBreadcrumbAdmin($breadcrumb);
?>  
    <script type="text/javascript">
	
	function save()
	{
	    var domain= document.getElementById("domain").value;
	    var email= document.getElementById("email").value;
	    
	    if(domain=='' || email=='' )
	    {
	        document.getElementById("status").innerHTML= "<font color='red'><?php echo $languageMantan['youMustFillOutTheInformationBelow'];?></font>";
	    }
	    else
	    {
	        document.listForm.submit();
	    }
	}
	</script>
	  <div class="thanhcongcu">
	
	      <div class="congcu" onclick="save();">
	        <input type="hidden" id="idChange" value="" />
	        <span id="save">
	          <input type="image" src="<?php echo $webRoot;?>images/save.png" />
	        </span>
	        <br/>
	        <?php echo $languageMantan['save'];?>
	      </div>
	      
	
	  </div>
	  <div class="clear" style="height: 10px;margin-left: 15px;" id='status'>
		  <?php
			$return= $_GET['return'];
	
	        if( $return==1)
	        {
	          echo "<font color='red'>".$languageMantan['saveSuccess']."</font>";
	        }
	        else if( $return==3)
	        {
	          echo "<font color='red'>".$languageMantan['saveFailed']."</font>";
	        }
	        
	        if(!$infoSite['Option']['value']['domain'])
	        {
		        $urlBase= Router::url('/');
 	
			 	if(strpos(strtolower($urlBase),'index.php/'))
			 	{
				 	$urlBase= substr_replace($urlBase, '', -11);  
			 	}
			 	else
			 	{
				 	$urlBase= substr_replace($urlBase, '', -1);  
			 	}
			 	$placeholder= $_SERVER['SERVER_NAME'].$urlBase;
	        }
		  ?>
	  </div>
	
	  <div class="taovien">
	    <form action="<?php echo $urlOptions;?>saveInfoSite" method="post" name="listForm">
	        <table id="listTable" width="650" cellspacing="0" cellpadding="0" class="table table-striped">
	          <tr>
	            <td align="right" width="100"><?php echo $languageMantan['webstieName'];?></td>
	            <td align="left"><input class="form-control" type="text" value="<?php echo $infoSite['Option']['value']['title'];?>" name="title" id="title" /></td>
	          </tr>
	          
	          <tr>
	            <td align="right" ><?php echo $languageMantan['domainName'];?> (*)</td>
	            <td align="left"><input placeholder="<?php echo $placeholder;?>" class="form-control" type="text" value="<?php echo $infoSite['Option']['value']['domain'];?>" name="domain" id="domain" /></td>
	          </tr>
	          <tr>
	            <td align="right" ><?php echo $languageMantan['adress'];?></td>
	            <td align="left">
	            	<textarea class="form-control" rows="5" name="address" id="address"><?php echo $contact['Option']['value']['address'];?></textarea>
	            </td>
	          </tr>
	          <tr>
	            <td align="right" ><?php echo $languageMantan['email'];?> (*)</td>
	            <td align="left"><input class="form-control" type="text" value="<?php echo $contact['Option']['value']['email'];?>" name="email" id="email" /></td>
	          </tr>
	          <tr>
	            <td align="right" ><?php echo $languageMantan['telephoneNumber'];?></td>
	            <td align="left"><input class="form-control" type="text" value="<?php echo $contact['Option']['value']['fone'];?>" name="fone" id="fone" /></td>
	          </tr>
	          <tr>
	            <td align="right" ><?php echo $languageMantan['faxNumber'];?></td>
	            <td align="left"><input class="form-control" type="text" value="<?php echo $contact['Option']['value']['fax'];?>" name="fax" id="fax" /></td>
	          </tr>
	          <tr>
	            <td align="right" ><?php echo $languageMantan['keyWord'];?></td>
	            <td align="left"><input class="form-control" type="text" value="<?php echo $infoSite['Option']['value']['key'];?>" name="key" id="key" /></td>
	          </tr>
	          <tr>
	            <td align="right" ><?php echo $languageMantan['description'];?></td>
	            <td align="left"><input class="form-control" type="text" value="<?php echo $infoSite['Option']['value']['description'];?>" name="description" id="description" /></td>
	          </tr>
	      </table>
	    </form>
	  </div>
