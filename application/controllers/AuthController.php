<?php

class AuthController extends Zend_Controller_Action
{
	protected $_logger;
	public function init()
	{
                $writer = new Zend_Log_Writer_Stream('/tmp/zf-auth.log');
                $this->_logger = new Zend_Log($writer);

	}

	public function indexAction()
	{
		// action body
	}

	public function loginAction()
	{
		$this->view->css_file = "/css/login.css";
		$this->_helper->layout()->disableLayout();
		$form = new Application_Form_Auth();
		$this->view->form = $form;
		$this->view->message = 'Erro na autenticação';
		if ($this->_request->isPost()) 
		{
			Zend_Loader::loadClass('Zend_Filter_StripTags');
			$f = new Zend_Filter_StripTags();
			$user = $f->filter($this->_request->getPost('user'));
			$password = $f->filter($this->_request->getPost('password'));
			if (empty($user)) 
			{
				$this->view->message = 'Favor fornecer um nome de usuário.';
			} 
			else 
			{

				$auth = new Application_Model_Auth();
				$auth->setLogger($this->_logger);

				$res = $auth->login($user, $password);
				if($res)
				{
					$this->_redirect('/index/index');
				}
				else
				{
					$this->view->message = $res;
				}
			}
		}
	}

	public function logoutAction()
	{
		// action body
		$auth = new Application_Model_Auth();
		$auth->setLogger($this->_logger);
		$auth->logout();
		$this->_redirect('/');
	}

	public function nopermsAction()
	{
		// action body
	}


}







