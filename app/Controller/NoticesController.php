<?php
   class NoticesController extends AppController
   {
	    var $name = 'Notices';
	    var $helpers = array('Session','Paginator');

        var $paginate = array();
		
		
        
// Quan ly tin tuc         
       function listNotices()
       {
         //Configure::write('debug', 2);

         $users= $this->Session->read('infoAdminLogin');
         if($users)
         {
	         	$this->setup();
	            $this->set('menu', 3);
	             
	            Controller::loadModel('Option');
	            Controller::loadModel('Notice');
	
	            $chuyenmuc= $this->Option->getOption('categoryNotice');
	
	            $this->set('chuyenmuc', $chuyenmuc["Option"]['value']['category']);
	             
             	$dk['type']= 'post';
             	
	            if($_GET['category']>0)
	            {
		            $dk['category']= (int) $_GET['category'];
	            }

                $this->paginate = array(

                                        'limit' => 15,

                                        'conditions' => $dk,

                                        'order' => array('created'=> 'DESC')

                                        );

                
                $return = $this->paginate("Notice");
                
                $cat= array();
                foreach($return as $tin)
                {
                	foreach($tin['Notice']['category'] as $catNoti)
                	{
		                if(!isset($cat[ $catNoti ] ))
		                {
		                	if(!$cat[ $catNoti ])
		                	{
				                $catName= $this->Option->getcat($chuyenmuc["Option"]['value']['category'],$catNoti);
				                //debug($catName);
				                $cat[ $catNoti ]= $catName['name'];
			                }
		                }
	                }
                }
                
                $this->set('nameCat', $cat);
                $this->set('listNotices', $return);
         }
         else 
         {
        	$urlLocal= $this->getUrlLocal();
            $this->redirect($urlLocal['urlAdmins'].'login');
         }

       }
       
       function addNotices($idNotice)
       {
       		//Configure::write('debug', 2);
       	 	$users= $this->Session->read('infoAdminLogin');
       	 	if($users)
       	 	{
	         	 $this->setup();
	             
	             Controller::loadModel('Option');
	             Controller::loadModel('Notice');
	
	             $chuyenmuc= $this->Option->getOption('categoryNotice');
	             $this->set('chuyenmuc', $chuyenmuc["Option"]['value']['category']);

                 if($idNotice)
                 {
                    $idNotice= new MongoId($idNotice);

                    $return= $this->Notice->getNotice($idNotice);

                    $this->set('news', $return);
                 }
             }
             else 
             {
            	$urlLocal= $this->getUrlLocal();
	            $this->redirect($urlLocal['urlAdmins'].'login');
             }
       }
       
       function deleteNotice()
       {
         //Configure::write('debug', 2);

         $users= $this->Session->read('infoAdminLogin');
         if($users)
         {
           $id= $_POST['id'];

           if($id != "")
           {
           	 Controller::loadModel('Notice');
             $id= new MongoId($id);
             $this->Notice->delete($id);
           }

         }

       }
       
       function getCheckCat($cat,$check)
       {
       		if($_POST['category'.$cat['id']])
       		{
       			$idCat= (int) $_POST['category'.$cat['id']];
	       		array_push($check, $idCat);
       		}
       		
			foreach($cat['sub'] as $sub)
			{
				$check= $this->getCheckCat($sub,$check);
			}
			return $check;
	   }
		
       function saveNotices()
       {
	       //Configure::write('debug', 2);
         $users= $this->Session->read('infoAdminLogin');
         Controller::loadModel('Option');
    	 $urlLocal= $this->getUrlLocal();
    	 
         if($users)
         {
         	 $dataSend= $this->data;
             $title= chop($dataSend['title']);

             if($title != "")

             {

              Controller::loadModel('Notice');

              $key= chop($dataSend['key']);

              $image= chop($dataSend['image']);

              $content= chop($dataSend['content']);
              $slug= chop($dataSend['slug']);
	
	          $chuyenmucAll= $this->Option->getOption('categoryNotice');

              $category= array();
              foreach($chuyenmucAll["Option"]["value"]['category'] as $cat)
			  {
					$category= $this->getCheckCat($cat,$category);
			  }

              $event= (int) $dataSend['event'];
              
              $author= chop($dataSend['author']);

              $id= chop($dataSend['id']);

              if($id=="") $id= null;
              
              $today= getdate();
              if($dataSend['ngay'] && $dataSend['thang'] && $dataSend['nam'])
              {
	              $time= mktime($today['hours'], $today['minutes'], $today['seconds'], $dataSend['thang'], $dataSend['ngay'], $dataSend['nam']);
              }
              else
              {
	              $time= $today[0];
              }

              $return= $this->Notice->saveNotices($slug,$time,$author,$title,$key,$content,$category,$image,$event,$id);

             }

             $this->redirect($urlLocal['urlNotices'].'listNotices');

           }
           else 
           {
	            $this->redirect($urlLocal['urlAdmins'].'login');
           }

       }
       
// Quan ly trang tinh -------------
	function listPages()
	{
		 //Configure::write('debug', 2);

         $users= $this->Session->read('infoAdminLogin');
         if($users)
         {
	         	$this->setup();
	            Controller::loadModel('Notice');
                $dk = array ('type' => 'page');

                $this->paginate = array(

                                        'limit' => 15,

                                        'conditions' => $dk,

                                        'order' => array('created' => 'desc'),

                                        );

                $return = $this->paginate("Notice");

                $this->set('listNotices', $return);
         }
         else 
         {
        	$urlLocal= $this->getUrlLocal();

            $this->redirect($urlLocal['urlAdmins'].'login');
         }
	}
	
	function addPage($idNotice)
	{
		 $users= $this->Session->read('infoAdminLogin');

         if($users)
         {
         		$this->setup();
         		if($idNotice)
         		{
         			Controller::loadModel('Notice');
	            	$idNotice= new MongoId($idNotice);
	
	                $return= $this->Notice->getNotice($idNotice);
	                $this->set('news', $return);
                }
         }
         else 
         {
        	$urlLocal= $this->getUrlLocal();

            $this->redirect($urlLocal['urlAdmins'].'login');
         }
	}
	
	
       function savePages()
       {
	       //Configure::write('debug', 2);
         $users= $this->Session->read('infoAdminLogin');
    	 $urlLocal= $this->getUrlLocal();
    	
         if($users)
         {
         	 $dataSend= $this->data;
	         $title= chop($dataSend['title']);

	         if($title != "")
	         {
		      Controller::loadModel('Notice');
              $key= chop($dataSend['key']);
              $author= chop($dataSend['author']);
              $content= chop($dataSend['content']);
              $slug= chop($dataSend['slug']);
              $id= chop($dataSend['id']);
              $image= chop($dataSend['image']);

              if($id=="") $id= null;

              $return= $this->Notice->savePages($slug,$author,$title,$key,$content,$image,$id);

             }

             $this->redirect($urlLocal['urlNotices'].'listPages');

         }
         else 
         {
            $this->redirect($urlLocal['urlAdmins'].'login');
         }
       }
// Page - Post
	function index($slug)
	{
		global $infoNotice;
		//Configure::write('debug', 2);
		Controller::loadModel('Notice');
		
		$this->setup();
		$this->layout='default';
		$urlLocal= $this->getUrlLocal();
		
		$slug= str_replace('.html', '', $slug);
		$infoNotice= $this->Notice->getSlugNotice($slug);
		
		if($infoNotice)
		{
			$this->set('infoNotice', $infoNotice);
			$otherNotices= $this->Notice->getOtherNotice($infoNotice['Notice']['category'],5);
			$this->set('otherNotices', $otherNotices);
			$this->loadModel();
			
			global $isPost;
			global $isPage;
			
			
			if($infoNotice['Notice']['type']=='post')
			{
				$isPost= true;
			}
			else
			{
				$isPage= true;
			}
			
			global $metaTitleMantan;
			global $metaKeywordsMantan;
			global $metaDescriptionMantan;
			
			$metaTitleMantan= $infoNotice['Notice']['title'];
			$metaKeywordsMantan= $infoNotice['Notice']['key'];
			$metaDescriptionMantan= $infoNotice['Notice']['introductory'];
		}
		else
		{
			$this->redirect($urlLocal['urlHomes']);
		}
	}     
// Page Category	
	function cat($slug)
	{
		//Configure::write('debug', 2);
		global $categoryNotice;
		global $isCategory;
		$isCategory= true;
		
		$this->setup();
		$this->layout='default';
		
		$this->loadModel();
		Controller::loadModel('Notice');
		Controller::loadModel('Option');
		
		$urlLocal= $this->getUrlLocal();
		
		$slug= str_replace('.html', '', $slug);
		$category= $this->Option->getOption('categoryNotice');
		
		$category= $this->Option->getcat($category['Option']['value']['category'],$slug,'slug');
		
		if($category)
		{
			$dk = array ('category' => $category['id']);
			
	        $this->paginate = array(
	
	                                'limit' => 10,
	
	                                'conditions' => $dk,
	
	                                'order' => array('created' => 'desc'),
	
	                                );
	
	        $return = $this->paginate("Notice");
	        
	        $this->set('listNotices', $return);
	        $this->set('category', $category);
	        
	        $categoryNotice= $category;
	        
	        global $metaTitleMantan;
			global $metaKeywordsMantan;
			global $metaDescriptionMantan;
			
			$metaTitleMantan= $category['name'];
			$metaKeywordsMantan= $category['key'];
			$metaDescriptionMantan= $category['description'];
        }
        else
		{
			$this->redirect($urlLocal['urlHomes']);
		}
        
	}
// Page Search	
	function search()
	{
		//Configure::write('debug', 2);
		global $isSearch;
		$isSearch= true;
		
		$this->setup();
		$this->layout='default';
		
		$this->loadModel();
		Controller::loadModel('Notice');
		Controller::loadModel('Option');
		
		$conditions['content']= array('$regex' => $_GET['key']);
		
        $this->paginate = array(

                                'limit' => 15,

                                'conditions' => $conditions,

                                'order' => array('created' => 'desc'),

                                );

        $return = $this->paginate("Notice");
        
        $this->set('listNotices', $return);
	}
   
   }
?>