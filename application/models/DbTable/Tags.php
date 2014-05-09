<?php

/**
 * Tag Model
 *
 * @package       Tag
 * @category      Model
 * @author        Daniel Stancu <birkof@birkof.ro>
 * @copyright     Copyright (c) 2014 Daniel STANCU (http://birkof.ro)
 * @license       GPLv3 (http://www.gnu.org/licenses/gpl-3.0.html)
 */
class Model_DbTable_Tags extends Zend_Db_Table_Abstract
{
    protected $_name = 'tag';

	/*
     * Get all available tags
     */
    public function getTags()
    {
		return $this->fetchAll('status = 1', ['name ASC'])->toArray();
    }

    /*
     * Get all tags from an article
     */
    public function getTagsByArticle($id)
    {
        $select = $this->select()
			->setIntegrityCheck(false)
			->from(['t' => $this->_name], ['t.tag_id', 't.name', 't.slug'])
			->joinUsing(['tr' => 'tag_relation'], 'tag_id', ['tag_relation_id' => 'id'])
			->where('t.`status` = ?', 1)
			->where('tr.`article_id` = ?', (int)$id)
			->order('t.name ASC');

		return $this->fetchAll($select)->toArray();
    }
}
