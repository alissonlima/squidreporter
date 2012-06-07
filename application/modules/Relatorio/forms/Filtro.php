<?php

class Relatorio_Form_Filtro extends Zend_Form
{

	public function init()
	{
		/* Form Elements & Other Definitions Here ... */
		
	
                $do = new Relatorio_Model_DbTable_Filtro();
                $dos = $do->getYear();
                $dos = array('0'=>'Selecione o ano') + $dos;
                $this->addElement('select', 'date_year', array(
               # $this->addElement('radio', 'date_year', array(
                                        'label'      => 'ano',
                                        'required'   => true,
                                        'multiOptions'     => $dos,
                                        'filters'    => array('StringTrim')
                                        ));

                
                $do = new Relatorio_Model_DbTable_Filtro();
#                $dos = $do->getMonth();
		$dos = array();
                $dos = array('0'=>'Selecione o mes') + $dos;

                $this->addElement('select', 'date_month', array(
                #$this->addElement('radio', 'id_group', array(
                                        'label'      => 'mes',
                                        'required'   => true,
                                        'multiOptions'     => $dos,
                                        'filters'    => array('StringTrim')
                                        ));

	
		$do = new Relatorio_Model_DbTable_Filtro();
		$dos = $do->getDiaInicio();
		$dos = array();
		$dos = array('0'=>'Selecione um data') + $dos;
		$this->addElement('select', 'date_begin', array(
		#$this->addElement('radio', 'id_group', array(
					'label'      => 'inicio',
					'required'   => true,
					'multiOptions'     => $dos,
					'filters'    => array('StringTrim')
					));

		$dos = $do->getDiaTermino();
		$dos = array();
		$dos = array('0'=>'Selecione um data') + $dos;
		$this->addElement('select', 'date_end', array(
		#$this->addElement('radio', 'id_group', array(
					'label'      => 'termino',
					'required'   => true,
					'multiOptions'     => $dos,
					'filters'    => array('StringTrim')
					));


		#$this->addElement('submit', 'submit', array(
		$this->addElement('button', 'submit', array(
					'ignore'   => true,
					'label'    => 'enviar',
					'class'     => 'botao_salvar'
					));

                

	}
        

}

