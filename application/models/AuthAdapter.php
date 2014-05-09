<?php

/**
 * @package       Authentication
 * @category      Adapters
 * @author        Daniel Stancu <birkof@birkof.ro>
 * @copyright     Copyright (c) 2014 Daniel STANCU (http://birkof.ro)
 * @license       GPLv3 (http://www.gnu.org/licenses/gpl-3.0.html)
 */
class Model_AuthAdapter implements Zend_Auth_Adapter_Interface
{
    protected $username;

    protected $password;

    protected $user;

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
        $this->user     = new Model_DbTable_Users();
    }

    public function authenticate()
    {
        $match = $this->user->findCredentials($this->username, $this->password);
        if ($match) {
            $user = current($match);
            return new Zend_Auth_Result(Zend_Auth_Result::SUCCESS, $user);
        } else {
            return new Zend_Auth_Result(Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID, null);

        }
    }

}
