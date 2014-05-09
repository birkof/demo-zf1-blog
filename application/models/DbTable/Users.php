<?php

/**
 * User Model
 *
 * @package       User
 * @category      Model
 * @author        Daniel Stancu <birkof@birkof.ro>
 * @copyright     Copyright (c) 2014 Daniel STANCU (http://birkof.ro)
 * @license       GPLv3 (http://www.gnu.org/licenses/gpl-3.0.html)
 */
class Model_DbTable_Users extends Zend_Db_Table_Abstract
{
    protected $_name = 'user';

    /*
     * Find user credentials
     */
    public function findCredentials($username, $pwd)
    {
        $select = $this->select()->where('username = ?', $username)->where('password = ?', $this->hashPassword($pwd));
        $row    = $this->fetchRow($select);

        return $row ? $row : false;
    }

    /*
     * Return an md5 hash
     */
    protected function hashPassword($pwd)
    {
        return md5($pwd);
    }
}
