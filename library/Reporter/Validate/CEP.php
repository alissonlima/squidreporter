<?php
class Reporter_Validate_CEP extends Zend_Validate_Abstract
{
	const INVALID_CEP = 'INVALID_CEP';

	protected $_messageTemplates = array(
			self::INVALID_CEP => "O CEP '%value%' é inválido ou está mal formatado corretamente. ex. 80030-000",
			);

	protected function checkCEP($cep)
	{
		$cep = trim($cep);
		if(empty($cep))
		{
			return FALSE;
		}
		else
		{
			$pattern = '/^([0-9]{5})-([0-9]{3})$/';
			if (preg_match($pattern, $cep)) 
			{
				return TRUE;
			}
			else
			{
				$this->_error();
				return FALSE;
			}
		}
	}



	public function isValid($value)
	{
		$valueString = (string) $value;
		$this->_setValue($valueString);

		if (!$this->checkCEP($value)) {
			$this->_error(self::INVALID_CEP);
			return false;
		}
		return true;
	}
}
