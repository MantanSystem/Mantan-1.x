<?php

   class User extends AppModel
   {

       var $name = 'User';
       
       function getPage($page,$limit,$conditions)
       {
	       $array= array(
	                        'limit' => $limit,
	                        'page' => $page,
	                        'order' => array('created' => 'desc'),
	                        'conditions' => $conditions
	
	                    );
	       return $this -> find('all', $array);             
       }
       
       function getUser($id)
       {
	         $id= new MongoId($id);
	         $dk = array ('_id' => $id);
	         $return = $this -> find('first', array('conditions' => $dk) );
	         return $return;

       }
       
       function getUserCode($user)
       {
	         $dk = array ('user' => $user);
	         $return = $this -> find('first', array('conditions' => $dk) );
	         return $return;

       }
       
       function checkLogin($user,$password)
       {
	       $dk = array ('user' => $user,'password'=>$password);
	       $lay= array ('password'=> 0);

	       $return = $this -> find('first', array('conditions' => $dk,'fields' => $lay) );
        
	       return $return;
       }
   }
?>