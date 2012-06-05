<?php

class Application_Form_Auth extends Zend_Form
{

	public function init()
	{
		$this->setMethod('post');
		$this->addElement('text', 'user', array(
					'label'      => 'usuário:',
					'required'   => true,
					'size'       => 20,
					'class'     => 'form_input',
					'filters'    => array('StringTrim')
					));
		$this->addElement('password', 'password', array(
					'label'      => 'senha:',
					'required'   => true,
					'size'       => 20,
					'class'     => 'form_input',
					'filters'    => array('StringTrim')
					));

		$this->addElement('submit', 'submit', array(
					'ignore'   => true,
					'label'    => 'entrar',
					'class'     => 'botao_salvar'
					));
	}

}


