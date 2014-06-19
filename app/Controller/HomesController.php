<?php

   class HomesController extends AppController
   {

	    var $name = 'Homes';

        var $helpers = array('Session','Paginator');

        var $paginate = array();
		
		function index()
		{
			//Configure::write('debug', 2);
			$this->setup();
			$this->layout='default';
			$this->loadModel();
		}
   }
?>