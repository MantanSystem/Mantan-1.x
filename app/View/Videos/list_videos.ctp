 
<?php
	$breadcrumb= array( 'name'=>$languageMantan['video'],
						'url'=>$urlVideos,
						'sub'=>array('name'=>$languageMantan['all'])
					  );
	addBreadcrumbAdmin($breadcrumb);
?>   
	<script type="text/javascript">
		var urlWeb="<?php echo $urlVideos;?>";
		var urlNow="<?php echo $urlNow;?>";
		
		function addDataNew()
		{
			document.getElementById("title").value= '';
			document.getElementById("codeVideo").value= '';
			document.getElementById("idVideo").value= '';
			document.getElementById("slug").value= '';
			
		    $('#themData').lightbox_me({
		    centered: true, 
		    onLoad: function() { 
		        $('#themData').find('input:first').focus()
		        }
		    });
		}
		
		function deleteData(id)
		{
			var r= confirm("<?php echo $languageMantan['areYouSureYouWantToRemove'];?>");
			if(r==true)
			{
				$.ajax({
			      type: "POST",
			      url: urlWeb+"deleteData",
			      data: { id:id}
			    }).done(function( msg ) { 	
				  		window.location= urlNow;	
				 })
				 .fail(function() {
						window.location= urlNow;
					}); 
			}
		}
		
		function createSlug(type)
		{
		  if(type==1)
		  {
			  var str= document.getElementById("titleEdit").value;
		  }
		  else
		  {
			  var str= document.getElementById("title").value;
		  }
		  
		  str = str.replace(/^\s+|\s+$/g, ''); // trim
		  str = str.toLowerCase();
		
		  // remove accents, swap ñ for n, etc
		  var from = "đuúùũụủưứừữựửeéèẽẹẻêếềễệểoóòõọỏôồốỗộổơớờỡợởaàáãạảăằắặẵẳâấầậẫẩiíìĩịỉyýỳỹỵỷ·/_,:;";
		  var to   = "duuuuuuuuuuuueeeeeeeeeeeeooooooooooooooooooaaaaaaaaaaaaaaaaaaiiiiiiyyyyyy------";
		  for (var i=0, l=from.length ; i<l ; i++) {
		    str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
		  }
		
		  str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
		    .replace(/\s+/g, '-') // collapse whitespace and replace by -
		    .replace(/-+/g, '-'); // collapse dashes
		  
		  if(type==1)
		  {
			  document.getElementById("slugEdit").value= str;
		  }
		  else
		  {
			  document.getElementById("slug").value= str;
		  }
		  
		}
		
		function editData(id,name,code,slug)
		{
			document.getElementById("title").value= name;
			document.getElementById("codeVideo").value= code;
			document.getElementById("idVideo").value= id;
			document.getElementById("slug").value= slug;
			
			$('#themData').lightbox_me({
		    centered: true, 
		    onLoad: function() { 
		        $('#themData').find('input:first').focus()
		        }
		    });
		}
	</script>
	
	<div class="thanhcongcu">
	      <div class="congcu"  onclick="addDataNew();">
	          <span>
	            <img src="<?php echo $webRoot;?>images/add.png" />
	          </span>
	          <br/>
	          <?php echo $languageMantan['add'];?>
	      </div>
	      
	  </div>
	  <div class="clear"></div>
	  <div id="content">
	  <div id="themData">
		  <form method="post" action="<?php echo $urlVideos;?>saveData" name="dangtin">
		  	  <input type="hidden" value="" name="id" id="idVideo" />
		  	  <input type="hidden" value="" name="slug" id="slug" />
		      <p><?php echo $languageMantan['title'];?></p>
		      <input type="text" onkeyup="createSlug(0);" onchange="createSlug(0);" name="name" value="" id="title" class="form-control"/>
		      <p><?php echo $languageMantan['youtubeCode'];?></p>
		      <input type="text" name="code" value="" id="codeVideo" class="form-control"/>
		      <br/>
		      <p><input type='submit' value='<?php echo $languageMantan['save'];?>' class="btn btn-default" /></p>
		  </form>
	  </div>
	  <div class="clear"></div>
	  <br />
	  <form action="" method="post" name="listData">
	    <?php
	        if($listData)
	        {
	    ?>
	    	<table class="table table-striped">
		    	<tr>
			    	<td width="200"><?php echo $languageMantan['ilustration'];?></td>
			    	<td><?php echo $languageMantan['title'];?></td>
			    	<td width="165"><?php echo $languageMantan['choose'];?></td>
		    	</tr>
		    	<?php
                  foreach($listData as $video)
                  { ?>
                  	<tr>
	                  	<td>
		                  	<a target="_blank" href="http://www.youtube.com/watch?v=<?php echo $video['Video']['code'];?>">
	                            <img width="200px" src="http://img.youtube.com/vi/<?php echo $video['Video']['code'];?>/0.jpg">
	                        </a>
	                  	</td>
	                  	<td>
		                  	<?php echo $video['Video']['name'];?>
	                  	</td>
	                  	<td>
		                  	<input class="btn btn-default" onclick="deleteData('<?php echo $video['Video']['id'];?>')" type="button" value="<?php echo $languageMantan['delete'];?>" />
                          &nbsp;
                            <input class="btn btn-default" onclick="editData('<?php echo $video['Video']['id'];?>','<?php echo $video['Video']['name'];?>','<?php echo $video['Video']['code'];?>','<?php echo $video['Video']['slug'];?>')" type="button" value="<?php echo $languageMantan['edit'];?>" />
	                  	</td>
                  	</tr>
                  <?php }?>
	    	</table>
	              
	
	    <?php }
	
	    ?>
	
	   </form>
	   <div class="clear"></div>
	   
	   <?php
	        echo "&nbsp;";
	        echo $this->Paginator->prev('« '.$languageMantan['previousPage'].' ', null, null, array('class' => 'disabled')); //Shows the next and previous links
	        echo " | ".$this->Paginator->numbers()." | "; //Shows the page numbers
	        echo $this->Paginator->next(' '.$languageMantan['nextPage'].' »', null, null, array('class' => 'disabled')); //Shows the next and previous links
	        echo " Page ".$this->Paginator->counter(); // prints X of Y, where X is current page and Y is number of pages
	    ?>
	    
	
	    
	</div>
	