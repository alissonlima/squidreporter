<?php
class Reporter_Validate_FullName extends Zend_Validate_Abstract
{
	const INVALID_NAME = 'invalidFullName';

	protected $_messageTemplates = array(
			self::INVALID_NAME => "O nome '%value%' não é válido. Não esqueça que o nome completo deve conter nome e sobrenome.",
			);

	protected function replace($string)
	{
		return $string = str_replace("/","", str_replace("-","",str_replace(".","",$string)));
	}

	protected function checkName($username)
	{
		$username = $this->replace($username);
		$username = trim($username);
		if(empty($username))
		{
			return FALSE;
		}
		else
		{
			$pattern = '#^([^ ]{1,}) +(.*)$#si';
			if(preg_match($pattern, $username, $array))
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}	
		}
	}



	public function isValid($value)
	{
		$valueString = (string) $value;
		$this->_setValue($valueString);

		if (!$this->checkName($value)) {
			$this->_error(self::INVALID_NAME);
			return false;
		}
		return true;
	}
}
