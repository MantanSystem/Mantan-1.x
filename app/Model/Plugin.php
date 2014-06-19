<?php
   class Plugin extends AppModel
   {
       var $name = 'Plugin';
       
       function getPluginActive()
       {
	       Controller::loadModel('Option');
	       $plugins= $this->Option->getOption('plugins');
	       return $plugins;
       }
   }
?>