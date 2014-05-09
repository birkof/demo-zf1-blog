<?php

/**
 * @package		Index
 * @category	Controllers
 * @author		Daniel Stancu <birkof@birkof.ro>
 * @copyright 	Copyright (c) 2014 Daniel STANCU (http://birkof.ro)
 * @license		GPLv3 (http://www.gnu.org/licenses/gpl-3.0.html)
 */
class IndexController extends Zend_Controller_Action
{
	/*
     * Initialize action controller here
     */
	public function init()
    {
    }

	/*
     * Index action
     */
    public function indexAction()
    {
		// Get new articles and paginate them
        $article = new Model_DbTable_Articles();
		$result = $article->getArticles();
		
		// Paginate resultset
		$paginator = Zend_Paginator::factory($result);
		$paginator->setItemCountPerPage(1);
		$paginator->setCurrentPageNumber($this->_getParam('page', 1));
		
		// Assign data to view
		$this->view->articles = $paginator;
    }
}
