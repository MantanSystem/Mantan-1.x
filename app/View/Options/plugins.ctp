
<?php
	$breadcrumb= array( 'name'=>$languageMantan['expand'],
						'url'=>$urlOptions.'plugins',
						'sub'=>array('name'=>$languageMantan['expandedList'])
					  );
	addBreadcrumbAdmin($breadcrumb);
?> 	
	
	<div class="clear"></div>
	
	<div id="content">
	
	
	
    <table id="listTin" cellspacing="0" class="table table-striped">

        <tr>

            <td align="center"><?php echo $languageMantan['folder'];?></td>
            
            <td align="center"><?php echo $languageMantan['status'];?></td>
            
            <td align="center"><?php echo $languageMantan['information'];?></td>

        </tr>
        <?php
	        
            foreach($listFileShow as $file)
            {
            	if($file['name']!='Mongodb')
            	{
            		$str= '';
            		if($file['active']>=0)
            		{
            			if($file['active']==0)
            			{
	            			$str='<p><a href="'.$urlOptions.'activePlugin/'.$file['name'].'">'.$languageMantan['activate'].'</a> | ';
	            		}
	            		else if($file['active']==1)
            			{
	            			$str='<p><a href="'.$urlOptions.'deactivePlugin/'.$file['name'].'">'.$languageMantan['lock'].'</a> | ';
	            		}
	            		$str= $str.'<a onclick="return confirm('."'".$languageMantan['areYouSureYouWantToRemove']."'".');" href="'.$urlOptions.'deletePlugin/'.$file['name'].'">'.$languageMantan['delete'].'</a></p>';
            		}
            		else
            		{
	            		$str= '<p><a onclick="return confirm('."'".$languageMantan['areYouSureYouWantToRemove']."'".');" href="'.$urlOptions.'deletePlugin/'.$file['name'].'">'.$languageMantan['delete'].'</a></p>';
            		}
                    echo '<tr>

                              <td>'.$file['name'].$str.'</td>

                              <td align="center">';
                              
                    switch($file['active'])
                    {
	                    case 1: echo '<img title="'.$languageMantan['activate'].'" src="'.$webRoot.'images/Actions-dialog-ok-icon.png" />';break;
	                    case 0: echo '<img title="'.$languageMantan['lock'].'" src="'.$webRoot.'images/Actions-edit-delete-icon.png" />';break;
	                    case -1: echo '<img title="'.$languageMantan['delete'].'" src="'.$webRoot.'images/edit_delete.png" />';break;
	                    
                    }

                    echo    '</td>
                    		 <td>'.$file['info'].'</td>
                            </tr>';
                }

            }

        ?>

    </table>
</div>

<script type="text/javascript">

var urlWeb="<?php echo $urlNotices;;?>";
var urlNow="<?php echo $urlNow;?>";

function deleteData(idDelete)
{
    var check= confirm('<?php echo $languageMantan['areYouSureYouWantToRemove'];?>');
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
