<?php getHeader();?>
<?php getSidebar();?>
            

<div id="page-wrapper">
	<?php
		$infoNotice= $modelNotice->getNotice('538b4bd5793260093c000000');
	?>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo $infoNotice['Notice']['title'];?></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <?php echo $infoNotice['Notice']['content'];?>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

<?php getFooter();?>    