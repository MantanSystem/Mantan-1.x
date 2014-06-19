<?php
   class Video extends AppModel
   {
       var $name = 'Video';

       function getNewVideo($limit=5,$dk)
       {
       	  $listData = $this->find('all', array('order' => array('time'=> 'DESC'),
                                              'limit' =>$limit,
                                              'conditions' => $dk

                                            ));
          return $listData;
       }
       
       function saveData($name,$code,$slug,$id= null)
       {
       		 $listSlug= array();
	       	 $number= 0;
	       	 $slugStart= $slug;
	       	 do
	       	 {
	       	 	 $number++;
		       	 $listSlug= $this->find('all', array('conditions' => array('slug'=>$slug) ));
				 if(count($listSlug)>0 && $listSlug[0]['Video']['id']!=$id)
				 {
				 	$slug= $slugStart.'-'.$number;
		       	 }
	       	 } while (count($listSlug)>0 && $listSlug[0]['Video']['id']!=$id);
	       	 
	         if($id)
	         {
	            $id= new MongoId($id);
	            $save= $this->getVideo($id);
	         }
	         else
	         {
	            $today= getdate();
	            $save['Video']['time']= $today[0];
	            $save['Video']['view']= 0;
	         }
	         $save['Video']['name']= $name;
	         $save['Video']['code']= $code;
	         $save['Video']['slug']= $slug;
	
	         $this->save($save);
	         return 1;
       }
       
       function getVideo($id)
       {
         $dk = array ('_id' => $id);
         $return = $this -> find('first', array('conditions' => $dk) );
         return $return;
       }
       
       function getSlugVideo($slug)
       {
         $dk = array ('slug' => $slug);
         $return = $this -> find('first', array('conditions' => $dk) );
         return $return;
       }

   }
?>