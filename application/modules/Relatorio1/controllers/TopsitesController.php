<?php

class Relatorio_TopsitesController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $form = new Relatorio_Form_FiltroLogs();
		echo $form;
                $request = $this->getRequest();
                if ($this->getRequest()->isPost()) 
		{
			if ($form->isValid($request->getPost())) 
			{
				$data 		= $form->getValues();
				$date_begin 	= $form->getValue('date_begin');	
				$date_end 	= $form->getValue('date_end');
     
				#$this->insert('access-day');
				$filtro = new Relatorio_Model_FiltroUrl();
                               # echo $filtro->Build($date_month, $date_year);
				echo $filtro->Logs($date_begin, $date_end);
			}
		
                 }

    }
}



