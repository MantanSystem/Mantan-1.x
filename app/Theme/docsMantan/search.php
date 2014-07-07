<?php getHeader();?>
<?php getSidebar();?>
            

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Search for '<?php echo $_GET['key'];?>'</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <?php
	            foreach($listNotices as $notice)
	            {
		            echo '<a href="'.getUrlNotice($notice['Notice']['id']).'"><h3 id="grid-responsive-resets">'.$notice['Notice']['title'].'</h3></a><p>'.$notice['Notice']['introductory'].'</p>';
	            }
            ?>
            
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
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

<?php getFooter();?>    