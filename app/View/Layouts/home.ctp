<?php include($themeActive.'header.php');?>
<?php include($urlLocal['urlLocalPlugin'].'/'.$urlFilePlugin);?>

<?php 
	if($_GET['noSidebar']!=1)
	{
		include($themeActive.'sidebar.php');
	}
?>
<?php include($themeActive.'footer.php');?>
<?php showErrorMantanHeader();?>