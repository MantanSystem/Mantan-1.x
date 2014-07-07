 
<?php
	$breadcrumb= array( 'name'=>$languageMantan['news'],
						'url'=>$urlOptions.'categoryNotice',
						'sub'=>array('name'=>$languageMantan['newsCategories'])
					  );
	addBreadcrumbAdmin($breadcrumb);
?>   
<div class="clear"></div>
  <br />
  <div class="taovien">
    <?php
		function listCat($cat,$sau,$parent)
		{
			if($cat['id']>0)
			{
				echo '<option id="'.$parent.'" value="'.$cat['id'].'">';
				for($i=1;$i<=$sau;$i++)
				{
					echo '&nbsp&nbsp&nbsp&nbsp';
				}
				echo $cat['name'].'</option>';
			}
			foreach($cat['sub'] as $sub)
			{
				listCat($sub,$sau+1,$cat['id']);
			}
		}
		function listCatShow($cat,$sau,$webRoot,$languageMantan)
		{
			echo '<tr><td><p style="padding-left: 10px;"  >';
			for($i=1;$i<=$sau;$i++)
			{
				echo '&nbsp&nbsp&nbsp&nbsp';
			}
			?>
			<img src="<?php echo $webRoot;?>images/bg-list-item.png" />&nbsp&nbsp<span id="content<?php echo $cat['id'];?>"><?php echo $cat['name'];?></span>
			
			</p>
			</td>
			</td>
			<td>
				<?php 
					echo $cat['slug'];
				?>
			</td>
			<td align="center">
					          
	          <a href="javascript: voind(0);" class="topIcon" title="<?php echo $languageMantan['move'];?>" onclick="diChuyen('top',<?php echo $cat['id'];?>)">
		          <img src="<?php echo $webRoot;?>images/topIcon.png">
	          </a>
	         
	          <a href="javascript: voind(0);" class="bottomIcon" title="<?php echo $languageMantan['move'];?>" onclick="diChuyen('bottom',<?php echo $cat['id'];?>)">
		          <img src="<?php echo $webRoot;?>images/bottomIcon.png">
	          </a>
            </td>
			<td align="center">
				<input class="input" type="button" value="<?php echo $languageMantan['edit'];?>" onclick="suaData('<?php echo $cat['id'];?>','<?php echo $cat['slug'];?>');">
				&nbsp;&nbsp;
				<input class="input" type="button" value="<?php echo $languageMantan['delete'];?>" onclick="deleteData('<?php echo $cat['id'];?>');">
			</td>
			</tr>
			<?php
			foreach($cat['sub'] as $sub)
			{
				listCatShow($sub,$sau+1,$webRoot,$languageMantan);
			}
		}
	
	?>
		
			
			<!-- main page -->
			
			<form name="dangtin" method="post" action="<?php echo $urlOptions;?>saveCategoryNotice" role="form">
				<div class="form-group">
					<input type="hidden" value="" name="idCatEdit" id="idCatEdit" />
					
					<table cellspacing="0" class="table" style="width: 100%;" >									
						<tr>
							<td width="150"><?php echo $languageMantan['nameCategories'];?></td>
							<td><input class="form-control" type="text" name="name" id="name" value="" onkeyup="createSlug();" onchange="createSlug();" /></td>
							<td width="150" align="right"><?php echo $languageMantan['keyWord'];?></td>
							<td><input class="form-control" type="text" name="key" id="key" value="" /></td>
						</tr>
	                    <tr>
							<td><?php echo $languageMantan['parentCategories'];?></td>
							<td>
								<select name="parent" id="parent" class="form-control">
									<option value="0"><?php echo $languageMantan['rootCategories'];?></option>
								<?php
									foreach($group as $cat)
									{
										listCat($cat,1,0);
	
									}	
								?>
								</select>
							</td>
							<td rowspan="2" align="right"><?php echo $languageMantan['description'];?></td>
							<td rowspan="2">
								<textarea id="description" class="form-control" name="description" rows="5"></textarea>
							</td>
						</tr>
						<tr>
							<td width="100"><?php echo $languageMantan['permalinks'];?></td>
							<td>
								<input class="form-control" type="text" name="slug" id="slug" value="" />
							</td>
						</tr>
	                    
	                   <tr>
	                        <td colspan="4">
	                            <input type="submit" value="<?php echo $languageMantan['saveCategories'];?>" class="btn btn-default"  />   
	                            &nbsp;&nbsp;   
	                            <input type="reset" value="<?php echo $languageMantan['addNew'];?>" class="btn btn-default"  />                                         
	                        </td>
	                    </tr>
					</table>
				</div>
			</form>
			
			<br/><br/>
			<table cellspacing="0" class="table table-striped">
			<tr>
				<td align="center"><?php echo $languageMantan['nameCategories'];?></td>
				<td align="center"><?php echo $languageMantan['permalinks'];?></td>
				<td align="center" width="80"><?php echo $languageMantan['move'];?></td>
				<td align="center" width="130"><?php echo $languageMantan['choose'];?></td>
			</tr>
			<?php
				foreach($group as $cat)
				{
					listCatShow($cat,0,$webRoot,$languageMantan);

				}	
			?>
			</table>
							
    
<script type="text/javascript">

var urlWeb="<?php echo $urlOptions;?>";

setCheckedValue(document.forms['listForm'].elements['idXoa']);


function createSlug()
{
  var str= document.getElementById("name").value;
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

function setCheckedValue(radioObj) {
	if(!radioObj)
    {
		return;
    }
	var radioLength = radioObj.length;

	for(var i = 0; i < radioLength; i++)
    {
		radioObj[i].checked = false;
	}
}

function suaData(idCat,slug)
{
    var nameCat= document.getElementById("content"+idCat).innerHTML;
    document.getElementById("name").value= nameCat;
	document.getElementById("idCatEdit").value= idCat;
	document.getElementById("slug").value= slug;
	
	var x=document.getElementById("parent");
	var i,j,idParent,truoc= 0;
	for (i=0;i<x.length;i++)
	{
		if(idCat == x.options[i].value)
		{
			idParent= x.options[i].id;
			for (j=0;j<x.length;j++)
			{
				if(idParent == x.options[j].value)
				{
					x.options[j].selected= "selected";
					break;
				}
			}
			break;
			
		}
		
	}
	
	window.scrollTo(500,0);
}



function deleteData(idDelete)
{
    var check= confirm('<?php echo $languageMantan['areYouSureYouWantToRemove'];?>');
	if(check)
	{
		$.ajax({
	      type: "POST",
	      url: urlWeb+"deleteCatagery",
	      data: { idDelete:idDelete}
	    }).done(function( msg ) { 	
		  		window.location= urlWeb+"categoryNotice";	
		 })
		 .fail(function() {
				window.location= urlWeb+"categoryNotice";
			});  
	}
}

function diChuyen(type, idMenu)
{
	$.ajax({
      type: "POST",
      url: urlWeb+"changeCategoryNotice",
      data: { type:type, idMenu:idMenu}
    }).done(function( msg ) { 	
	  		window.location= urlWeb+"categoryNotice";	
	 })
	 .fail(function() {
			window.location= urlWeb+"categoryNotice";
		});  
}
</script>


