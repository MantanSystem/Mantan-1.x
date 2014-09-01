<?php
	$breadcrumb= array( 'name'=>$languageMantan['account'],
						'url'=>$urlAdmins.'listAccount',
						'sub'=>array('name'=>$languageMantan['information'])
					  );
	addBreadcrumbAdmin($breadcrumb);
?>     
	<script type="text/javascript">
	
	function saveData()
	{
	
	    document.account.submit();
	
	}
	
	</script>
	
	<div class="thanhcongcu">
	      <div class="congcu">
	        <span id="save">
	          <input type="image" onclick="saveData();" src="<?php echo $webRoot;?>images/save.png" />
	        </span>
	        <br/>
	        <?php echo $languageMantan['save'];?>
	      </div>
	</div>
  <div class="clear"></div>
  <div id="content">
    <div style="padding: 10px;padding-left: 15px;">
        <?php
            switch($_GET['return'])
            {
              case 1:  echo '<font color="red">'.$languageMantan['saveSuccess'].'</font>'; break;
              case -1: echo '<font color="red">'.$languageMantan['saveFailed'].'</font>'; break;
              case -3: echo '<font color="red">'.$languageMantan['saveFailed'].'</font>'; break;
            }

        ?>
    </div>
    
    <form action="<?php echo $urlAdmins;?>saveAccount" method="post" name="account" class="taovienLimit">
        <input type="hidden" value="<?php echo $account['Admin']['id'];?>" name="id" />
        <table cellspacing="0" class="table table-striped">
            <tr>
                <td width="160"><?php echo $languageMantan['account'];?></td>
                <td>
                	<?php 
                		if($account['Admin']['user'])
                		{
	                		echo $account['Admin']['user'];
                		}
                		else
                		{
	                		echo '<input type="text" name="user" size="40" value="" />';
                		}
                	?>
                </td>
            </tr>
            <tr>
                <td><?php echo $languageMantan['email'];?></td>
                <td><input type="text" name="email" size="40" value="<?php echo $account['Admin']['email'];?>" /></td>
            </tr>
            <tr>
                <td><?php echo $languageMantan['information'];?></td>
                <td>
                	<textarea name="information" cols="38" rows="5"><?php echo nl2br($account['Admin']['information']);?></textarea>
                </td>
            </tr>
            <?php if($account){ ?>
            <tr>
                <td><?php echo $languageMantan['oldPassword'];?></td>
                <td><input type="password" name="passOld" value="" size="40" AUTOCOMPLETE="off" /></td>
            </tr>
            <?php }?>
            <tr>
                <td><?php echo $languageMantan['newPassword'];?></td>
                <td><input type="password" name="pass1" value="" size="40" AUTOCOMPLETE="off" /></td>
            </tr>
            <tr>
                <td><?php echo $languageMantan['enterTheNewPassword'];?></td>
                <td><input type="password" name="pass2" value="" size="40" AUTOCOMPLETE="off" /></td>
            </tr>
        </table>
    </form>

  </div>

