<?php

class Cadastro_Form_Ativaruser extends Zend_Form
{

	public function init()
	{
		/* Form Elements & Other Definitions Here ... */
		$this->setMethod('post');

		$this->addElement('submit', 'submit', array(
					'ignore'   => true,
					'label'    => 'Restaurar usuario',
					'class'     => 'botao_salvar'
					));

                

	}
        

}

