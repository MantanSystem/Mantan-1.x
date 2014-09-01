
<?php
	$breadcrumb= array( 'name'=>$languageMantan['news'],
						'url'=>$urlNotices.'listNotices',
						'sub'=>array('name'=>$languageMantan['allPosts'])
					  );
	addBreadcrumbAdmin($breadcrumb);
?> 	
	<div class="thanhcongcu">
	
	    <div class="congcu">
	
	        <a href="<?php echo $urlNotices;?>addNotices">
	
	          <span>
	
	            <img src="<?php echo $webRoot;?>images/add.png" />
	
	          </span>
	
	            <br/>
	
	            <?php echo $languageMantan['add'];?>
	
	        </a>
	
	    </div>
	
	</div>
	
	<div class="clear"></div>
	
	<div id="content">

	<?php
			function listCat($cat,$sau,$idCat)
			{
				if($cat['id']>0)
				{
					if($cat['id'] != $idCat)
					{
						echo '<option value="'.$cat['id'].'">';
					}
					else
					{
						echo '<option  selected="selected" value="'.$cat['id'].'">';
					}
					
					for($i=1;$i<=$sau;$i++)
					{
						echo '&nbsp&nbsp&nbsp&nbsp';
					}
					echo $cat['name'].'</option>';
				}
				foreach($cat['sub'] as $sub)
				{
					listCat($sub,$sau+1,$idCat);
				}
			}
	?>
	
	<form action="" method="get" class="taovienLimit" style="width: 680px;margin-left: 10px;">
		<?php echo $languageMantan['categories'];?>
		<select name="category" id="category" class="form-control" style="width: auto;display: inline;margin-bottom: 15px;">
		<option value="-1"><?php echo $languageMantan['all'];?></option>
		<?php
			foreach($chuyenmuc as $cat)
			{
				listCat($cat,1,$_GET['category']);
	
			}	
		?>
		</select>
		
		<input class="btn btn-default" type="submit" value="<?php echo $languageMantan['search'];?>">
	</form>
	
    <table id="listTin" cellspacing="0" class="table table-striped">

        <tr>

            <td align="center"><?php echo $languageMantan['title'];?></td>

            <td align="center"><?php echo $languageMantan['categories'];?></td>

            <td align="center" width="75"><?php echo $languageMantan['event'];?></td>

            <td align="center" width="225"><?php echo $languageMantan['choose'];?></td>

        </tr>
        <?php
	        
            foreach($listNotices as $tin)

            {
                    echo '<tr>

                              <td><a href="'.getUrlNotice($tin['Notice']['id']).'">'.$tin['Notice']['title'].'</a></td>

                              <td>';
                    $listCatNoti= array();
                    foreach($tin['Notice']['category'] as $catNoti)
                    {
	                    array_push($listCatNoti, $nameCat[$catNoti]);
                    }
                    echo implode(",", $listCatNoti);
                    echo '</td>
                              <td align="center">';



                    if($tin['Notice']['event']==1) echo '<img src="'.$webRoot.'images/Actions-dialog-ok-icon.png" />';

                    else echo '<img src="'.$webRoot.'images/Actions-edit-delete-icon.png" />';

                    echo    '</td>
                    			<td align="center">
                    			<a class="btn btn-default" href="'.$urlNotices.'addNotices/'.$tin['Notice']['id'].'">'.$languageMantan['edit'].'</a>
                    			&nbsp;
                    			<input class="btn btn-default" type="button" value="'.$languageMantan['delete'].'" onclick="deleteData('."'".$tin['Notice']['id']."'".');">
                    			</td>
                            </tr>';


            }

        ?>

    </table>
	<p>
    <?php
	$urlParams = $this->params['url'];
	unset($urlParams['url']);
	$this->Paginator->options(array('url' => array('?' => http_build_query($urlParams))));
    echo "&nbsp;";

    echo $this->Paginator->prev('« '.$languageMantan['previousPage'].' ', null, null, array('class' => 'disabled')); //Shows the next and previous links

    echo " | ".$this->Paginator->numbers()." | "; //Shows the page numbers

    echo $this->Paginator->next(' '.$languageMantan['nextPage'].' »', null, null, array('class' => 'disabled')); //Shows the next and previous links

    echo " Page ".$this->Paginator->counter(); // prints X of Y, where X is current page and Y is number of pages

    ?>
	</p>
	
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
