<?php

/**
 * @package		Param
 * @category	Helpers
 * @author		Daniel Stancu <birkof@birkof.ro>
 * @copyright 	Copyright (c) 2014 Daniel STANCU (http://birkof.ro)
 * @license		GPLv3 (http://www.gnu.org/licenses/gpl-3.0.html)
 */
class View_Helper_Param extends Zend_View_Helper_Abstract 
{
	/**
	 * Retrieve param
	 *
	 * @param string $name key
	 * @return string
	 */
    public function param($name)
    {  
		return Zend_Controller_Front::getInstance()->getRequest()->getParam($name);
    }  
}