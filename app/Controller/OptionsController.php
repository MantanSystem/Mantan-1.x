<?php

   class OptionsController extends AppController

   {

	    var $name = 'Options';

        var $helpers = array('Session','Paginator');

        var $paginate = array();
        
// Quan ly chuyen muc -------------------------------------------------------

        function categoryNotice()
        {
        	  //Configure::write('debug', 2);
	          $users= $this->Session->read('infoAdminLogin');
	
	          if($users)
	          {
	          		Controller::loadModel('Option');
		            $this->setup();
	
		            $chuyenmuc= $this->Option->getOption('categoryNotice');
	
		            $this->set('group', $chuyenmuc['Option']['value']['category']);
	
	          }
	          else 
              {
	            	$urlLocal= $this->getUrlLocal();
		            $this->redirect($urlLocal['urlAdmins'].'login');
              }
        }
        
        
		function saveCategoryNotice()
		{
			//Configure::write('debug', 2);
			$users= $this->Session->read('infoAdminLogin');
			
			Controller::loadModel('Option');
        	$urlLocal= $this->getUrlLocal();
        	
			if($users)
			{
				$idCatEdit= $_POST['idCatEdit'];
				$name= $_POST['name'];
				$parent= (int) $_POST['parent'];
				$slug= $_POST['slug'];
				$key= $_POST['key'];
				$description= $_POST['description'];
				
				$return= -1;
				if($name != '')
				{
					$return= $this->Option->saveCategoryNotice($slug,$idCatEdit,$name,$parent,$key,$description);
				}
				$this->redirect($urlLocal['urlOptions']."categoryNotice");
	
			}
			else 
            {
	            $this->redirect($urlLocal['urlAdmins'].'login');
            }
		}
		
		function deleteCatagery()
		{
			//Configure::write('debug', 2);
			
			$idCat= (int) $_POST['idDelete'];
			$users= $this->Session->read('infoAdminLogin');
	
			if($users)
			{
				Controller::loadModel('Option');
				$return= $this->Option->deleteCatageryNotice($idCat);
			}
		}   
        
        function changeCategoryNotice()
        {
        	//Configure::write('debug', 2);
	        $users= $this->Session->read('infoAdminLogin');
	        if($users)
	        {
	        	Controller::loadModel('Option');
	        	$type= $_POST['type'];
	        	$idMenu= (int) $_POST['idMenu'];
	        	
	        	$this->Option->changeCategoryNotice($type,$idMenu);
	        }
        }
// Quan ly giao dien ---------------------------
	function themes()
	{
		//Configure::write('debug', 2);
        $users= $this->Session->read('infoAdminLogin');
        if($users)
        {
      		Controller::loadModel('Option');
            $this->setup();

            $theme= $this->Option->getOption('theme');
            $this->set('theme', $theme['Option']['value']);
            
            $urlLocal= $this->getUrlLocal();
	        $listFile= $this->list_files($urlLocal['urlLocalTheme']);
            
            $this->set('listFile',$listFile);

        }
        else 
        {
        	$urlLocal= $this->getUrlLocal();
            $this->redirect($urlLocal['urlAdmins'].'login');
        }
	}
	
	function changeTheme($theme)
	{
		//Configure::write('debug', 2);
        $users= $this->Session->read('infoAdminLogin');
        $createDataDefault= $this->Session->read('createDataDefault');
        
        if($users || $createDataDefault)
        {
      		Controller::loadModel('Option');
      		if(!$theme) $theme= $_POST['theme'];
            $this->Option->saveOption('theme',$theme);
        }
        
        if($createDataDefault)
        {
	        $this->Session->destroy();
	        $this->redirect(array('controller' => 'admins', 'action' => 'login'));
        }
	}
// Quan ly giao dien ---------------------------
	function languages()
	{
		//Configure::write('debug', 2);
        $users= $this->Session->read('infoAdminLogin');
        if($users)
        {
      		Controller::loadModel('Option');
            $this->setup();

            $languages= $this->Option->getOption('language');
            $this->set('languages', $languages['Option']['value']);
            
            $urlLocal= $this->getUrlLocal();
	        $listFile= $this->list_files($urlLocal['urlLocalLanguage']);
            
            $this->set('listFile',$listFile);
            
        }
        else 
        {
        	$urlLocal= $this->getUrlLocal();
            $this->redirect($urlLocal['urlAdmins'].'login');
        }
	}
	
	function activeLanguage($code,$file)
	{
		//Configure::write('debug', 2);
		$users= $this->Session->read('infoAdminLogin');
		
		Controller::loadModel('Option');
    	$urlLocal= $this->getUrlLocal();
    	
        if($users)
        {
        	if($code)
        	{
	        	$this->Option->saveOption('language',array('code'=>$code,'file'=>$file));
        	}
        	$this->redirect($urlLocal['urlOptions'].'languages');
        }
        else 
        {
            $this->redirect($urlLocal['urlAdmins'].'login');
        }
	}

// Quan ly trinh don --------------------------
	function saveInfoMenu()
	{
		//Configure::write('debug', 2);
		$users= $this->Session->read('infoAdminLogin');
        
        Controller::loadModel('Option');
    	$urlLocal= $this->getUrlLocal();
    	
        if($users)
        {
        	$id= $_POST['id'];
        	$name= $_POST['name'];
        	
        	$this->Option->saveInfoMenu($name,$id);
        	$this->redirect($urlLocal['urlOptions'].'menus');
        }
        else 
        {
            $this->redirect($urlLocal['urlAdmins'].'login');
        }
	}
	
	function deleteOneMenu()
	{
		$users= $this->Session->read('infoAdminLogin');
            
        Controller::loadModel('Option');
    	$urlLocal= $this->getUrlLocal();
    	
        if($users)
        {
        	$idMenu= new MongoId($_POST['idMenu']);
        	$this->Option->delete($idMenu);
        }
	}
	
	
		function menus()
		{
			//Configure::write('debug', 2);
            $users= $this->Session->read('infoAdminLogin');
            if($users)
            {
            	$this->setup();
	            
            	Controller::loadModel('Option');
            	$urlLocal= $this->getUrlLocal();
                $trinhDon=array (
						    array (
						      'id' => 0,
						      'url' => $urlLocal['urlHomes'],
						      'name' => 'Trang chủ'
						    ), 
						    array (
						      'id' => 1,
						      'url' => $urlLocal['urlAlbums'],
						      'name' => 'Hình ảnh'
						    ),
						    array (
						      'id' => 2,
						      'url' => $urlLocal['urlVideos'],
						      'name' => 'Video'
						    )
						  );
                
                $this->set('trinhDon', $trinhDon);
                
                
                $categoryNotice= $this->Option->getOption('categoryNotice');
                $menus= $this->Option->getOption('menus','all');
                $this->set('menus', $menus);
                
                if($_GET['id']!='')
                {
	                foreach($menus as $menuUser)
	                {
		                if($menuUser['Option']['id']==$_GET['id'])
		                {
			                $menuShow= $menuUser;
			                break;
		                }
	                }
                }
                
                if(!$menuShow)
                {
	                $menuShow= $menus[0];
                }
                
                $this->set('menuShow', $menuShow);
                $this->set('categoryNotice', $categoryNotice['Option']['value']['category']);
            
                
                
                // Get Pages
                Controller::loadModel('Notice');
                
                $pages= $this->Notice->getAllPage() ;
                
                $this->set('pages', $pages);
                
            }
            else 
            {
            	$urlLocal= $this->getUrlLocal();
	            $this->redirect($urlLocal['urlAdmins'].'login');
            }
		}
		
		function saveMenus()
		{
			//Configure::write('debug', 2);
			$users= $this->Session->read('infoAdminLogin');
            
            Controller::loadModel('Option');
        	$urlLocal= $this->getUrlLocal();
        	
            if($users)
            {
            	$idTD= $_POST['idTD'];
            	$idParent= (int) $_POST['idParent'];
            	$url= chop($_POST['url']);
            	$name= chop($_POST['name']);
            	$name= str_replace('\t', '', $name);
            	$name= chop($name);
            	$submit= $_POST['submit'];
            	$idMenu= new MongoId($_POST['idMenuShow']);
            	
            	$this->Option->saveMenus($idParent,$idTD,$name,$url,$idMenu);
            	$this->redirect($urlLocal['urlOptions'].'menus?id='.$_POST['idMenuShow']);
            }
            else 
            {
	            $this->redirect($urlLocal['urlAdmins'].'login');
            }
		}
		
		function changeMenus()
		{
			//Configure::write('debug', 2);
            $users= $this->Session->read('infoAdminLogin');

            if($users)
            {
            	Controller::loadModel('Option');
            	$type= $_POST['type'];
            	$idMenu= (int) $_POST['idMenu'];
            	$idParent= (int) $_POST['idParent'];
            	$idMenuShow= new MongoId($_POST['idMenuShow']);
            	
            	$this->Option->changeMenus($type,$idMenu,$idParent,$idMenuShow);
            }
		}
		function deleteMenus($idMenu,$idMenuShow)
		{
			//Configure::write('debug', 2);
			$users= $this->Session->read('infoAdminLogin');
            
            Controller::loadModel('Option');
        	$urlLocal= $this->getUrlLocal();
        	
            if($users)
            {
            	$idMenu= (int) $idMenu;
            	$idMenuShow= new MongoId($idMenuShow);
            	$this->Option->deleteMenus($idMenu,$idMenuShow);
            	
            	$this->redirect($urlLocal['urlOptions'].'menus?id='.$idMenuShow);
            }
            else 
            {
	            $this->redirect($urlLocal['urlAdmins'].'login');
            }

		}
// Quan ly thong tin chung ------------------------------------------

        function infoSite()
        {
          $users= $this->Session->read('infoAdminLogin');
          if($users)
          {
          		Controller::loadModel('Option');
	          	$this->setup(true);
	            $infoSite= $this->Option->getOption('infoSite');
	            $contact= $this->Option->getOption('contact');
	            
	            $this->set('infoSite',$infoSite);
	            $this->set('contact',$contact);
          }
          else 
          {
        	  $urlLocal= $this->getUrlLocal();
              $this->redirect($urlLocal['urlAdmins'].'login');
          }

        }

        function saveInfoSite()
        { //Configure::write('debug', 2);

          $users= $this->Session->read('infoAdminLogin');
          Controller::loadModel('Option');
          $urlLocal= $this->getUrlLocal();
        	
          if($users)
          {
	        Controller::loadModel('Option');
            $title= $_POST['title'];
            $address= $_POST['address'];
            $fone= $_POST['fone'];
            $email= $_POST['email'];
            $fax= $_POST['fax'];
            $domain= $_POST['domain'];
            $key= $_POST['key'];
            $description= $_POST['description'];
			
            $return= $this->Option->saveInfoSite($title,$address,$fone,$email,$fax,$domain,$key,$description);
            
            $this->redirect($urlLocal['urlOptions'].'infoSite/?return='.$return);
          }
          else 
          {
            $this->redirect($urlLocal['urlAdmins'].'login');
          }
        }
// Quan ly plugin -------
	function plugins()
	{
		  //Configure::write('debug', 2);
		  $users= $this->Session->read('infoAdminLogin');
          if($users)
          {
          		Controller::loadModel('Option');
	          	$this->setup();
	            $plugins= $this->Option->getOption('plugins');
	            
	            $urlLocal= $this->getUrlLocal();
	            $listFile= $this->list_files($urlLocal['urlLocalPlugin']);
	            
	            
	            if(!$plugins['Option']['value'])
	            {
		            $plugins['Option']['value']= array();
	            }
	            
	            $listFileShow= array();
	            foreach($listFile as $file)
	            {
	            	$filename = $urlLocal['urlLocalPlugin']."/".$file."/info.txt";
					$handle = fopen($filename, "rb");
					$info = nl2br( fread($handle, filesize($filename)));
					fclose($handle);
					
		            if(in_array($file, $plugins['Option']['value']))
		            {
			            array_push($listFileShow, array('name'=>$file,'active'=>1,'info'=>$info));
		            }
		            else
		            {
			            array_push($listFileShow, array('name'=>$file,'active'=>0,'info'=>$info));
		            }
	            }
	            
	            foreach($plugins['Option']['value'] as $file)
	            {
		            if(!in_array($file, $listFile))
		            {
			            array_push($listFileShow, array('name'=>$file,'active'=>-1));
		            }
	            }
	            
	            $this->set('listFileShow',$listFileShow);
          }
          else 
          {
        	$urlLocal= $this->getUrlLocal();
            $this->redirect($urlLocal['urlAdmins'].'login');
          }
	}
	
	function list_files($directory = '.')
	{
		$listFile= array();
	    if ($directory != '.')
	    {
	        $directory = rtrim($directory, '/') . '/';
	    }
	    
	    if ($handle = opendir($directory))
	    {
	        while (false !== ($file = readdir($handle)))
	        {
	            if ($file != '.' && $file != '..')
	            {
	                array_push($listFile,  $file);
	            }
	        }
	        
	        closedir($handle);
	    }
	    return $listFile;
	}
	
	function activePlugin($nameFile)
	{
		//Configure::write('debug', 2);
		$users= $this->Session->read('infoAdminLogin');
		
		Controller::loadModel('Option');
    	$urlLocal= $this->getUrlLocal();
    	
        if($users)
        {
        	if($nameFile)
        	{
	        	$this->Option->activePlugin($nameFile);
        	}
        	$this->redirect($urlLocal['urlOptions'].'plugins');
        }
        else 
        {
            $this->redirect($urlLocal['urlAdmins'].'login');
        }
	}
	
	function deactivePlugin($nameFile)
	{
		//Configure::write('debug', 2);
		$users= $this->Session->read('infoAdminLogin');
		
		Controller::loadModel('Option');
    	$urlLocal= $this->getUrlLocal();
    	
        if($users)
        {
        	if($nameFile)
        	{
	        	$this->Option->deactivePlugin($nameFile);
        	}
        	$this->redirect($urlLocal['urlOptions'].'plugins');
        }
        else 
        {
            $this->redirect($urlLocal['urlAdmins'].'login');
        }
	}
	
	function deletePlugin($nameFile)
	{
		$users= $this->Session->read('infoAdminLogin');
		
		Controller::loadModel('Option');
    	$urlLocal= $this->getUrlLocal();
    	
        if($users)
        {
        	if($nameFile)
        	{
	        	$this->Option->deletePlugin($nameFile);
	        	$this->removeDirectory($urlLocal['urlLocalPlugin'].$nameFile) ;
        	}
        	$this->redirect($urlLocal['urlOptions'].'plugins');
        }
        else 
        {
            $this->redirect($urlLocal['urlAdmins'].'login');
        }
	}
	
	function removeDirectory($dir) 
	{
		if ($handle = opendir("$dir")) 
		{
			while (false !== ($item = readdir($handle))) 
			{
				if ($item != "." && $item != "..") 
				{
					if (is_dir("$dir/$item")) 
					{
						$this->removeDirectory("$dir/$item");
					} 
					else 
					{
						unlink("$dir/$item");
						//echo " removing $dir/$item<br>\n";
					}
				}
			}
			closedir($handle);
			rmdir($dir);
			//echo "removing $dir<br>\n";
		}
	}
  }
?>