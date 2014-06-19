<?php

   class PluginsController extends AppController
   {

	    var $name = 'Plugins';

        var $helpers = array('Session','Paginator');

        var $paginate = array();
		
		function admin($url,$var1,$var2,$var3,$var4,$var5,$var6,$var7,$var8,$var9,$var10)
		{
			//Configure::write('debug', 2);
			$users= $this->Session->read('infoAdminLogin');
	        if($users)
	        {
				$url= str_replace('-', '/', $url);
				$this->setup();
				$this->set('urlFilePlugin', $url);
				$this->loadModel();
				if($_GET['layout'])
				{
					$this->layout= $_GET['layout'];
				}
				
				$this->set('var1', $var1);
				$this->set('var2', $var2);
				$this->set('var3', $var3);
				$this->set('var4', $var4);
				$this->set('var5', $var5);
				$this->set('var6', $var6);
				$this->set('var7', $var7);
				$this->set('var8', $var8);
				$this->set('var9', $var9);
				$this->set('var10', $var10);
			}
            else 
            {
            	$urlLocal= $this->getUrlLocal();
	            $this->redirect($urlLocal['urlAdmins'].'login');
            }
		}
		
		function index($url,$var1,$var2,$var3,$var4,$var5,$var6,$var7,$var8,$var9,$var10)
		{
			//Configure::write('debug', 2);
			$this->loadModel();
			
			global $routesPlugin;
			
			if($routesPlugin[$url])
			{
				$url= $routesPlugin[$url];
			}
			else
			{
				$url= str_replace('-', '/', $url);
			}
			
			$this->setup();
			$this->set('urlFilePlugin', $url);
			
			if($_GET['layout'])
			{
				$this->layout= $_GET['layout'];
			}
			else
			{
				$this->layout= 'default';
			}
			
			$this->set('var1', $var1);
			$this->set('var2', $var2);
			$this->set('var3', $var3);
			$this->set('var4', $var4);
			$this->set('var5', $var5);
			$this->set('var6', $var6);
			$this->set('var7', $var7);
			$this->set('var8', $var8);
			$this->set('var9', $var9);
			$this->set('var10', $var10);
		}
   }
?>