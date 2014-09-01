
<?php
	$breadcrumb= array( 'name'=>$languageMantan['account'],
						'url'=>$urlAdmins.'listAccount',
						'sub'=>array('name'=>$languageMantan['all'])
					  );
	addBreadcrumbAdmin($breadcrumb);
?> 	
	<div class="thanhcongcu">
	
	    <div class="congcu">
	    	<a href="<?php echo $urlAdmins.'account/';?>">
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
	
	
    <table id="listTin" cellspacing="0" class="table table-striped">

        <tr>

            <td align="center"><?php echo $languageMantan['account'];?></td>

            <td align="center"><?php echo $languageMantan['email'];?></td>

            <td align="center"><?php echo $languageMantan['information'];?></td>

            <td align="center" width="225"><?php echo $languageMantan['choose'];?></td>

        </tr>
        <?php
	        
            foreach($listData as $tin)

            {
                    echo '<tr>

                              <td>'.$tin['Admin']['user'].'</td>
                              <td>'.$tin['Admin']['email'].'</td>
                              <td>'.nl2br($tin['Admin']['information']).'</td>
                    		  <td align="center">
                    			<a class="btn btn-default" href="'.$urlAdmins.'account/'.$tin['Admin']['id'].'">'.$languageMantan['edit'].'</a>
                    			&nbsp;
                    			<input class="btn btn-default" type="button" value="'.$languageMantan['delete'].'" onclick="deleteData('."'".$tin['Admin']['id']."'".');">
                    		  </td>
                            </tr>';


            }

        ?>

    </table>
	<p>
    <?php
	

    echo $this->Paginator->prev('« '.$languageMantan['previousPage'].' ', null, null, array('class' => 'disabled')); //Shows the next and previous links

    echo " | ".$this->Paginator->numbers()." | "; //Shows the page numbers

    echo $this->Paginator->next(' '.$languageMantan['nextPage'].' »', null, null, array('class' => 'disabled')); //Shows the next and previous links

    echo " Page ".$this->Paginator->counter(); // prints X of Y, where X is current page and Y is number of pages

    ?>
	</p>
	
</div>

<script type="text/javascript">

var urlWeb="<?php echo $urlAdmins;?>";
var urlNow="<?php echo $urlNow;?>";

function deleteData(idDelete)
{
    var check= confirm('<?php echo $languageMantan['areYouSureYouWantToRemove'];?>');
	if(check)
	{
		$.ajax({
	      type: "POST",
	      url: urlWeb+"deleteAccount",
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
