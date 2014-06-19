<?php
	$breadcrumb= array( 'name'=>$languageMantan['album'],
						'url'=>$urlAlbums,
						'sub'=>array('name'=>$languageMantan['all'])
					  );
	addBreadcrumbAdmin($breadcrumb);
?> 
  
    <script type="text/javascript" src="<?php echo $webRoot;?>ckfinder/ckfinder.js"></script>
	<script type="text/javascript">
		var urlWeb="<?php echo $urlAlbums;?>";
		var urlNow="<?php echo $urlNow;?>";
	
	    function addAlbum()
	    {
	    	
	    	$('#editData').html('');
		    $('#themData').lightbox_me({
				centered: true,
				onLoad: function() {
				$('#themData').find('input:first').focus()
				}
			}); 
	    }
	
	    function createSlug(idSlug,idTitle)
		{
		  var str= document.getElementById(idTitle).value;
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
		
		  document.getElementById(idSlug).value= str;
		}
		
		function editAlbum(idAlbum)
		{
			$.ajax({
		      type: "POST",
		      url: urlWeb+"editInfoAlbum",
		      data: { id:idAlbum}
		    }).done(function( msg ) { 	
		    		$('#editData').html(msg);
		    		
			  		$('#editData').lightbox_me({
						centered: true,
						onLoad: function() {
						$('#editData').find('input:first').focus()
						}
					}); 	
			 })
			 .fail(function() {
					window.location= urlWeb;
				});  
		}
		
		function editDate(ngay,thang,nam, idEdit)
	    {
		    
		    var i,str;
		    str= '<select name="ngay">';
		    for(i=1;i<=31;i++)
		    {
			    if(i!=ngay)
			    {
				    str= str+'<option value="'+i+'"><?php echo $languageMantan['date'];?> '+i+'</option>';
			    }
			    else
			    {
				    str= str+'<option selected="selected" value="'+i+'"><?php echo $languageMantan['date'];?> '+i+'</option>';
			    }
		    }
		    str= str+'</select>&nbsp;&nbsp;';
		    
		    str= str+ '<select name="thang">';
		    for(i=1;i<=12;i++)
		    {
			    if(i!=thang)
			    {
				    str= str+'<option value="'+i+'"><?php echo $languageMantan['month'];?> '+i+'</option>';
			    }
			    else
			    {
				    str= str+'<option selected="selected" value="'+i+'"><?php echo $languageMantan['month'];?> '+i+'</option>';
			    }
		    }
		    str= str+'</select>&nbsp;&nbsp;';
		    
		    str= str+ '<select name="nam">';
		    for(i=nam-10;i<=nam+10;i++)
		    {
			    if(i!=nam)
			    {
				    str= str+'<option value="'+i+'"><?php echo $languageMantan['year'];?> '+i+'</option>';
			    }
			    else
			    {
				    str= str+'<option selected="selected" value="'+i+'"><?php echo $languageMantan['year'];?> '+i+'</option>';
			    }
		    }
		    str= str+'</select>&nbsp;&nbsp;';
		    
		    document.getElementById(idEdit).innerHTML= str;
	    }
	    
	    function saveThemData()
		{
			  var title= document.getElementById("title").value;
			  var image= document.getElementById("image").value;
			  if(title != '' && image !='')
			  {
			    document.dangtin.submit();
			  }
			  else
			  {
				  alert('<?php echo $languageMantan['youMustFillOutTheInformationBelow'];?>');
				  return false;
			  }
		}
		
		function deleteData(idDelete)
		{
		    var check= confirm('<?php echo $languageMantan['areYouSureYouWantToRemove'];?>');
			if(check)
			{
				$.ajax({
			      type: "POST",
			      url: urlWeb+"deleteAlbum",
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
	
	<div class="thanhcongcu">
	      <div class="congcu" onclick="addAlbum();">
	          <span>
	            <img src="<?php echo $webRoot;?>images/add.png" />
	          </span>
	          <br/>
	          <?php echo $languageMantan['add'];?>
	      </div>
	      
	  </div>
	  <div class="clear"></div>
	  <div id="content">
	
	  <table class="table table-striped">
	  	<tr>
	  		<td><b><?php echo $languageMantan['ilustration']?></b></td>
	  		<td><b><?php echo $languageMantan['title']?></b></td>
	  		<td><b><?php echo $languageMantan['edit'].' '.$languageMantan['information'];?></b></td>
	  		<td><b><?php echo $languageMantan['edit'].' '.$languageMantan['image'];?></b></td>
	  		<td><b><?php echo $languageMantan['delete'].' '.$languageMantan['album'];?></b></td>
	  	</tr>
	  	<?php
            foreach($listNotices as $tin)
            { 
                ?>
                  <tr>
                      <td>
	                      <img class="thumbImage" src="<?php echo $tin['Album']['img'][0]['src'];?>">
                      </td>
                      <td>
	                      <?php echo $tin['Album']['title'];?>
                      </td>
                      <td>
	                      <input class="btn btn-default" type="button" value="<?php echo $languageMantan['edit'].' '.$languageMantan['information'];?>" onclick="editAlbum('<?php echo $tin['Album']['id'];?>');" />
                      </td>
                      <td>
	                      <a class="btn btn-default" href="<?php echo $urlAlbums.'infoAlbum/'.$tin['Album']['id'];?>"><?php echo $languageMantan['edit'].' '.$languageMantan['image'];?></a>
                      </td>
                      <td>
	                      <input class="btn btn-default" type="button" value="<?php echo $languageMantan['delete'].' '.$languageMantan['album'];?>" onclick="deleteData('<?php echo $tin['Album']['id'];?>');" />
                      </td>

                  </tr>
                <?php 
            }
        ?>
	  </table>
	  
	  
        
	
	
	    <div class="clear"></div>
	    <br /><br />
	    <?php
	        echo "&nbsp;";
	        echo $this->Paginator->prev('« '.$languageMantan['previousPage'].' ', null, null, array('class' => 'disabled')); //Shows the next and previous links
	        echo " | ".$this->Paginator->numbers()." | "; //Shows the page numbers
	        echo $this->Paginator->next(' '.$languageMantan['nextPage'].' »', null, null, array('class' => 'disabled')); //Shows the next and previous links
	        echo " Page ".$this->Paginator->counter(); // prints X of Y, where X is current page and Y is number of pages
	    ?>
	    </form>
	
	    
	</div>
	<div id="editData"></div>
	<div id="themData">
	    <form action="<?php echo $urlAlbums;?>saveAlbum" method="post" name="dangtin" >
	        <input type="hidden" value="<?php echo $news['Album']['id'];?>" name="id" />
	        <input type="hidden" value="<?php echo $news['Album']['slug'];?>" name="slug" id="slug" />
	        <table class="table table-striped">
	            <tr>
	                <td><?php echo $languageMantan['nameAlbum'];?> (*)</td>
	                <td><input type="text" onkeyup="createSlug('slug','title');" onchange="createSlug('slug','title');" name="title" id='title' value="<?php echo $news['Album']['title'];?>" class="form-control" /></td>
	            </tr>
	            <tr>
	                <td><?php echo $languageMantan['ilustration'];?> (*)</td>
	                <td>
	                	<?php showUploadFile($webRoot,'image','image',$news['Album']['image'],$languageMantan);?>
	                </td>
	            </tr>
	            <tr>
	                <td><?php echo $languageMantan['datePosted'];?></td>
	                <td id="ngayDang">
		                <?php
					        
					        if($news['Album']['time'])
					        {
						        $today= getdate($news['Album']['time']);
						        $str= '<select name="ngay">';
							    for($i=1;$i<=31;$i++)
							    {
								    if($i!=$today['mday'])
								    {
									    $str= $str.'<option value="'.$i.'">'.$languageMantan['date'].' '.$i.'</option>';
								    }
								    else
								    {
									    $str= $str.'<option selected="selected" value="'.$i.'">'.$languageMantan['date'].' '.$i.'</option>';
								    }
							    }
							    $str= $str.'</select>&nbsp;&nbsp;';
							    
							    $str= $str. '<select name="thang">';
							    for($i=1;$i<=12;$i++)
							    {
								    if($i!=$today['mon'])
								    {
									    $str= $str.'<option value="'.$i.'">'.$languageMantan['month'].' '.$i.'</option>';
								    }
								    else
								    {
									    $str= $str.'<option selected="selected" value="'.$i.'">'.$languageMantan['month'].' '.$i.'</option>';
								    }
							    }
							    $str= $str.'</select>&nbsp;&nbsp;';
							    
							    $str= $str. '<select name="nam">';
							    for($i=$today['year']-10;$i<=$today['year']+10;$i++)
							    {
								    if($i!=$today['year'])
								    {
									    $str= $str.'<option value="'.$i.'">'.$languageMantan['year'].' '.$i.'</option>';
								    }
								    else
								    {
									    $str= $str.'<option selected="selected" value="'.$i.'">'.$languageMantan['year'].' '.$i.'</option>';
								    }
							    }
							    $str= $str.'</select>&nbsp;&nbsp;';
							    
							    echo $str;
					        }
					        else
					        {
						        $today= getdate();
						        echo $today['mday'].'/'.$today['mon'].'/'.$today['year'];
						        echo '  &nbsp;&nbsp;&nbsp;
								        <a href="javascript:void(0)" onclick="editDate('.$today['mday'].','.$today['mon'].','.$today['year'].','."'".'ngayDang'."'".');" style="text-decoration: underline;">'.$languageMantan['edit'].'</a>';
					        }
					        
				        ?>
	                </td>
	            </tr>
	            <tr>
	                <td><?php echo $languageMantan['status'];?></td>
	                <td>
		                <input type="radio" value="0" name="lock" <?php if($news['Album']['lock']==0) echo 'checked=""';?> /> <?php echo $languageMantan['activate'];?> 
		                <input type="radio" value="1" name="lock" <?php if($news['Album']['lock']==1) echo 'checked=""';?> /> <?php echo $languageMantan['lock'];?>
	                </td>
	            </tr>
	            <tr>
	                <td><?php echo $languageMantan['keyWord'];?></td>
	                <td><input type="text" name="key" id='key' value="<?php echo $news['Album']['key'];?>" class="form-control" /></td>
	            </tr>
	            <tr><td colspan="2" align="center"><input type="submit" class="btn btn-default" value="<?php echo $languageMantan['save'];?>" name="submit" onclick="return saveThemData();"></td></tr>
	
	        </table>
	
	    </form>
	</div>