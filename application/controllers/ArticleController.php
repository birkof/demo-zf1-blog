<?php

/**
 * @package		Article
 * @category	Controllers
 * @author		Daniel Stancu <birkof@birkof.ro>
 * @copyright 	Copyright (c) 2014 Daniel STANCU (http://birkof.ro)
 * @license		GPLv3 (http://www.gnu.org/licenses/gpl-3.0.html)
 */
class ArticleController extends Zend_Controller_Action
{
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
		$paginator->setItemCountPerPage(5);
		$paginator->setCurrentPageNumber($this->_getParam('page', 1));
		
		// Assign data to view
		$this->view->articles = $paginator;
    }
}
