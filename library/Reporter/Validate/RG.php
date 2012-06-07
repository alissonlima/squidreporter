<?php
class Reporter_Validate_RG extends Zend_Validate_Abstract
{
	const INVALID_RG = 'InvalidRG';

	protected $_messageTemplates = array(
			self::INVALID_RG => "O RG '%value%' é inválido ou está mal formatado.",
			);

	protected function replace($string)
	{
		return $string = str_replace("/","", str_replace("-","",str_replace(".","",$string)));
	}

	protected function checkRG($username)
	{
		$username = $this->replace($username);
		$username = trim($username);
		if(empty($username))
		{
			return FALSE;
		}
		else
		{
			$pattern = "#[0-9]\.[0-9]{3}\.[0-9]{3}\-\d#si";

			if (preg_match($pattern, $username)) {
				return true;
			} else {
				return false;
			}
		}
	}



	public function isValid($value)
	{
		$valueString = (string) $value;
		$this->_setValue($valueString);

		if (!$this->checkRG($value)) {
			$this->_error(self::INVALID_RG);
			return false;
		}
		return true;
	}
}
/*
   $this->er['texto'] = “^\w+$”;
   $this->er['branco'] = “^\s+$”;
   $this->er['letras'] = “^[a-zA-Z]+$”;
   $this->er['letras_numeros'] = “^[a-zA-Z0-9\s]+$”;
   $this->er['sem_espaco'] = “^[a-zA-Z0-9]+$”;
   $this->er['numeros'] = “^[0-9]+$”;
   $this->er['numeros_inteiros'] = “^[0-9]+$”;
   $this->er['letra_ou_numero'] = “^([a-zA-Z]|[0-9])$”;
   $this->er['ponto_flutuante'] = “^((\d+(\.\d*)?)|((\d*\.)?\d+))$”;
   $this->er['ponto_decimal'] = “^((\d+(\,\d*)?)|((\d*\,)?\d+))$”;
   $this->er['ponto_decimal_2_casas'] = “^(\d+((,\d{1,2})|(\.\d{1,2}))?)$”;
   $this->er['email'] = “^.+\@.+\..+$”;
   $this->er['nao_nulo'] = “^[\s|\S]+$”;
   $this->er['rg'] = “[0-9]\.[0-9]{3}\.[0-9]{3}\-\d”;
   $this->er['cpf'] = “[0-9]\.[0-9]{3}\.[0-9]{3}\-\d”;
   $this->er['data'] = “^([0-9]{2}\/[0-9]{2}\/[0-9]{4})$”;
   $this->er['data_hora'] = “^([0-9]{2}\/[0-9]{2}\/[0-9]{4}\s[0-9]{2}:[0-9]{2})$”;
   $this->er['cep'] = “^[0-9]{8}$”;
 */
