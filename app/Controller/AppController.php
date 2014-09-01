<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

include('MantanFunctions.php');

App::uses('Controller', 'Controller');
App::uses('ConnectionManager', 'Model');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
        function isDBConnected()
	    {
	    	//Configure::write('debug', 2);
	        $datasource = ConnectionManager::getDataSource('default');
	        if($datasource->config['database']!='') return true;
	        else return false;
	    } 
	    
        function getUrlLocal()
        {
        	//Configure::write('debug', 2);
        	$urlBase= Router::url('/', true);
        	$urlBase= str_replace('Index.php/', '', $urlBase);
        	$urlBase= str_replace('index.php/', '', $urlBase);
        	
        	$url['urlHomes']= $urlBase;
        	$url['urlAdmins']= $urlBase.'admins/';
        	$url['urlOptions']= $urlBase.'options/';
        	$url['urlNotices']= $urlBase.'notices/';
        	$url['urlAlbums']= $urlBase.'albums/';
        	$url['urlPlugins']= $urlBase.'plugins/';
        	$url['urlVideos']= $urlBase.'videos/';
        	$url['webRoot']= str_replace('index.php/', '', $urlBase).'/app/webroot/';
        	
	        if(function_exists('apache_get_modules') && in_array('mod_rewrite', apache_get_modules()))
	        {
	        	$url['urlLocalPlugin']= '../Plugin/';
	        	$url['urlLocalTheme']= '../Theme/';
	        	$url['urlLocalLanguage']= '../Language/';
	        }
	        else
	        {
	            $url['urlLocalPlugin']= 'app/Plugin/';
	            $url['urlLocalTheme']= 'app/Theme/';
	            $url['urlLocalLanguage']= 'app/Language/';
	        }
	        
	        $urlBase= Router::url('/');
		 	if(strpos(strtolower($urlBase),'index.php/'))
		 	{
			 	$urlBase= substr_replace($urlBase, '', -10);  
		 	}
		 	$this->Session->write('urlBaseUpload',$urlBase.'app/webroot/upload/');
	        return $url;
        }
         
         function setup($notCheckDomain= false)
         {    
         	  //Configure::write('debug', 2);
         	  
         	  if($this->isDBConnected())
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
				  global $infoSite;
				  global $contactSite;
				  
				  global $metaTitleMantan;
				  global $metaKeywordsMantan;
				  global $metaDescriptionMantan;
				  
				  global $routesPlugin;
				  global $userAdmins;
				  
	              $userAdmins= $this->Session->read('infoAdminLogin');
	              $userHome= $this->Session->read('infoUserLogin');
	              
	              Controller::loadModel('Option');
	              $infoSite= $this->Option->getOption('infoSite');
	              if(!$infoSite['Option']['value']['domain'] && !$notCheckDomain)
	              {
	              	  $this->redirect(array('controller' => 'options', 'action' => 'infoSite'));
	              }
	              
	              $language= $this->Option->getOption('language');
	              $infoSite['Option']['value']['language']= $language['Option']['value'];
	              $urlLocal= $this->getUrlLocal();
	              
	              $metaTitleMantan= $infoSite['Option']['value']['title'];
	              $metaKeywordsMantan= $infoSite['Option']['value']['key'];
	              $metaDescriptionMantan= $infoSite['Option']['value']['description'];
	              
	              $this->layout= 'admin';
	              
	
	              $this->set('userAdmins', $userAdmins);
	              $this->set('userHomes', $userHome);
	              
	              $plugins= $this->Option->getOption('plugins');
	              $this->set('menuPlugins', $plugins['Option']['value']);
	              
	              $themeActive= $this->Option->getOption('theme');
	              $this->set('themeActive', $urlLocal['urlLocalTheme'].'/'.$themeActive['Option']['value'].'/' );
	              
	              
	              $this->set('infoSite', $infoSite);
	              
	              $contactSite= $this->Option->getOption('contact');
	              $this->set('contactSite', $contactSite);
	              
	              
	              $languages= $this->Option->getOption('language');
	              include($urlLocal['urlLocalLanguage'].'/'.$languages['Option']['value']['file']);
	              $this->set('languageMantan', $languageMantan );
	              
	              $urlNow= $this->curPageURL(1);
	              $urlAdmins= $urlLocal['urlAdmins'];
	              $urlOptions= $urlLocal['urlOptions'];
	              $urlNotices= $urlLocal['urlNotices'];
	              $urlAlbums= $urlLocal['urlAlbums'];
	              $urlPlugins= $urlLocal['urlPlugins'];
	              $urlVideos= $urlLocal['urlVideos'];
	              $urlHomes= $urlLocal['urlHomes'];
	              $urlThemeActive= 'http://'.$infoSite['Option']['value']['domain'].'/app/Theme/'.$themeActive['Option']['value'].'/';
	              $urlLocalThemeActive= $urlLocal['urlLocalTheme'].$themeActive['Option']['value'].'/';
	              $webRoot= $urlLocal['webRoot'];
	              
	              $this->set('urlLocal', $urlLocal );
	              $this->set('urlNow', $urlNow );
	              $this->set('urlAdmins', $urlAdmins );
	              $this->set('urlOptions', $urlOptions );
	              $this->set('urlNotices', $urlNotices );
	              $this->set('urlAlbums', $urlAlbums );
	              $this->set('urlPlugins', $urlPlugins );
	              $this->set('urlVideos', $urlVideos );
	              $this->set('urlHomes', $urlHomes );
	              $this->set('urlThemeActive', $urlThemeActive );
	              $this->set('urlLocalThemeActive', $urlLocalThemeActive );
	              $this->set('webRoot', $webRoot );
	              
	              
				  $listPlugin= $this->Option->getOption('plugins');
	              foreach($listPlugin['Option']['value'] as $plugin)
				  {
				    	$filename = $urlLocal['urlLocalPlugin'].'/'.$plugin.'/function.php';
				        if (file_exists($filename))
				        {
				            include($filename);
				        }
				        
				        $filename = $urlLocal['urlLocalPlugin'].'/'.$plugin.'/model.php';
				        if (file_exists($filename))
				        {
				            include($filename);
				        }
				        
				        $filename = $urlLocal['urlLocalPlugin'].'/'.$plugin.'/routes.php';
				        if (file_exists($filename))
				        {
				            include($filename);
				        }
				  }
				   
				  $filename = $urlLocal['urlLocalTheme'].'/'.$themeActive['Option']['value'].'/function.php';
			      if (file_exists($filename))
			      {
			          include($filename);
			      }
			      
			      
			      $routesPlugin= $routesPlugin;
              }
              else
              {
	              $this->redirect(array('controller' => 'admins', 'action' => 'installMantan'));
              }
         }
         
         function sendDataPost($url,$data)
         {
	        $options = array('http' => array(
					        				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
					        				'method'  => 'POST',
					        				'content' => http_build_query($data),
					        			   )
					        );
			$context  = stream_context_create($options);
			$result = file_get_contents($url, false, $context);
			return $result;
         }
         
         
        function curPageURL($type=0)
        {

           $pageURL = 'http';

           if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}

           $pageURL .= "://";

           if ($_SERVER["SERVER_PORT"] != "80")

           {

                $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];

           } else

           {

                $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];

           }
           
           if($type==1)
           {
	           return $pageURL;
           }
           else
           {
           	    return urlencode($pageURL);
           }
        }
        
        function loadModel()
		{
			Controller::loadModel('Option');
			Controller::loadModel('Notice');
			Controller::loadModel('Album');
			Controller::loadModel('Admin');
			Controller::loadModel('User');
			Controller::loadModel('Video');
			
			global $modelOption;
			global $modelNotice;
			global $modelAlbum;
			global $modelAdmin;
			global $modelUser;
			global $modelVideo;
			
			$modelOption= new Option();
			$modelNotice= new Notice();
			$modelAlbum= new Album();
			$modelAdmin= new Admin();
			$modelUser= new User();
			$modelVideo= new Video();
			
			$themeActive= $this->Option->getOption('theme');
			$urlLocal= $this->getUrlLocal();
	        
	        $this->set('modelOption', $modelOption );
	        $this->set('modelNotice', $modelNotice );
	        $this->set('modelAlbum', $modelAlbum );
	        $this->set('modelAdmin', $modelAdmin );
	        $this->set('modelUser', $modelUser );
	        $this->set('modelVideo', $modelVideo );
		}
}

?>