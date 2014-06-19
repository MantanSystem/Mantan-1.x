<?php
   class Notice extends AppModel
   {
       var $name = 'Notice';

       function getNewNotice($limit=5)
       {
       	  $dk = array ( 'type'=> 'post' );
       	  
          $notices = $this->find('all', array('order' => array('created'=> 'DESC'),
                                              'limit' =>$limit,
                                              'conditions' => $dk

                                            ));
          return $notices;
       }
       
       function getAllPage()
       {
	       $dk = array ( 'type'=>'page' );
       	  
           $notices = $this->find('all', array( 'order' => array('created'=> 'DESC'),
                                             
                                             	'conditions' => $dk

                                            ));
          return $notices;
       }
       
       function savePages($slug,$author,$title,$key,$content,$image,$id)
       {
       		 $listSlug= array();
	       	 $number= 0;
	       	 $slugStart= $slug;
	       	 do
	       	 {
	       	 	 $number++;
		       	 $listSlug= $this->find('all', array('conditions' => array('slug'=>$slug) ));
				 if(count($listSlug)>0 && $listSlug[0]['Notice']['id']!=$id)
				 {
				 	$slug= $slugStart.'-'.$number;
		       	 }
	       	 } while (count($listSlug)>0 && $listSlug[0]['Notice']['id']!=$id);
	       	 
	         if($id != null)
	         {
	            $id= new MongoId($id);
	            $save= $this->getNotice($id);
	         }
	         else
	         {
	            $save['Notice']['view']= 0;
	         }
	         $save['Notice']['title']= $title;
	         $save['Notice']['key']= $key;
	         $save['Notice']['content']= $content;
	         $save['Notice']['author']= $author;
	         $save['Notice']['slug']= $slug;
	         $save['Notice']['type']= 'page';
	         $save['Notice']['image']= $image;
	         $save['Notice']['introductory']= $this->getIntroductory($content,30);
	         
	         $this->save($save);
	         return 1;
       }
       
       function saveNotices($slug,$time,$author,$title,$key,$content,$category,$image,$event,$id= null)
       {
       	 $listSlug= array();
       	 $number= 0;
       	 $slugStart= $slug;
       	 do
       	 {
       	 	 $number++;
	       	 $listSlug= $this->find('all', array('conditions' => array('slug'=>$slug) ));
			 if(count($listSlug)>0 && $listSlug[0]['Notice']['id']!=$id)
			 {
			 	$slug= $slugStart.'-'.$number;
	       	 }
       	 } while (count($listSlug)>0 && $listSlug[0]['Notice']['id']!=$id);
       	 
       	 $save['Notice']['title']= $title;
         $save['Notice']['slug']= $slug;
         $save['Notice']['key']= $key;
         $save['Notice']['content']= $content;
         $save['Notice']['category']= $category;
         $save['Notice']['image']= $image;
         $save['Notice']['event']= $event;
         $save['Notice']['author']= $author;         
         $save['Notice']['introductory']= $this->getIntroductory($content,30);
         $save['Notice']['time']= (int)$time;
         $save['Notice']['type']= 'post';
         
         if($id != null)
         {
            $id= new MongoId($id);
            $dk= array('_id'=>$id);
            $this->updateAll($save['Notice'],$dk);
         }
         else
         {
            $save['Notice']['view']= 0;
            $this->save($save);
         }
         return 1;
       }
       
       function getNotice($idNotice)
       {
         $dk = array ('_id' => $idNotice);
         $notice = $this -> find('first', array('conditions' => $dk) );
         return $notice;
       }
       
       function getOtherNotice($category=array(),$limit=5)
       {
       		 if(!$category) 
       		 {
	       		 $conditions['category']= null;
       		 }
       		 else
       		 {
	         	$conditions['category']= array('$in'=>$category);
	         }
	         $notice = $this -> find('all', array('conditions' => $conditions,'limit' =>$limit) );
	         return $notice;
       }
       
       function getSlugNotice($slug)
       {
         $dk = array ('slug' => $slug);
         $notice = $this -> find('first', array('conditions' => $dk) );
         return $notice;
       }

        function getIntroductory($document,$soTu)
        {
          //$modau= $this->tachHTML($document);
          $modau= strip_tags($document, ""); 
          $st= explode(" ", $modau);
          $modau= "";
          for($i=0;$i<$soTu;$i++)
          {
            $modau= $modau." ".$st[$i];
          }
          $modau= $modau." ...";
          return $modau;
        }
        
        
   }
?>