<?php

   class Admin extends AppModel

   {

       var $name = 'Admin';

      
       
       function getAdmin($id)
       {
	       $id= new MongoId($id);
           $dk = array ('_id' => $id);
           $return = $this -> find('first', array('conditions' => $dk) );
           return $return;
       }
       
       
       function checkLogin($user,$password)
       {

         $dk = array ('user' => $user,'password'=>$password);

         $lay= array ('password'=> 0);

         $users= $this -> find('first', array('conditions' => $dk,'fields' => $lay) );
        
         return $users;

       }
       
       function changePass($passOld,$pass1,$id)
       {

         $dk= array('_id'=>$id);
         $lay= array('password'=>1);

         $admins= $this -> find('first', array('conditions' => $dk,'fields' => $lay) );
         if($admins)
         {

           if($admins['Admin']['password']== $passOld)

           {

             $admins['Admin']['password']= $pass1;

             $this->save($admins,  false,  array('password') );

             return 1;

           }

           else return -3;

         }
         return -1;

       }
       
       function saveAdmin($user,$pass)
       {
	       $save['Admin']['user']= $user;
	       $save['Admin']['password']= $pass;
	       
	       $this->save($save);
       }


   }

?>