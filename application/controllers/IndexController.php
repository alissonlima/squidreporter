<?php

class IndexController extends Zend_Controller_Action
{

	public function init()
	{
		$role = 'admin';
		$actions = array('index');
		$this->_helper->_aclReporter->allow($role, $actions);

		$this->_logger = Zend_Registry::get('logger');
		$this->_auth = Zend_Auth::getInstance()->getIdentity();
	}

	public function indexAction()
	{
		// action body
	}


}

