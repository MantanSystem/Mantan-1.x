<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */	
 	/*
 	$urlBase= Router::url('/');
 	
 	if(strpos(strtolower($urlBase),'index.php/'))
 	{
	 	$urlBase= substr_replace($urlBase, '', -10);  
 	}
 	*/
 	$urlBase= '/';
 	// AdminsController
 	Router::connect($urlBase.'admins/installMantan/*', array('controller' => 'admins', 'action' => 'installMantan'));
 	Router::connect($urlBase.'admins/startInstall/*', array('controller' => 'admins', 'action' => 'startInstall'));
 	Router::connect($urlBase.'admins/createDataDefault/*', array('controller' => 'admins', 'action' => 'createDataDefault'));
 	Router::connect($urlBase.'admins/login/*', array('controller' => 'admins', 'action' => 'login'));
 	Router::connect($urlBase.'admins/loginAfter/*', array('controller' => 'admins', 'action' => 'loginAfter'));
 	Router::connect($urlBase.'admins/logout/*', array('controller' => 'admins', 'action' => 'logout'));
 	Router::connect($urlBase.'admins/account/*', array('controller' => 'admins', 'action' => 'account'));
 	Router::connect($urlBase.'admins/changePass/*', array('controller' => 'admins', 'action' => 'changePass'));
 	
 	Router::connect($urlBase.'admins/*', array('controller' => 'admins', 'action' => 'index'));
 	
 	// AlbumsController
 	Router::connect($urlBase.'albums/listAlbums/*', array('controller' => 'albums', 'action' => 'listAlbums'));
 	Router::connect($urlBase.'albums/editInfoAlbum/*', array('controller' => 'albums', 'action' => 'editInfoAlbum'));
 	Router::connect($urlBase.'albums/saveAlbum/*', array('controller' => 'albums', 'action' => 'saveAlbum'));
 	Router::connect($urlBase.'albums/infoAlbum/*', array('controller' => 'albums', 'action' => 'infoAlbum'));
 	Router::connect($urlBase.'albums/saveImgAlbum/*', array('controller' => 'albums', 'action' => 'saveImgAlbum'));
 	Router::connect($urlBase.'albums/deleteAlbum/*', array('controller' => 'albums', 'action' => 'deleteAlbum'));
 	Router::connect($urlBase.'albums/deleteImgAlbum/*', array('controller' => 'albums', 'action' => 'deleteImgAlbum'));
 	
 	Router::connect($urlBase.'albums/*', array('controller' => 'albums', 'action' => 'index'));
 	
 	// HomesController
 	Router::connect($urlBase, array('controller' => 'homes', 'action' => 'index'));
 	Router::connect($urlBase.'homes/*', array('controller' => 'homes', 'action' => 'index'));
 	
 	// OptionsController
 	Router::connect($urlBase.'options/categoryNotice/*', array('controller' => 'options', 'action' => 'categoryNotice'));
 	Router::connect($urlBase.'options/saveCategoryNotice/*', array('controller' => 'options', 'action' => 'saveCategoryNotice'));
 	Router::connect($urlBase.'options/deleteCatagery/*', array('controller' => 'options', 'action' => 'deleteCatagery'));
 	Router::connect($urlBase.'options/changeCategoryNotice/*', array('controller' => 'options', 'action' => 'changeCategoryNotice'));
 	Router::connect($urlBase.'options/themes/*', array('controller' => 'options', 'action' => 'themes'));
 	Router::connect($urlBase.'options/changeTheme/*', array('controller' => 'options', 'action' => 'changeTheme'));
 	Router::connect($urlBase.'options/languages/*', array('controller' => 'options', 'action' => 'languages'));
 	Router::connect($urlBase.'options/activeLanguage/*', array('controller' => 'options', 'action' => 'activeLanguage'));
 	
 	Router::connect($urlBase.'options/saveInfoMenu/*', array('controller' => 'options', 'action' => 'saveInfoMenu'));
 	Router::connect($urlBase.'options/deleteOneMenu/*', array('controller' => 'options', 'action' => 'deleteOneMenu'));
 	Router::connect($urlBase.'options/menus/*', array('controller' => 'options', 'action' => 'menus'));
 	Router::connect($urlBase.'options/saveMenus/*', array('controller' => 'options', 'action' => 'saveMenus'));
 	Router::connect($urlBase.'options/changeMenus/*', array('controller' => 'options', 'action' => 'changeMenus'));
 	Router::connect($urlBase.'options/deleteMenus/*', array('controller' => 'options', 'action' => 'deleteMenus'));
 	Router::connect($urlBase.'options/infoSite/*', array('controller' => 'options', 'action' => 'infoSite'));
 	Router::connect($urlBase.'options/saveInfoSite/*', array('controller' => 'options', 'action' => 'saveInfoSite'));
 	Router::connect($urlBase.'options/plugins/*', array('controller' => 'options', 'action' => 'plugins'));
 	Router::connect($urlBase.'options/activePlugin/*', array('controller' => 'options', 'action' => 'activePlugin'));
 	Router::connect($urlBase.'options/deactivePlugin/*', array('controller' => 'options', 'action' => 'deactivePlugin'));
 	Router::connect($urlBase.'options/deletePlugin/*', array('controller' => 'options', 'action' => 'deletePlugin'));
 	
 	Router::connect($urlBase.'options/*', array('controller' => 'options', 'action' => 'index'));
 	
 	// NoticesController
 	Router::connect($urlBase.'notices/listNotices/*', array('controller' => 'notices', 'action' => 'listNotices'));
 	Router::connect($urlBase.'notices/addNotices/*', array('controller' => 'notices', 'action' => 'addNotices'));
 	Router::connect($urlBase.'notices/deleteNotice/*', array('controller' => 'notices', 'action' => 'deleteNotice'));
 	Router::connect($urlBase.'notices/saveNotices/*', array('controller' => 'notices', 'action' => 'saveNotices'));
 	Router::connect($urlBase.'notices/listPages/*', array('controller' => 'notices', 'action' => 'listPages'));
 	Router::connect($urlBase.'notices/addPage/*', array('controller' => 'notices', 'action' => 'addPage'));
 	Router::connect($urlBase.'notices/savePages/*', array('controller' => 'notices', 'action' => 'savePages'));
 	Router::connect($urlBase.'notices/cat/*', array('controller' => 'notices', 'action' => 'cat'));
 	Router::connect($urlBase.'notices/search/*', array('controller' => 'notices', 'action' => 'search'));
 	
 	Router::connect($urlBase.'notices/*', array('controller' => 'notices', 'action' => 'index'));
 	
 	// VideosController
 	Router::connect($urlBase.'videos/listVideos/*', array('controller' => 'videos', 'action' => 'listVideos'));
 	Router::connect($urlBase.'videos/saveData/*', array('controller' => 'videos', 'action' => 'saveData'));
 	Router::connect($urlBase.'videos/deleteData/*', array('controller' => 'videos', 'action' => 'deleteData'));
 	
 	Router::connect($urlBase.'videos/*', array('controller' => 'videos', 'action' => 'index'));
 	
 	// PluginsController
 	Router::connect($urlBase.'plugins/admin/*', array('controller' => 'plugins', 'action' => 'admin'));
	Router::connect($urlBase.'plugins/*', array('controller' => 'plugins', 'action' => 'index'));
	Router::connect($urlBase.'*', array('controller' => 'plugins', 'action' => 'index'));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
