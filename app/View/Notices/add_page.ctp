<?php
	$breadcrumb= array( 'name'=>$languageMantan['pages'],
						'url'=>$urlNotices.'listPages',
						'sub'=>array('name'=>$languageMantan['addNew'])
					  );
	addBreadcrumbAdmin($breadcrumb);
?>  
  
    <script type="text/javascript">

	    var urlWeb="<?php echo $urlNotices;?>";
	
	
	    function createSlug()
		{
		  var str= document.getElementById("title").value;
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
		
		  document.getElementById("slug").value= str;
		}
			
	    function saveThemNotices()
	    {
	        var tieude= document.getElementById("title").value;
	        
	        if(tieude == '')
	        {
		        alert('<?php echo $languageMantan['youMustFillOutTheInformationBelow'];?>');
	        }
	        else
	        {
	
	            document.dangtin.submit();
	
	        }
	
	    }
	
	</script>
	
	<div class="thanhcongcu">
	
	
	    <div class="congcu" onclick="saveThemNotices();">
	
	        <span id="save">
	
	          <input type="image" src="<?php echo $webRoot;?>images/save.png" />
	
	        </span>
	
	        <br/>
	
	        <?php echo $languageMantan['save'];?>
	
	    </div>
	</div>
	
	<div class="clear"></div>
	
	<div id="content">
	
	<form action="<?php echo $urlNotices;?>savePages" method="post" name="dangtin" enctype="multipart/form-data">
	
	    <input type="hidden" value="<?php echo $news['Notice']['id'];?>" name="id" />
	    <input type="hidden" value="<?php echo $news['Notice']['slug'];?>" name="slug" id="slug" />
	    
	    <table class="table" cellspacing="0">
	
	        <tr>
	
	            <td width="50%">
					<p><?php echo $languageMantan['title'];?> (*)</p>
					<p><input type="text" class="form-control" onkeyup="createSlug();" onchange="createSlug();" name="title" id='title' value="<?php echo $news['Notice']['title'];?>" /></p>
				</td>
				<td>
					<p><?php echo $languageMantan['author'];?></p>
					<p><input type="text" class="form-control" name="author" id='author' value="<?php echo $news['Notice']['author'];?>" /></p>
				</td>
	            
	
	        </tr>
	
	        <tr>
	
	            <td height="85">
					<p><?php echo $languageMantan['keyWord'];?></p>
					<p>
						<input type="text" name="key" id='key' value="<?php echo $news['Notice']['key'];?>" class="form-control" />
					</p>
				</td>
	
	            <td height="85">
					<p><?php echo $languageMantan['ilustration'];?></p>
					<p>
						<?php showUploadFile($webRoot,'image','image',$news['Notice']['image'],$languageMantan);?>
					</p>
				</td>
	
	        </tr>
	
	        <tr>
	
	            <td colspan="2">
					<p><?php echo $languageMantan['content'];?></p>
					<p>
						<?php
							showEditorInput($webRoot,'contentPage','content',$news['Notice']['content']);
						?>
					</p>
				</td>
	        </tr>
	    </table>
	
	</form>
	
	
	</div>
