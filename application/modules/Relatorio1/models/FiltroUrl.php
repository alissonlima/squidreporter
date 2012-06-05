<?php

class Relatorio_Model_FiltroUrl
{

	public function Logs($date_begin, $date_end)
	{

               $sql = "SELECT ";

               $sql.= "CONCAT('<a href=http://',domain_of_url(`request_url`),'>',domain_of_url(`request_url`),'</a>') AS Sites, ";
               $sql.= "SUM(1) AS pags";
               $sql.= "FROM access_log ";
               $sql.= "WHERE mime_type = 'text/html' ";
               $sql.= "AND date_time BETWEEN '{$date_begin}' AND '{$date_end}' ";     

               $sql.= "GROUP BY Sites ";
               $sql.= "ORDER BY pags ";
               $sql.= "DESC LIMIT 100 ";


	       $pattern = '#([0-9]{4})-([0-9]{2})-([0-9]{2}).*$#sim';
               $date_begin = preg_replace($pattern, '\3/\2/\1', $date_begin);
	       $date_end = preg_replace($pattern, '\3/\2/\1', $date_end);

	       $grid = new Application_Model_Grid();
              # $buffer = "<h3>Relatorio de {$date_month} - {$date_year}</h3>\n";
	       $buffer = "<h3>período de {$date_begin} - {$date_end}</h3>\n";
	       $buffer .= $grid->MontarGrade($sql);   
    		return $buffer;
	}

       
}

