<?php
	$languageMantanActive= $languageMantan;
	$breadcrumb= array( 'name'=>$languageMantanActive['languages'],
						'url'=>$urlOptions.'languages',
						'sub'=>array('name'=>$languageMantanActive['all'])
					  );
	addBreadcrumbAdmin($breadcrumb);
?> 	
	
	
	<div class="clear"></div>
	
	<div id="content">
	
	<form action="" method="post" name="duan" class="taovienLimit" >
	
	    <table id="listTin" cellspacing="0" class="table table-striped">
	
	        <tr>
		        <td align="center"><b><?php echo $languageMantanActive['flag'];?></b></td>
	            <td><b><?php echo $languageMantanActive['languageFile'];?></b></td>
	            <td><b><?php echo $languageMantanActive['languageName'];?></b></td>
	            <td><b><?php echo $languageMantanActive['langugeCode'];?></b></td>
	            <td align="center"><b><?php echo $languageMantanActive['status'];?></b></td>
	
	        </tr>
	        <?php
		        
	            foreach($listFile as $file)
	            {
	            	if($file!='images')
	            	{
		            	$filename = $urlLocal['urlLocalLanguage']."/".$file;
		            	include($filename);
	            		$str= '';
	            		
	            		if($languages['code']!=$codeLanguageMatan)
	            		{
	            			$str='<a class="btn btn-default" href="'.$urlOptions.'activeLanguage/'.$codeLanguageMatan.'/'.$file.'">'.$languageMantanActive['use'].'</a>';
	            		}
	            		else
	            		{
	            			$str='<input class="btn btn-default" type="button" value="'.$languageMantanActive['using'].'" />';
	            		}	
	            			
	            		
	                    echo '<tr>
	                    		  <td align="center"><img src="http://'.$infoSite['Option']['value']['domain'].'/app/Language/'.$flagLanguageMatan.'" width="16" /></td>
	                              <td>'.$file.'</td>
	                              <td>'.$nameLanguageMatan.'</td>
	                              <td>'.$codeLanguageMatan.'</td>
	                              <td align="center">'.$str.'</td>
	                          </tr>';
	                
                    }
	            }
	
	        ?>
	
	    </table>
		
	</form>
</div>

<script type="text/javascript">

var urlWeb="<?php echo $urlNotices;;?>";
var urlNow="<?php echo $urlNow;?>";

function deleteData(idDelete)
{
    var check= confirm('<?php echo $languageMantanActive['areYouSureYouWantToRemove'];?>');
	if(check)
	{
		$.ajax({
	      type: "POST",
	      url: urlWeb+"deleteNotice",
	      data: { id:idDelete}
	    }).done(function( msg ) { 	
		  		window.location= urlNow;	
		 })
		 .fail(function() {
				window.location= urlNow;
			});  
	}
}
</script>
