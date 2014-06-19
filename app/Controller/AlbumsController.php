<?php

   class AlbumsController extends AppController

   {

	    var $name = 'Albums';

        var $helpers = array('Session','Paginator');

        var $paginate = array();
		
		
// Quan ly album anh -----------------------------------------------------

        function listAlbums()
        {
        	//Configure::write('debug', 2);
            $users= $this->Session->read('infoAdminLogin');

            if($users)
            {
	            	$this->setup();
	            
                 	Controller::loadModel('Album');

                    $this->paginate = array(

                                            'limit' => 15,

                                            'conditions' => $dk,

                                            'order' => array('time' => 'desc'),

                                            );

                    $return = $this->paginate("Album");
                    
                    $this->set('listNotices', $return);
            }
            else 
            {
            	$urlLocal= $this->getUrlLocal();

	            $this->redirect($urlLocal['urlAdmins'].'login');
            }

        }

        function editInfoAlbum()
        {
	        $users= $this->Session->read('infoAdminLogin');

            if($users)
            {
            	Controller::loadModel('Album');
            	$this->setup();
            	$this->layout="default";
            	$id= new MongoId($_POST['id']);

                $return= $this->Album->getAlbum($id);

                $this->set('news', $return);
            }
        }
        
        function saveAlbum()
        {   
        	//Configure::write('debug', 2);
            $users= $this->Session->read('infoAdminLogin');
        	$urlLocal= $this->getUrlLocal();
        	
            if($users)
            {
	            $this->setup();
	            Controller::loadModel('Album');
	            $title= $_POST['title'];
				$lock= (int) $_POST['lock'];
	            $image= $_POST['image'];

	            $key= $_POST['key'];

	            $id= $_POST['id'];
	            $slug= $_POST['slug'];

	            if($id=="") $id= null;

	            $today= getdate();
	            if($_POST['ngay'] && $_POST['thang'] && $_POST['nam'])
	            {
	              	$time= mktime($today['hours'], $today['minutes'], $today['seconds'], $_POST['thang'], $_POST['ngay'], $_POST['nam']);
	            }
	            else
	            {
	              	$time= $today[0];
	            }

	            if($title != "" && $image != "")
	            {
                	$return= $this->Album->saveAlbumNew($time,$title,$image,$key,$slug,$lock,$id);
                }
                
                $this->redirect($urlLocal['urlAlbums'].'infoAlbum/'.$return);

            }
            else 
            {
	            $this->redirect($urlLocal['urlAdmins'].'login');
            }

        }

        function infoAlbum($id)
        {
            //Configure::write('debug', 2);
            Controller::loadModel('Option');
        	$urlLocal= $this->getUrlLocal();

            $users= $this->Session->read('infoAdminLogin');
            if($users)
            {
	            $this->setup();
	            Controller::loadModel('Album');
                if(!$id) 
                {
                	$this->redirect($urlLocal['urlAlbums']);
                }
                else
                {
                  $albums= $this->Album->getAlbum($id);
                  $this->set('albums', $albums);
                }
            }
            else 
            {
	            $this->redirect($urlLocal['urlAdmins'].'login');
            }
        }

        function saveImgAlbum()
        {   //Configure::write('debug', 2);

            $users= $this->Session->read('infoAdminLogin');
        	$urlLocal= $this->getUrlLocal();

            if($users)
            {
	            Controller::loadModel('Album');
                $id= new MongoId($_POST['id']);
                $idIMG= $_POST['idIMG'];
                $image= $_POST['image'];
                $note= $_POST['note'];
                $link= $_POST['link'];

                if($image!="")
                {
                  $return= $this->Album->saveImgAlbum($image,$note,$id,$link,$idIMG);
                }

                $this->redirect($urlLocal['urlAlbums'].'infoAlbum/'.$_POST['id']);

            }
            else 
            {
	            $this->redirect($urlLocal['urlAdmins'].'login');
            }
        }

        function deleteAlbum()
        {
            $users= $this->Session->read('infoAdminLogin');
        	$urlLocal= $this->getUrlLocal();
        	
            if($users)
            {

                $id= new MongoId($_POST['id']);
                if($_POST['id']!="")
                {

                  Controller::loadModel('Album');

                  $this->Album->delete($id);

                }
                $this->redirect($urlLocal['urlAlbums'].'listAlbums');
            }
            else 
            {
	            $this->redirect($urlLocal['urlAdmins'].'login');
            }

        }

        function deleteImgAlbum()
        {
            $users= $this->Session->read('infoAdminLogin');
            if($users)
            {
                $id= new MongoId($_POST['idAlbum']);
                
                if($_POST['idIMG']!="")
                {

                  Controller::loadModel('Album');

                  $idXoa= (int) $_POST['idIMG'];

                  $return= $this->Album->deleteImgAlbum($idXoa,$id);

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
         	Controller::loadModel('Album');
         	
         	if(!$slug)
         	{
         		$dk= array('lock'=>array('$ne'=>1) );
	            $this->paginate = array(
										'conditions' => $dk,
	                                    'limit' => 15,
	
	                                    'order' => array('time' => 'desc'),
	
	                                    );
	
	            $return = $this->paginate("Album");
	            
	            $this->set('listAlbums', $return);
	            
	            global $metaTitleMantan;
	            $metaTitleMantan= 'Albums | '.$metaTitleMantan;
            }
            else
            {
            	$slug= str_replace('.html', '', $slug);
	            $infoAlbum= $this->Album->getSlugAlbum($slug);
	            
	            if($infoAlbum)
	            {
	            	$this->set('infoAlbum', $infoAlbum);
	            	
	            	global $metaTitleMantan;
					$metaTitleMantan= $infoAlbum['Album']['title'].' | '.$metaTitleMantan;
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