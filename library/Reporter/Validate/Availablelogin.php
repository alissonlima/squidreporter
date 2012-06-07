<?php
class Reporter_Validate_Availablelogin extends Zend_Validate_Abstract
{
	const LOGIN_EXISTS = 'loginExists';

	protected $_messageTemplates = array(
			self::LOGIN_EXISTS => "Já existe um usuário com o login '%value%'. Favor escolher outro login.",
			);

	protected function replace($string)
	{
		return $string = str_replace("/","", str_replace("-","",str_replace(".","",$string)));
	}

	protected function checkLogin($username)
	{
		$username = $this->replace($username);
		$username = trim($username);
		if(empty($username))
		{
			return FALSE;
		}
		else
		{
			$sql = "SELECT COUNT(*) AS users FROM fale.user WHERE username = '{$username}'";
			$db = Zend_Db_Table::getDefaultAdapter();
			$row = $db->fetchRow($sql);

			if($row['users'] > 0)
			{
				return FALSE;
			}
			else
			{
				return TRUE;
			}

		}
	}



	public function isValid($value)
	{
		$valueString = (string) $value;
		$this->_setValue($valueString);

		if (!$this->checkLogin($value)) {
			$this->_error(self::LOGIN_EXISTS);
			return false;
		}
		return true;
	}
}
