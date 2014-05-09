<?php

/**
 * @package       Authentication
 * @category      Controllers
 * @author        Daniel Stancu <birkof@birkof.ro>
 * @copyright     Copyright (c) 2014 Daniel STANCU (http://birkof.ro)
 * @license       GPLv3 (http://www.gnu.org/licenses/gpl-3.0.html)
 */
class AuthController extends Zend_Controller_Action
{
    public function indexAction()
    {
        // action body
    }

    public function loginAction()
    {
        // Create form object of class Form_Login
        $loginForm = new Form_Login();

        // Redirect to the referrer page
        $redirect = $this->getRequest()->getParam('redirect', '/');
        $loginForm->setAttrib('redirect', $redirect);

        // Check whether the user has an identity, else check if the login form is submitted
        if (Zend_Auth::getInstance()->hasIdentity()) {
            /* If its ok redirect it to homepage */
            $this->_redirect();
        } else if ($this->getRequest()->isPost()) {
            if ($loginForm->isValid($this->getRequest()->getPost())) {
                // Get the inserted credentials
                $username = $this->getRequest()->getPost('username');
                $password = $this->getRequest()->getPost('password');

                // Try to authenticate with provided credentials
                $result = Zend_Auth::getInstance()->authenticate(new Model_AuthAdapter($username, $password));

                // Results validation
                if ($result->isValid()) {
                    /* If its valid redirect it to homepage */
                    $this->_redirect();
                } else {
                    /* Populate the error message */
                    switch ($result->getCode()) {
                        case Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID:
                            $this->view->error = 'User credentials not found';
                    }
                }
            }
        }

        // Assign form elements to view
        $this->view->loginForm = $loginForm;
    }

    /*
     * Logout and clear session
     */
    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_redirect('/');
    }
}
