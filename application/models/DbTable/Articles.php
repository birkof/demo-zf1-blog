<?php

/**
 * Article Model
 *
 * @package       Article
 * @category      Model
 * @author        Daniel Stancu <birkof@birkof.ro>
 * @copyright     Copyright (c) 2014 Daniel STANCU (http://birkof.ro)
 * @license       GPLv3 (http://www.gnu.org/licenses/gpl-3.0.html)
 */
class Model_DbTable_Articles extends Zend_Db_Table_Abstract
{
    protected $_name = 'article';

    /*
     * Get all available articles
     */
    public function getArticles()
    {
		// Get all the published articles from database
		$select = $this->select()
			->setIntegrityCheck(false)
			->from(['a' => $this->_name], ['a.article_id', 'a.title', 'a.content', 'date' => 'UNIX_TIMESTAMP(a.added_at)'])
			->joinUsing(['u' => 'user'], 'user_id', ['author' => 'u.name', 'u.username', 'u.slug'])
			->where('a.`status` = ?', 1)
			->order('a.article_id DESC');
		$results = $this->fetchAll($select)->toArray();
		
		// Extracting tags for each article
		array_walk($results, function(&$value, $key){
			$tag = new Model_DbTable_Tags();
			$value['tags'] = $tag->getTagsByArticle($value['article_id']);
		});

		return $results;
    }
	
	
	/*
     * Get all articles by tag name
     */
	public function getArticlesByTag($tag = null) 
	{
		if(is_null($tag)) {
			return [];
		}
		
		$select = $this->select()
			->setIntegrityCheck(false)
			->from(['t' => 'tag'], ['t.tag_id', 't.name', 't.slug'])
			->joinUsing(['tr' => 'tag_relation'], 'tag_id', ['tag_relation_id' => 'id'])
			->join(['a' => 'article'], 'tr.article_id = a.article_id', ['a.article_id', 'a.title', 'a.content', 'date' => 'UNIX_TIMESTAMP(a.added_at)'])
			->join(['u' => 'user'], 'a.user_id = u.user_id', ['author' => 'u.name', 'u.username', 'u.slug'])
			->where('t.`status` = ?', 1)
			->where('a.`status` = ?', 1)
			->where('t.`slug` = ?', strtolower($tag))
			->order('a.article_id DESC');

		return $this->fetchAll($select)->toArray();
	}

    /*
     * Get an old article
     */
    public function getArticle($id)
    {
        $id  = (int)$id;
        $row = $this->fetchRow('article_id = ' . $id);
        if (!$row) {
            throw new Exception("Count not find row $id");
        }

        return $row->toArray();
    }

    /*
     * Add new article
     */
    public function saveArticle($post)
    {
        $this->insert(['title' => $post['title'], 'content' => $post['content']]);
    }

    /*
     * Update an old article
     */
    public function updateArticle($post)
    {
        $this->update(
            ['article_id' => $post['id'], 'title' => $post['title'], 'content' => $post['content']],
            'article_id = ' . $post['id']
        );
    }
}
