<?php
	$breadcrumb= array( 'name'=>$languageMantan['account'],
						'url'=>$urlAdmins.'account',
						'sub'=>array('name'=>$languageMantan['changePassword'])
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
            }

        ?>
    </div>
    <form action="<?php echo $urlAdmins;?>changePass" method="post" name="account" class="taovienLimit">
        <input type="hidden" value="<?php echo $userAdmins['Admin']['id'];?>" name="id" />
        <table cellspacing="0" class="table table-striped">
            <tr>
                <td width="160"><?php echo $languageMantan['account'];?></td>
                <td><?php echo $userAdmins['Admin']['user'];?></td>
            </tr>
            <tr>
                <td><?php echo $languageMantan['oldPassword'];?></td>
                <td><input type="password" name="passOld" value="" size="40" AUTOCOMPLETE="off" /></td>
            </tr>
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

