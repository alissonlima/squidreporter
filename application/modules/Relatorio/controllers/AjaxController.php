<?php

class Relatorio_AjaxController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body

    $form = new Relatorio_Form_Filtro();
    $this->view->form = $form;
    }

    public function mesAction()
    {
        // action body
	$this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(true);

	$ano = $this->_request->getParam('ano');


        $sql  = "SELECT ";
        $sql .= "DATE_FORMAT(date_time, '%m') AS valor, ";
        $sql .= "DATE_FORMAT(date_time, '%M') AS legenda ";
        $sql .= "FROM access_log ";
        $sql .= "WHERE DATE_FORMAT(date_time, '%Y') = '{$ano}'";
        $sql .= "GROUP BY valor ORDER BY valor ASC";
        $db = Zend_Db_Table::getDefaultAdapter();
        $result = $db->fetchAll($sql);

        $ret = array();
        if($result)
        {
         foreach($result as $line)
         {
            $ret[$line['valor']] = $line['legenda'];
         }
        }

        echo Zend_Json::encode($ret);
    }

    public function inicioAction()
    {
        // action body
     $this->_helper->layout()->disableLayout();
     $this->_helper->viewRenderer->setNoRender(true);

        $sql  = "SELECT ";
	$sql .= "DATE_FORMAT(date_time, '%d') AS valor, "; 
	$sql .= "DATE_FORMAT(date_time, '%d') AS legenda "; 
	$sql .= "FROM access_log ";
        $sql .= "GROUP BY valor ORDER BY valor ASC";
        $db = Zend_Db_Table::getDefaultAdapter();
        $result = $db->fetchAll($sql);
        
        $ret = array();
        if($result)
        {
         foreach($result as $line)
         {
            $ret[$line['valor']] = $line['legenda'];
         }
        }

        echo Zend_Json::encode($ret);

    }

    public function terminoAction()
    {
        // action body
	$this->_helper->layout()->disableLayout();
	$this->_helper->viewRenderer->setNoRender(true);


        $sql  = "SELECT ";
	$sql .= "DATE_FORMAT(date_time, '%d') AS valor, "; 
	$sql .= "DATE_FORMAT(date_time, '%d') AS legenda "; 
	$sql .= "FROM access_log ";
	$sql .= "GROUP BY valor ORDER BY valor ASC";

        $db = Zend_Db_Table::getDefaultAdapter();
        $result = $db->fetchAll($sql);

        $ret = array();
        if($result)
        {
         foreach($result as $line)
         {
            $ret[$line['valor']] = $line['legenda'];
         }
        }

        echo Zend_Json::encode($ret);

    }

    public function reportAction()
    {
        // action body
	$this->_helper->layout()->disableLayout();
	$this->_helper->viewRenderer->setNoRender(true);
	// '/Relatorio/Ajax/report/year/' + year + '/month/' + month + '/begin/' + begin + '/end/' + end;
	//phpinfo();
	$year = $this->_request->getParam('year');
	$month = $this->_request->getParam('month');
	$begin = $this->_request->getParam('begin');
	$end = $this->_request->getParam('end');
    }


}




