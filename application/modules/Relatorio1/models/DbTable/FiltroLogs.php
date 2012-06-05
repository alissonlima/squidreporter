<?php

class Relatorio1_Model_DbTable_FiltroLogs extends Zend_Db_Table_Abstract
{

    protected $_name = 'access_log';


	public function ListDate()
	{
                $sql = "SELECT * FROM {$this->_name}";
#		echo $sql;
#		return;
                $db = Zend_Db_Table::getDefaultAdapter();
                $result = $db->fetchAll($sql);

		$ret = array();
		if($result)
		{
			foreach($result as $line)
			{
				$ret[$line['id']] = $line['date_time'];
			}
		}

		return $ret;
	}

        function getYear()
        {
                $sql  = "SELECT ";
                $sql .= "DATE_FORMAT(date_time, '%Y-') AS valor, ";
                $sql .= "DATE_FORMAT(date_time, '%Y') AS legenda ";
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

                return $ret;
        
        }

        function getMonth()
        {
                $sql  = "SELECT ";
                $sql .= "DATE_FORMAT(date_time, '%b-') AS valor, ";
                $sql .= "DATE_FORMAT(date_time, '%b') AS legenda ";
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

                return $ret;

        }


	function getDiaInicio()
	{
		$sql  = "SELECT ";
		$sql .= "DATE_FORMAT(date_time, '%Y-%m-%d ') AS valor, "; 
		$sql .= "DATE_FORMAT(date_time, '%d-%m-%Y') AS legenda "; 
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

		return $ret;
	}

	function getDiaTermino()
	{
		$sql  = "SELECT ";
		$sql .= "DATE_FORMAT(date_time, '%Y-%m-%d ') AS valor, "; 
		$sql .= "DATE_FORMAT(date_time, '%d-%m-%Y') AS legenda "; 
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

		return $ret;
	}

}

