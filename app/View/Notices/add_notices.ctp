<?php
	$breadcrumb= array( 'name'=>$languageMantan['news'],
						'url'=>$urlNotices.'listNotices',
						'sub'=>array('name'=>$languageMantan['addNew'])
					  );
	addBreadcrumbAdmin($breadcrumb);
?> 
<style>
	#page-wrapper{
		float: left;
	}
</style>  
    <script type="text/javascript">

	    var urlWeb="<?php echo $urlNotices;?>";
	
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
	    
	    function editDate(ngay,thang,nam)
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
		    
		    document.getElementById("ngayDang").innerHTML= str;
	    }
	
	    
	    
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
	</script>
	
	
	<div class="thanhcongcu">
	    <div class="congcu" onclick="saveThemNotices();">
	        <input type="hidden" id="idChange" value="" />
	        <span id="save">
	          <input type="image" src="<?php echo $webRoot;?>images/save.png" />
	        </span>
	        <br/>
	        <?php echo $languageMantan['save'];?>
	    </div>
	      	
	</div>
	
	<div class="clear"></div>
	
	<div id="content">
	
	<form action="<?php echo $urlNotices;?>saveNotices" method="post" name="dangtin" enctype="multipart/form-data">
	
	    <input type="hidden" value="<?php echo $news['Notice']['id'];?>" name="id" />
	    <input type="hidden" value="<?php echo $news['Notice']['slug'];?>" name="slug" id="slug" />
	    
	    <div style="width: 60%;float:left;">
		    <table cellspacing="0" style="width: 700px;" class="table" >
		        <tr>
		            <td width="320">
						<p><b><?php echo $languageMantan['title'];?> (*)</b></p>
						<p><input type="text" class="form-control" onkeyup="createSlug();" onchange="createSlug();" name="title" id='title' value="<?php echo $news['Notice']['title'];?>" /></p>
					</td>
		
		            <td>
						<p><b><?php echo $languageMantan['author'];?></b></p>
						<p><input type="text" name="author" id='author' value="<?php echo $news['Notice']['author'];?>" class="form-control" /></p>
					</td>
		
		        </tr>
		
		        <tr>
		
		            <td>
						<p><b><?php echo $languageMantan['event'];?></b></p>
						<p>
							<input type="radio" name="event" id='event' value="1" <?php if($news['Notice']['event']==1) echo 'checked="checked"';?> /> <?php echo $languageMantan['yes'];?>
		
							<input type="radio" name="event" id='event' value="0" <?php if($news['Notice']['event']==0) echo 'checked="checked"';?> /> <?php echo $languageMantan['no'];?>
		
						</p>
					</td>
					
					<td height="85">
						<p><b><?php echo $languageMantan['keyWord'];?></b></p>
						<p>
							<input type="text" name="key" id='key' value="<?php echo $news['Notice']['key'];?>" class="form-control" />
						</p>
					</td>
					
		        </tr>
		
		        <tr>
			        <td>
				        <p><b><?php echo $languageMantan['datePosted'];?></b></p>
				        <p id="ngayDang">
					        <?php
						        
						        if($news['Notice']['time'])
						        {
							        $today= getdate($news['Notice']['time']);
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
									        <a href="javascript:void(0)" onclick="editDate('.$today['mday'].','.$today['mon'].','.$today['year'].');" style="text-decoration: underline;">'.$languageMantan['edit'].'</a>';
						        }
						        
					        ?>
					        
				        </p>
			        </td>
		            <td>
						<p><b><?php echo $languageMantan['ilustration'];?></b></p>
						<p>
							<?php showUploadFile($webRoot,'image','image',$news['Notice']['image'],$languageMantan);?>
						</p>
					</td>
		
		
		        </tr>
		
		        <tr>
		
		            <td colspan="2">
						<p><b><?php echo $languageMantan['content'];?></b></p>
						<p>
							<?php
								showEditorInput($webRoot,'contentPost','content',$news['Notice']['content']);
							?>
						</p>
					</td>
		        </tr>
		    </table>
		</div>
	    <div class="taovien" style="float:right;width:38%;">
		    <div class="form-control" style="width: 250px;">

		        <b><?php echo $languageMantan['categories'];?></b>
		        <br /><br />
		        
		        <?php
		        
				    function listCatShow($cat,$sau,$idCM)
					{
						if($cat['id']>0)
						{
							echo '<p style="padding-left: 10px;"  >';
							for($i=1;$i<=$sau;$i++)
							{
								echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
							}
							if(in_array($cat['id'], $idCM) )
							{
								echo '<input type="checkbox" checked="checked" name="category'.$cat['id'].'" value="'.$cat['id'].'" />&nbsp&nbsp'.$cat['name'];
							}
							else
							{
								echo '<input type="checkbox" name="category'.$cat['id'].'" value="'.$cat['id'].'" />&nbsp&nbsp'.$cat['name'];
							}
							echo '</p>';
						}
						foreach($cat['sub'] as $sub)
						{
							listCatShow($sub,$sau+1,$idCM);
						}
					}
					
		    		if( is_numeric($news['Notice']['category']) )
		            {
		                $news['Notice']['category']= array($news['Notice']['category']);
		            }
					foreach($chuyenmuc as $cat)
					{
						listCatShow($cat,0,$news['Notice']['category']);
		
					}
		        
		
		        ?>
		    </div>
	    </div>
	
	    
	
	</form>
	
	
	</div>
