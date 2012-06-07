<?php
class Reporter_Graph
{
	public function __construct()
	{
		$this->_buffer .= ""; 
	}

	public function setDbAdapter($db)
	{
		$this->_db_adapter = $db;
	}

	public function Montar($sql, $titulo, $nome)
	{
		if(is_null($this->_db_adapter))
		{
			$db = Zend_Db_Table::getDefaultAdapter(); 
		}
		else
		{
			$db = $this->_db_adapter;
		}
		$linhas = $db->fetchAll($sql);

		$buffer  = "<script>\n";
		$buffer .= "{$nome} = [\n";

		if($linhas)
		{
			foreach($linhas as $linha)
			{
				$buffer .= "\t['{$linha['name']}', {$linha['value']}],\n";
			}
		}

		$buffer .= "];\n";

		$buffer .= "load_graph_slices('{$nome}','{$titulo}', {$nome});\n";
		$buffer .= "</script>\n";

		$buffer .= "<div class=\"col\"><div id=\"{$nome}\"></div></div>\n";

		return $buffer;
	}
}
