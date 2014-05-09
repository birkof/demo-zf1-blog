<?php

/**
 * @package		Sidebar
 * @category	Helpers
 * @author		Daniel Stancu <birkof@birkof.ro>
 * @copyright 	Copyright (c) 2014 Daniel STANCU (http://birkof.ro)
 * @license		GPLv3 (http://www.gnu.org/licenses/gpl-3.0.html)
 */
class View_Helper_Sidebar extends Zend_View_Helper_Abstract 
{
	/*
     * Tags list
     */
    public function tags(){

       $tag = new Model_DbTable_Tags();

       return $tag->getTags();
    }
}