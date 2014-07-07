		<form action="<?php echo $urlAlbums;?>saveAlbum" method="post" name="dangtin" >
	        <input type="hidden" value="<?php echo $news['Album']['id'];?>" name="id" />
	        <input type="hidden" value="<?php echo $news['Album']['slug'];?>" name="slug" id="slugEdit" />
	        <table class="table table-striped">
	            <tr>
	                <td><?php echo $languageMantan['nameAlbum'];?> (*)</td>
	                <td><input type="text" onkeyup="createSlug('slugEdit','titleEdit');" onchange="createSlug('slugEdit','titleEdit');" name="title" id='titleEdit' value="<?php echo $news['Album']['title'];?>" class="form-control" /></td>
	            </tr>
	            <tr>
	                <td><?php echo $languageMantan['ilustration'];?> (*)</td>
	                <td>
	                	<?php showUploadFile('imageEdit','image',$news['Album']['img'][0]['src'],$languageMantan,'Edit');?>
	                </td>
	            </tr>
	            <tr>
	                <td><?php echo $languageMantan['datePosted'];?></td>
	                <td id="ngayDangEdit">
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
								        <a href="javascript:void(0)" onclick="editDate('.$today['mday'].','.$today['mon'].','.$today['year'].','."'".'ngayDangEdit'."'".');" style="text-decoration: underline;">'.$languageMantan['edit'].'</a>';
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
	            <tr><td colspan="2" align="center"><input type="submit" class="btn btn-default" value="<?php echo $languageMantan['save'];?>" name="submit"></td></tr>
	
	        </table>
	
	    </form>
	    
	    