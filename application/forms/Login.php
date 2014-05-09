<?php

/**
 * @package       Login
 * @category      Forms
 * @author        Daniel Stancu <birkof@birkof.ro>
 * @copyright     Copyright (c) 2014 Daniel STANCU (http://birkof.ro)
 * @license       GPLv3 (http://www.gnu.org/licenses/gpl-3.0.html)
 */
class Form_Login extends Zend_Form
{
    public function __construct($options = [])
    {
        parent::__construct($options);

        $username = new Zend_Form_Element_Text('username');
        $username->setLabel('Username')
            ->setRequired(true)
            ->addFilters(['StripTags', 'StringTrim'])
            ->addValidators([['NotEmpty'], ['StringLength', false, [3, 20]]]);

        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('Password')
            ->setRequired(true)
            ->addFilters(['StripTags', 'StringTrim'])
            ->addValidators([['NotEmpty'], ['StringLength', false, [5, 50]]]);

        $submit   = new Zend_Form_Element_Submit('submit');
        $redirect = new Zend_Form_Element_Hidden('redirect');
        $this->addElements([$username, $password, $redirect, $submit]);
    }
}
