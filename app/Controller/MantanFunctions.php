<?php
session_name('CAKEPHP');
session_start(); 
$checkMantanHeader= false;
$modelOption= '';
$modelNotice= '';
$modelAlbum= '';
$modelAdmin= '';
$modelUser= '';
$modelVideo= '';

$urlAdmins= '';
$urlOptions= '';
$urlNotices= '';
$urlAlbums= '';
$urlPlugins= '';
$urlVideos= '';
$urlHomes= '';	
$urlNow= '';
$urlThemeActive= '';
$urlLocalThemeActive= '';
$urlLocal= '';
$webRoot= '';

$infoSite= '';
$contactSite= '';

$routesPlugin= '';	

$metaTitleMantan= '';
$metaKeywordsMantan= '';	
$metaDescriptionMantan= '';	

// Homes			
function mantan_header()
{
	global $checkMantanHeader;
	$checkMantanHeader= true;
	echo '  <meta name="generator" content="Mantan 1.1" />
			<meta name="application-name" content="Mantan 1.1">
			<META NAME="Publisher" CONTENT="Mantan 1.1">
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			<meta name="robots" content="noodp,index,follow" />
			<meta name="revisit-after" content="1 days" />
	';
}	

function showErrorMantanHeader()
{
	global $checkMantanHeader;
	if(!$checkMantanHeader)
	{
		echo '<script type="text/javascript">alert("Inserts <?php mantan_header();?> before the head");</script>';
	}
}

function getHeader()
{
	global $urlAdmins;
	global $urlOptions;
	global $urlNotices;
	global $urlAlbums;
	global $urlPlugins;
	global $urlVideos;
	global $urlHomes;
	global $urlNow;
	global $urlThemeActive;
	global $urlLocalThemeActive;
	global $urlLocal;
	global $webRoot;
	  
	global $modelOption;
	global $modelNotice;
	global $modelAlbum;
	global $modelAdmin;
	global $modelUser;
	global $modelVideo;
	global $routesPlugin;
	
	global $infoSite;
	global $contactSite;
	
	include($urlLocalThemeActive.'header.php');
}

function getFooter()
{
	global $urlAdmins;
	global $urlOptions;
	global $urlNotices;
	global $urlAlbums;
	global $urlPlugins;
	global $urlVideos;
	global $urlHomes;
	global $urlNow;
	global $urlThemeActive;
	global $urlLocalThemeActive;
	global $urlLocal;
	global $webRoot;
	  
	global $modelOption;
	global $modelNotice;
	global $modelAlbum;
	global $modelAdmin;
	global $modelUser;
	global $modelVideo;
	global $routesPlugin;
	
	global $infoSite;
	global $contactSite;
	
	include($urlLocalThemeActive.'footer.php');
}

function getSidebar()
{
	global $urlAdmins;
	global $urlOptions;
	global $urlNotices;
	global $urlAlbums;
	global $urlPlugins;
	global $urlVideos;
	global $urlHomes;
	global $urlNow;
	global $urlThemeActive;
	global $urlLocalThemeActive;
	global $urlLocal;
	global $webRoot;
	  
	global $modelOption;
	global $modelNotice;
	global $modelAlbum;
	global $modelAdmin;
	global $modelUser;
	global $modelVideo;
	global $routesPlugin;
	
	global $infoSite;
	global $contactSite;
	
	include($urlLocalThemeActive.'sidebar.php');
}

// Notices
function getUrlNotice($id)
{
	$modelNotice= new Notice();
	global $urlNotices;
	
	$id= new MongoId($id);
	$data= $modelNotice->getNotice($id);
	return $urlNotices.$data['Notice']['slug'].'.html';
}

// Admins
function addMenuAdminMantan($menus= array())
{
	global $urlNow;
	foreach($menus as $menu)
	{
		if(!$menu['sub'])
		{
			if($urlNow!=$menu['url'])
			{
				$class= '';
			}
			else
			{
				$class= 'active';
			}
			
			echo '  <li class="'.$class.'">
                        <a href="'.$menu['url'].'"><i class="fa fa-files-o fa-fw"></i> '.$menu['name'].'</a>
                    </li>';
		}
		else
		{
			$class='';
			if($menu['url']==$urlNow)
			{
				$class= 'active';
			}
			else
			{
				foreach($menu['sub'] as $subMenu)
				{
					if($urlNow==$subMenu['url'])
					{
						$class= 'active';
						break;
					}
				}
			}
			
			echo ' <li class="'.$class.'">
                        <a href="'.$menu['url'].'"><i class="fa fa-files-o fa-fw"></i> '.$menu['name'].'<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">';
                        foreach($menu['sub'] as $sub)
                        {
                        	if($urlNow==$sub['url'])
							{
								$classSub= 'activeSub';
							}
							else
							{
								$classSub= '';
							}
							
                        	echo '  <li class="'.$classSub.'">
		                                <a href="'.$sub['url'].'">'.$sub['name'].'</a>
		                            </li>';
                        }
            echo        '</ul>
                    </li>';
		}
	}
}

						
                        

function addBreadcrumbAdmin($menu= array())
{
	echo '  <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                    	<a href="'.$menu['url'].'">'.$menu['name'].'</a> :: <a href="'.$menu['sub']['url'].'">'.$menu['sub']['name'].'</a>
                    </h1>
                </div>
            </div>';
}

function showEditorInput($webRoot,$idEditor,$nameEditor,$content,$loadJs=1)
{
	if($loadJs)
	{
		echo '<script language="javascript" src="'.$webRoot.'ckeditor/ckeditor.js" type="text/javascript"></script>';
	}
	echo '  <textarea style="border: 1px solid #abadb3;height: auto;"  name="'.$nameEditor.'" id="'.$idEditor.'">'.$content.'</textarea>
			<script type="text/javascript">
				CKEDITOR.replace( "'.$idEditor.'"); 
			</script>';
}

function showUploadFile($webRoot,$idInput,$nameInput,$value,$languageMantan,$number='')
{ ?>
	<script type="text/javascript" src="<?php echo $webRoot;?>ckfinder/ckfinder.js"></script>
	<script type="text/javascript">
			function BrowseServerImage<?php echo $number;?>()
			{
				
				var finder = new CKFinder();
				finder.basePath = '../';	
				finder.selectActionFunction = SetFileFieldImage<?php echo $number;?>;
				finder.popup();
	
	
			}
	
	
			function SetFileFieldImage<?php echo $number;?>( fileUrl )
			{
				document.getElementById( '<?php echo $idInput;?>' ).value = fileUrl;
			}
			
			
	</script>
	<input type="text" name="<?php echo $nameInput;?>" id='<?php echo $idInput;?>' value="<?php echo $value;?>" />
	<input type="button" value="<?php echo $languageMantan['choose'];?>" onclick="BrowseServerImage<?php echo $number;?>();" />
<?php }

?>