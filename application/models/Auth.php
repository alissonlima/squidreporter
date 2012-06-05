<?php

class Application_Model_Auth
{
	protected $_logger = null;
	protected $_dbTableName = 'usuario';
	protected $_dbColumnLogin = 'user';
	protected $_dbColumnPassword = 'password';

	public function setLogger($logger)
	{
		$this->_logger = $logger;
	}

	protected function _log($msg)
	{
		if(!is_null($this->_logger))
		{
			$this->_logger->info(trim($msg));
		}
	}

	function login($user, $password)
	{
		Zend_Loader::loadClass('Zend_Auth_Adapter_DbTable');
		Zend_Loader::loadClass('Zend_Filter_StripTags');
                $f = new Zend_Filter_StripTags();
                $user = $f->filter($user);
                $password = $f->filter($password);
		$return = True;


		$db = Zend_Db_Table::getDefaultAdapter();
		$authAdapter = new Zend_Auth_Adapter_DbTable($db);
		$authAdapter->setTableName($this->_dbTableName)->setIdentityColumn($this->_dbColumnLogin)->setCredentialColumn($this->_dbColumnPassword)->setCredentialTreatment('MD5(?)');

		$this->_log("Autenticando: {$user} x {$password}");
		$authAdapter->setIdentity($user);
		$authAdapter->setCredential($password);
		$auth = Zend_Auth::getInstance();
		$result = $auth->authenticate($authAdapter);

		if ($result->isValid()) 
		{
			$data = $authAdapter->getResultRowObject(null, 'password');
			$auth->getStorage()->write($data);
		} 
		else 
		{
			$return = 'Falha na autenticação.';
		}


		$this->view->title = "Autenticação";
		return $return;
	}

	public function logout()
	{
		$identity = Zend_Auth::getInstance()->getIdentity();
		$user = $identity->user;
		$this->_log("Logout: {$user} ");
        	Zend_Auth::getInstance()->clearIdentity();
	}
}

