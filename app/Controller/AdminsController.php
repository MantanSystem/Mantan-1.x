<?php

   class AdminsController extends AppController

   {

	    var $name = 'Admins';

        var $helpers = array('Session','Paginator');

        var $paginate = array();
		
		
        function index()
        {
            //Configure::write('debug', 2);
            $users= $this->Session->read('infoAdminLogin');
            if($users)
            {
                $this->setup();
            }
            else 
            {
            	$this->redirect(array('controller' => 'admins', 'action' => 'login'));
            }
        }
 // Install Mantan System       
       function installMantan()
       {
       		//Configure::write('debug', 2);
       		$this->layout= 'default';
       		$this->Session->destroy();
       		if($this->isDBConnected())
       		{
	       		Controller::loadModel('Option');
	       		$infoSite= $this->Option->getOption('infoSite');
	       		if(!$infoSite['Option']['value']['domain'])
	            {
	            	$users= $this->Session->read('infoAdminLogin');
		            if($users)
		            {
	            		$this->redirect(array('controller' => 'options', 'action' => 'infoSite'));
	            	}
	            	else
	            	{
		            	$this->redirect(array('controller' => 'options', 'action' => 'login'));
	            	}
	            }
	            else
	            {
		            $this->redirect(array('controller' => 'admins', 'action' => 'index'));
	            }
       		}
       }
       
       function startInstall()
       {
       		//Configure::write('debug', 2);
	        if($this->isDBConnected())
       		{
       			Controller::loadModel('Option');
	       		$infoSite= $this->Option->getOption('infoSite');
	       		if(!$infoSite['Option']['value']['domain'])
	            {
	            	$this->redirect(array('controller' => 'options', 'action' => 'infoSite'));
	            }
	            else
	            {
		            $this->redirect(array('controller' => 'admins', 'action' => 'index'));
	            }
       		}
       		
       		$user= $_POST['user'];
       		$Passwd1= $_POST['Passwd1'];
       		$Passwd2= $_POST['Passwd2'];
       		$database= $_POST['database'];
       		$databaseUser= $_POST['databaseUser'];
       		$databasePassword= $_POST['databasePassword'];
       		
       		if($Passwd1==$Passwd2 && $database!='')
       		{
	       		if(function_exists('apache_get_modules') && in_array('mod_rewrite', apache_get_modules()))
		        {
		        	$urlLocalConfig= '../Config/';
		        }
		        else
		        {
			        $urlLocalConfig= 'app/Config/';
		        }
		        
		        $string= '<?php CakePlugin::load("Mongodb");class DATABASE_CONFIG {public $default = array("datasource" => "Mongodb.MongodbSource","host" => "localhost","database" => "'.$database.'","login" => "'.$databaseUser.'","password" => "'.$databasePassword.'","port" => 27017,"prefix" => "","persistent" => "true","encoding" => "utf8");}?>';
		        $file = fopen($urlLocalConfig.'database.php','w');
		        fwrite($file,$string);
		        fclose($file);
		        
		        $this->Session->write('createDataDefault',true);
		        $pass= md5($Passwd1);
		        
		        $this->redirect(Router::url('/', true).'admins/createDataDefault/'.$pass.'/'.$user);
	        }
	        else
	        {
		        $this->redirect(array('controller' => 'admins', 'action' => 'installMantan'));
	        }
       }
       
       function createDataDefault($pass,$user)
       {
       	   $createDataDefault= $this->Session->read('createDataDefault');
       	   if($createDataDefault)
       	   {
		       Controller::loadModel('Option');
		       Controller::loadModel('Admin');
		       
		       $this->Admin->saveAdmin($user,$pass);
		       
		       $language["Option"]['value']= array( "code"=> "en","file"=> "en.php" );
		       $this->Option->saveOption('language',$language["Option"]['value']);
		       
		       $this->redirect(Router::url('/', true).'options/changeTheme/default');
		       
	       }
	       else $this->redirect(array('controller' => 'admins', 'action' => 'login'));
       }
       
// Danh nhap, dang xuat -------------------------------------------------------
	 
       function login()
       {
	        //Configure::write('debug', 2);
            $user_id= $this->Session->read('infoAdminLogin');
            if($user_id)
            {
            	$this->redirect(array('controller' => 'admins', 'action' => 'index'));
            }
            $this->setup(true);
            $this->layout= 'default';
       }

       function loginAfter()
       {
         //Configure::write('debug', 2);

		 $user= $_POST['user'];
         $password= md5($_POST['Passwd']);
         
         Controller::loadModel('Admin');
         Controller::loadModel('Option');
         
         $urlLocal= $this->getUrlLocal();
         $users= $this->Admin->checkLogin($user,$password);

         if($users)
         {
         	$infoSite= $this->Option->getOption('infoSite');
         	$users['Admin']['infoSite']= $infoSite["Option"]['value'];
         	$this->Session->write('infoAdminLogin',$users);
            $this->redirect($urlLocal['urlAdmins']);
           
         }
         else $this->redirect($urlLocal['urlAdmins'].'login/?error=1');
       }


        function logout()
        {
            $this->Session->destroy();
        	$urlLocal= $this->getUrlLocal();

            $this->redirect($urlLocal['urlAdmins'].'login');
        }

// Quan ly tai khoan ca nhan -------------------------------------------------

       function account()
       {
       	 //Configure::write('debug', 2);
         $users= $this->Session->read('infoAdminLogin');
         if($users)
         {
	         $this->setup();
         }
         else 
         {
        	$urlLocal= $this->getUrlLocal();
            $this->redirect($urlLocal['urlAdmins'].'login');
         }
       }

       function changePass()
       {
       	 //Configure::write('debug', 2);
         $users= $this->Session->read('infoAdminLogin');
    	 $urlLocal= $this->getUrlLocal();
    	 
         if($users)
         {
            if($_POST['id'] != '')
            {
                $id= new MongoId($_POST['id']);

                $passOld= $_POST['passOld'];

                $pass1= $_POST['pass1'];

                $pass2= $_POST['pass2'];

                if($pass1==$pass2)
                {
                    $passOld= md5($passOld);
                    $pass1= md5($pass1);
                    Controller::loadModel('Admin');
                    $return= $this->Admin->changePass($passOld,$pass1,$id);
                }
                else $return= -2;

                $this->redirect($urlLocal['urlAdmins'].'account?return='.$return);
            }
            else $this->redirect($urlLocal['urlAdmins'].'account?return=-1');

         }
         else 
         {
            $this->redirect($urlLocal['urlAdmins'].'login');
         }

       }

// ------------------------------

   }

?>
