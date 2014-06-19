<?php
   class VideosController extends AppController
   {
	    var $name = 'Videos';
	    var $helpers = array('Session','Paginator');

        var $paginate = array();
        
       function listVideos()
       {
         //Configure::write('debug', 2);

         $users= $this->Session->read('infoAdminLogin');
         if($users)
         {
	         	 $this->setup();
	             
	             Controller::loadModel('Video');

                 $this->paginate = array(

                                        'limit' => 15,

                                        'conditions' => $dk,

                                        'order' => array('created'=> 'DESC')

                                        );

                
                $return = $this->paginate("Video");
                
                $this->set('listData', $return);


         }
         else 
         {
        	$urlLocal= $this->getUrlLocal();

            $this->redirect($urlLocal['urlAdmins'].'login');
         }

       }
   
       function saveData()
       {
	       $users= $this->Session->read('infoAdminLogin');
	       
        	$urlLocal= $this->getUrlLocal();
        	
	       if($users)
	       {
	       		$name= $_POST['name'];
	       		$code= $_POST['code'];
	       		$id= $_POST['id'];
	       		$slug= $_POST['slug'];
	       		Controller::loadModel('Video');
	       		$this->Video->saveData($name,$code,$slug,$id);
	       		$this->redirect($urlLocal['urlVideos'].'listVideos');
	       }
	       else 
           {
	            $this->redirect($urlLocal['urlAdmins'].'login');
           }
       }
       
       function deleteData()
       {
	       $users= $this->Session->read('infoAdminLogin');
	       if($users)
	       {
	       		if($_POST['id'])
	       		{
	       			Controller::loadModel('Video');
		       		$id= new MongoId($_POST['id']);
		       		$this->Video->delete($id);
	       		}
	       }
       }
// Theme ------
		function index($slug)
		{
			$this->setup();
			$this->layout='default';
			$this->loadModel();
			$urlLocal= $this->getUrlLocal();
         	Controller::loadModel('Video');
         	
         	if(!$slug)
         	{
	            $this->paginate = array(
	
	                                    'limit' => 15,
	
	                                    'order' => array('time' => 'desc'),
	
	                                    );
	
	            $return = $this->paginate("Video");
	            
	            $this->set('listVideos', $return);
	            
	            global $metaTitleMantan;
	            $metaTitleMantan= 'Videos | '.$metaTitleMantan;
            }
            else
            {
            	$slug= str_replace('.html', '', $slug);
	            $infoVideo= $this->Video->getSlugVideo($slug);
	            
	            if($infoVideo)
	            {
	            	$this->set('infoVideo', $infoVideo);
	            	
	            	global $metaTitleMantan;
					$metaTitleMantan= $infoVideo['Video']['name'].' | '.$metaTitleMantan;
	            }
	            else
				{
					$this->redirect($urlLocal['urlHomes']);
				}
            }
            
            $this->set('slug', $slug);
		}	   
   }
?>