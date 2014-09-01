<?php
session_name('CAKEPHP');
session_start(); 
$checkMantanHeader= false;

$userAdmins= '';

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

$isHome= false;
$isCategory= false;
$isPost= false;
$isPage= false;
$isSearch= false;
$isPlugin= false;

$hookFunctionMantan= array();
$hookMenuAdminMantan= array();

$tmpVariable= array();

$categoryNotice= array();
$infoNotice= array();

// System	
function replaceFunction($oldFunction,$newFunction)
{
	global $hookFunctionMantan;
	$hookFunctionMantan[$oldFunction]= $newFunction;
}

function setVariable($key,$value)
{
	global $tmpVariable;
	$tmpVariable[$key]= $value;
}
		
function mantan_header()
{
	global $checkMantanHeader;
	$checkMantanHeader= true;
	echo '  <meta name="generator" content="Mantan 1.3" />
			<meta name="application-name" content="Mantan 1.3">
			<meta name="Publisher" CONTENT="Mantan 1.3">
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
	global $hookFunctionMantan;
	global $hookMenuAdminMantan;
	
	if($hookFunctionMantan['addMenuAdminMantan'])
	{
		$hookFunctionMantan['addMenuAdminMantan']($menus);
	}
	else
	{
		if(!is_array($hookMenuAdminMantan)) $hookMenuAdminMantan= array();
		$hookMenuAdminMantan= array_merge($hookMenuAdminMantan, $menus); 
	}
	
}                        

function addBreadcrumbAdmin($menu= array())
{
	global $hookFunctionMantan;
	
	if($hookFunctionMantan['addBreadcrumbAdmin'])
	{
		$hookFunctionMantan['addBreadcrumbAdmin']($menu);
	}
	else
	{
		echo '  <div class="row">
	                <div class="col-lg-12">
	                    <h1 class="page-header">
	                    	<a href="'.$menu['url'].'">'.$menu['name'].'</a>';
	                    	
	                    	while($menu['sub']['name']!='')
	                    	{
		                    	echo ' :: <a href="'.$menu['sub']['url'].'">'.$menu['sub']['name'].'</a>';
		                    	$menu= $menu['sub'];
	                    	}
	                    	
	                    	 
	     echo           '</h1>
	                </div>
	            </div>';
	}
}

function showEditorInput($idEditor,$nameEditor,$content,$loadJs=1)
{
	global $webRoot;
	global $hookFunctionMantan;
	
	if($hookFunctionMantan['showEditorInput'])
	{
		$hookFunctionMantan['showEditorInput']($idEditor,$nameEditor,$content,$loadJs);
	}
	else
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
}

function showUploadFile($idInput,$nameInput,$value,$languageMantan,$number='')
{ 
	global $webRoot;
	global $hookFunctionMantan;
	
	if($hookFunctionMantan['showUploadFile'])
	{
		$hookFunctionMantan['showUploadFile']($idInput,$nameInput,$value,$languageMantan,$number);
	}
	else
	{
?>
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
<?php 
	}
}
?>