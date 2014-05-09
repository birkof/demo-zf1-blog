<?php

/**
 * Application Bootstrap
 *
 * @package       Application
 * @category      Bootstrap
 * @author        Daniel Stancu <birkof@birkof.ro>
 * @copyright     Copyright (c) 2014 Daniel STANCU (http://birkof.ro)
 * @license       GPLv3 (http://www.gnu.org/licenses/gpl-3.0.html)
 */
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected function _initAutoload() 
	{
		return new Zend_Application_Module_Autoloader(['namespace' => '', 'basePath' => APP_PATH]);
	}

    protected function _initViewHelpers() 
	{
        // Get the layout resource view
        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view   = $layout->getView();
		$view->setHelperPath(APP_PATH . '/helpers', 'View_Helper');
		
		// Test if a user is logged in
		if (Zend_Auth::getInstance()->hasIdentity()) {
			$view->user = Zend_Auth::getInstance()->getIdentity();
		}
    }
	
	
    protected function _initRewrite()
	{
        $router = new Zend_Controller_Router_Rewrite();
        $router->addConfig(new Zend_Config_Ini(APP_PATH . '/configs/routes.ini', 'bootstrap'), 'routes');
        $router->removeDefaultRoutes();
        Zend_Controller_Front::getInstance()->setRouter($router);
    }
}
