<?php

class Reporter_Validate_Cpf extends Zend_Validate_Abstract
{
    const CPF = 'cpf';

    protected $_messageTemplates = array(
            self::CPF => "Este CPF é inválido"
            );

    public function isValid($value)
    {
        $this->_setValue($value);


        if (!$this->validaCPF($value)) {
            $this->_error(null);
            return false;
        }

        return true;
    }

    /*
       @autor: Moacir Selínger Fernandes
       @email: hassed@hassed.com
       http://codigofonte.uol.com.br/codigo/php/validacao/validacao-de-cpf-com-php
       Qualquer dúvida é só mandar um email
     */
    public function validaCPF($cpf)
    {   // Verifiva se o número digitado contém todos os digitos
        $cpf = str_pad(ereg_replace('[^0-9]', '', $cpf), 11, '0', STR_PAD_LEFT);

        // Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
        if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999')
        {
            return false;
        }
        else
        {   // Calcula os números para verificar se o CPF é verdadeiro
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf{$c} * (($t + 1) - $c);
                }

                $d = ((10 * $d) % 11) % 10;

                if ($cpf{$c} != $d) {
                    return false;
                }
            }

            return true;
        }
    }
}
